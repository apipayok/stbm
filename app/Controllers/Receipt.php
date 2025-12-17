<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Receipt extends BaseController
{
    public function generate($bookingId)
    {
        $bookingModel = Model::booking();

        // 1️⃣ Fetch the main booking by ID
        $booking = $bookingModel->where('bookingId', $bookingId)->first();
        if (!$booking) {
            throw new PageNotFoundException('Booking not found');
        }

        // 2️⃣ Fetch all rows for the same meeting to get all slots
        $rows = $bookingModel
            ->where('roomName', $booking['roomName'])
            ->where('date', $booking['date'])
            ->where('reason', $booking['reason'])
            ->findAll();

        if (empty($rows)) {
            throw new PageNotFoundException('No slots found for this booking');
        }

        // 3️⃣ Merge slots
        $slots = [];
        foreach ($rows as $row) {
            [$start, $end] = explode('-', $row['time_slot']);
            $slots[] = ['start' => (int)$start, 'end' => (int)$end];
        }

        usort($slots, fn($a, $b) => $a['start'] <=> $b['start']);

        $mergedSlots = [];
        $current = $slots[0];
        for ($i = 1; $i < count($slots); $i++) {
            if ($slots[$i]['start'] == $current['end']) {
                $current['end'] = $slots[$i]['end'];
            } else {
                $mergedSlots[] = $current;
                $current = $slots[$i];
            }
        }
        $mergedSlots[] = $current;
        $mergedSlots = array_map(fn($s) => $s['start'] . '-' . $s['end'], $mergedSlots);

        // 4️⃣ Prepare data for view
        $data = [
            'booking' => [
                'username' => $booking['username'],
                'staffno'  => $booking['staffno'],
                'roomName' => $booking['roomName'],
                'date'     => $booking['date'],
                'status'   => $booking['status'],
                'reason'   => $booking['reason']
            ],
            'mergedSlots' => $mergedSlots
        ];

        // 5️⃣ Render PDF
        $html = view('bookings/receipt_pdf', $data);

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Disposition', 'inline; filename="receipt.pdf"')
            ->setContentType('application/pdf')
            ->setBody($dompdf->output());
    }
}
