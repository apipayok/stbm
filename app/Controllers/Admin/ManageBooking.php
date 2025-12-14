<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageBooking extends BaseController
{
    protected $allowedStatuses = ['pending', 'approved', 'rejected'];

    public function view($status = 'pending')
    {
        $bookingModel = Model::booking();
        $perPage = 10;

        $bookings = $bookingModel
            ->where('status', $status)
            ->paginate($perPage, 'bookings');

        $pager = $bookingModel->pager;

        $data = [
            'bookings' => $bookings,
            'status' => $status,
            'pager' => $pager,
        ];
        return view("bookings/manage_{$status}", ['data' => $data]);
    }

    public function updateStatus($bookingId)
    {
        $booking = Model::booking()->where('bookingId', $bookingId)->first();
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $newStatus = Post('status');
        if (!in_array($newStatus, $this->allowedStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $updateData = ['status' => $newStatus,];
        if ($newStatus === 'rejected') {
            $updateData['reason'] = Post('reason') ?? 'Tempahan Ditolak';
        }

        Model::booking()->where('bookingId', $bookingId)->set($updateData)->update();
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function delete($bookingId)
    {
        $booking = Model::booking()->where('bookingId', $bookingId)->first();
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

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

        $mergedSlots = [];
        if (!empty($bookings)) {
            $slots = [];
            foreach ($bookings as $b) {
                [$start, $end] = explode('-', $b['time_slot']);
                $slots[] = ['start' => (int)$start, 'end' => (int)$end];
            }

            usort($slots, fn($a, $b) => $a['start'] <=> $b['start']);

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
        }

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

        // Detect if request is for popup
        if ($this->request->isAJAX() || $this->request->getGet('popup') === '1') {
            // Return partial HTML (for popup)
            return view('bookings/summary_popup', ['data' => $data]);
        }

        // Default: full page
        return view('bookings/summary', ['data' => $data]);
    }
}
