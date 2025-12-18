<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Libraries\Model;
use App\Libraries\Mailer;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Receipt extends BaseController
{
    public function generate($bookingId)
    {
        $pdf = $this->buildPdf($bookingId);

        return $this->response
            ->setHeader('Content-Disposition', 'inline; filename="receipt.pdf"')
            ->setContentType('application/pdf')
            ->setBody($pdf['output']);
    }

    public function email($bookingId)
    {
        $pdf = $this->buildPdf($bookingId);

        $dir = WRITEPATH . 'receipts/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $path = $dir . 'receipt_' . $bookingId . '.pdf';
        file_put_contents($path, $pdf['output']);

        $mailer = new Mailer();
        $mailer->sendReceipt(
            $pdf['email'],
            $pdf['name'],
            $path
        );

        return redirect()->back()->with('success', 'Receipt emailed');
    }

    public function buildPdf($bookingId): array
    {
        $bookingModel = Model::booking();

        $booking = $bookingModel->where('bookingId', $bookingId)->first();
        if (!$booking) {
            throw new PageNotFoundException('Booking not found');
        }

        $rows = $bookingModel
            ->where('roomName', $booking['roomName'])
            ->where('date', $booking['date'])
            ->where('reason', $booking['reason'])
            ->findAll();

        if (empty($rows)) {
            throw new PageNotFoundException('No slots found for this booking');
        }

        $slots = [];
        foreach ($rows as $row) {
            [$start, $end] = explode('-', $row['time_slot']);
            $slots[] = ['start' => (int) $start, 'end' => (int) $end];
        }

        usort($slots, fn($a, $b) => $a['start'] <=> $b['start']);

        $mergedSlots = [];
        $current = $slots[0];

        for ($i = 1; $i < count($slots); $i++) {
            if ($slots[$i]['start'] === $current['end']) {
                $current['end'] = $slots[$i]['end'];
            } else {
                $mergedSlots[] = $current;
                $current = $slots[$i];
            }
        }

        $mergedSlots[] = $current;
        $mergedSlots = array_map(
            fn($s) => $s['start'] . '-' . $s['end'],
            $mergedSlots
        );

        $data = [
            'booking' => [
                'username' => $booking['username'],
                'staffno'  => $booking['staffno'],
                'email'  => $booking['email'],
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

    //ni untuk send email
    public function buildPdfFromData(array $bookingData, array $mergedSlots): array
    {
        $data = [
            'booking' => [
                'username' => $bookingData['username'],
                'staffno'  => $bookingData['staffno'],
                'email'    => $bookingData['email'],
                'roomName' => $bookingData['roomName'],
                'date'     => $bookingData['date'],
                'status'   => $bookingData['status'],
                'reason'   => $bookingData['reason'],
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
            'email'  => $bookingData['email'],
            'name'   => $bookingData['username'],
        ];
    }
}
