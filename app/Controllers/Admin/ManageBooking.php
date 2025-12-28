<?php 

namespace App\Controllers\Admin;

use App\Libraries\Model;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Libraries\Mailer;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class ManageBooking extends BaseController
{
    protected $allowedStatuses = ['pending', 'approved', 'rejected'];

    public function view($status = 'pending')
    {
        $bookingModel = Model::booking();
        $perPage = 10;

        $bookings = $bookingModel
            ->where('status', $status)
            ->orderBy('date', 'DESC')
            ->paginate($perPage, 'bookings');

        $pager = $bookingModel->pager;

        // Merge overlapping or consecutive slots
        $mergedSlots = $this->mergeSlots($bookings);

        return view("bookings/manage_{$status}", [
            'data' => [
                'bookings' => $bookings,
                'status' => $status,
                'pager' => $pager,
                'mergedSlots' => $mergedSlots,
            ]
        ]);
    }

    public function updateStatus($bookingId)
    {
        $booking = Model::booking()->where('bookingId', $bookingId)->first();
        if (!$booking) return redirect()->back()->with('error', 'Booking not found.');

        $newStatus = Post('status');
        if (!in_array($newStatus, $this->allowedStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $updateData = ['status' => $newStatus];
        if ($newStatus === 'rejected') {
            $updateData['reason'] = Post('reason') ?? 'Tempahan Ditolak';
        }

        Model::booking()->where('bookingId', $bookingId)->set($updateData)->update();

        if ($newStatus === 'approved') {
            try {
                $this->email($bookingId);
            } catch (\Exception $e) {
                log_message('error', 'Failed to send booking email: ' . $e->getMessage());
                return redirect()->back()->with('error', 'Booking approved but email failed.');
            }
        }

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function delete($bookingId)
    {
        $booking = Model::booking()->where('bookingId', $bookingId)->first();
        if (!$booking) return redirect()->back()->with('error', 'Booking not found.');

        Model::booking()->where('bookingId', $bookingId)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    private function buildSummaryData($roomId)
    {
        $username = Get('username');
        $date     = Get('date');
        $reason   = Get('reason');

        $room = Model::room()->find($roomId);

        $bookings = Model::booking()
            ->where('roomId', $roomId)
            ->where('username', $username)
            ->where('date', $date)
            ->where('reason', $reason)
            ->where('status', 'approved')
            ->findAll();

        $mergedSlots = $this->mergeSlots($bookings);

        return [
            'room'        => $room,
            'bookings'    => $bookings,
            'mergedSlots' => $mergedSlots,
            'username'    => $username,
            'date'        => $date,
            'reason'      => $reason
        ];
    }

    public function summary($roomId)
    {
        $data = $this->buildSummaryData($roomId);

        if ($this->request->isAJAX() || $this->request->getGet('popup') === '1') {
            return view('bookings/summary_popup', ['data' => $data]);
        }

        return view('bookings/summary', ['data' => $data]);
    }

    public function email($bookingId)
    {
        $pdf = $this->buildPdf($bookingId);

        $dir = WRITEPATH . 'receipts/';
        if (!is_dir($dir)) mkdir($dir, 0777, true);

        $path = $dir . 'receipt_' . $bookingId . '.pdf';
        file_put_contents($path, $pdf['output']);

        $mailer = new Mailer();
        $mailer->sendReceipt($pdf['email'], $pdf['name'], $path);

        return redirect()->back()->with('success', 'Receipt emailed');
    }

    public function buildPdf($bookingId): array
    {
        $bookingModel = Model::booking();
        $booking = $bookingModel->where('bookingId', $bookingId)->first();
        if (!$booking) throw new PageNotFoundException('Booking not found');

        $rows = $bookingModel
            ->where('roomName', $booking['roomName'])
            ->where('date', $booking['date'])
            ->where('reason', $booking['reason'])
            ->findAll();

        if (empty($rows)) throw new PageNotFoundException('No slots found for this booking');

        $mergedSlots = $this->mergeSlots($rows);

        $data = [
            'booking' => [
                'username' => $booking['username'],
                'staffno'  => $booking['staffno'],
                'email'    => $booking['email'],
                'roomName' => $booking['roomName'],
                'date'     => $booking['date'],
                'status'   => $booking['status'],
                'reason'   => $booking['reason'],
            ],
            'mergedSlots' => $mergedSlots,
        ];

        $html = view('bookings/receipt_pdf', $data);

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return [
            'output' => $dompdf->output(),
            'email'  => $booking['email'],
            'name'   => $booking['username'],
        ];
    }

    /**
     * Merge overlapping or consecutive slots
     */
    private function mergeSlots(array $bookings): array
{
    $slots = [];

    // Collect start/end from bookings
    foreach ($bookings as $b) {
        if (isset($b['book_start'], $b['book_end']) && $b['book_start'] !== '' && $b['book_end'] !== '') {
            $slots[] = [
                'start' => strtotime($b['book_start']),
                'end'   => strtotime($b['book_end'])
            ];
        }
    }

    if (empty($slots)) {
        return []; // no slots to merge
    }

    // Sort by start time
    usort($slots, fn($a, $b) => $a['start'] <=> $b['start']);

    $merged = [];
    $current = $slots[0];

    for ($i = 1; $i < count($slots); $i++) {
        if ($slots[$i]['start'] <= $current['end']) {
            // Extend current slot
            $current['end'] = max($current['end'], $slots[$i]['end']);
        } else {
            $merged[] = $current;
            $current = $slots[$i];
        }
    }

    $merged[] = $current;

    // Convert back to H:i format
    return array_map(fn($s) => date('H:i', $s['start']) . '-' . date('H:i', $s['end']), $merged);
}

}
