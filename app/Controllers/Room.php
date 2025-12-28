<?php

namespace App\Controllers;

use App\Libraries\Model;
use App\Controllers\BaseController;
use App\Controllers\Function\BookingHelper;
use App\Controllers\Function\TimeSlot;

class Room extends BaseController
{
    public function view() //but card untuk rooms
    {
        $rooms = Model::room()->findAll();
        $hidden = Model::room()->where('status', 'hidden')->findAll();
        $available = Model::room()->where('status', 'available')->findAll();

        $data = [
            'rooms' => $rooms,
            'hidden' => $hidden,
            'available' => $available
        ];
        return view('pages/rooms', $data);
    }

    public function details($roomId)
    {
        $helper = new BookingHelper();

        // Get room info
        $roomData = $helper->transformBook($roomId);
        $room = $roomData[0] ?? null;

        if (!$room) {
            session()->setFlashdata('error', 'Room not found.');
            return redirect()->to('/rooms');
        }

        $selectedDate = Get('date') ?? date('Y-m-d');
        $timeSlots = TimeSlot::timeSlots($roomId, $selectedDate); // pass date

        // Fetch bookings for the selected date
        $bookings = Model::booking()
            ->where('roomId', $roomId)
            ->where('date', $selectedDate)
            ->whereIn('status', ['pending', 'approved']) // only relevant statuses
            ->findAll();

        // Update slot statuses
        foreach ($timeSlots as &$slot) {
            $slotTime = strtotime($slot['book_start']);
            $slotStatus = 'available';

            foreach ($bookings as $booking) {
                $start = strtotime($booking['book_start']);
                $end = strtotime($booking['book_end']);

                if ($slotTime >= $start && $slotTime < $end) {
                    $slotStatus = match ($booking['status']) {
                        'pending' => 'pending',
                        'approved' => 'booked',
                        'rejected' => 'unavailable',
                        'cancelled' => 'available',
                        default => 'available'
                    };
                    break;
                }
            }

            $slot['status'] = $slotStatus;
        }

        return view('bookings/create_booking', [
            'room' => $room,
            'selectedDate' => $selectedDate,
            'timeSlots' => $timeSlots,
        ]);
    }
}
