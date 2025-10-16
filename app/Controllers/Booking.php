<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Controllers\BaseController;
use App\Controllers\Function\BookingHelper;

class Booking extends BaseController
{
    // Show all rooms as cards
    public function view()
    {
        $helper = new BookingHelper();
        $data['rooms'] = $helper->transformBook(null); 
        $roomModel = new RoomModel();
        $data['rooms'] = $roomModel->findAll();

        return view('pages/bookings', $data);
    }

    // tunjuk details bilik(time slots)
    public function details($roomId)
    {
        $helper = new BookingHelper();
        $roomData = $helper->transformBook($roomId);

        $data['room'] = $roomData[0] ?? null;

        // time slots
        $timeSlots = [
            '08:00 - 09:00',
            '09:00 - 10:00',
            '10:00 - 11:00',
            '11:00 - 12:00',
            '12:00 - 13:00',
            '13:00 - 14:00',
            '14:00 - 15:00',
            '15:00 - 16:00',
            '16:00 - 17:00',
        ];

        if ($data['room'] && !empty($data['room']['bookings'])) {
            foreach ($data['room']['bookings'] as $b) {
                $bookedRange = $b['booking_start'] . ' - ' . $b['booking_end'];
                $timeSlots = array_filter($timeSlots, fn($slot) => $slot !== $bookedRange);
            }
        }

        $data['timeSlots'] = $timeSlots;
        return view('rooms/details', $data);
    }
}
