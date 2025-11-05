<?php

namespace App\Controllers;

use App\Libraries\Model;
use App\Models\BookingModel;
use App\Models\RoomModel;
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

    public function details($roomId) //details bilik after clicked on cards
    {
        $helper = new BookingHelper();
        $bookings = Model::booking();

        // Get room info
        $roomData = $helper->transformBook($roomId);
        $room = $roomData[0] ?? null;

        if (!$room) 
            {
            session()->setFlashdata('error', 'Room not found.');
            return redirect()->to('/rooms');
            }


        $selectedDate = Get('date') ?? date('Y-m-d');
        $timeSlots = TimeSlot::timeSlots($roomId);

        $bookings = $bookings
            ->where('roomId', $roomId)
            ->where('date', $selectedDate)
            ->findAll();

        foreach ($timeSlots as &$slot) {
            $slotStatus = 'available';
            foreach ($bookings as $booking) {
                if ($booking['time_slot'] === $slot['slot']) {
                    // tukar status from db
                    $slotStatus = match($booking['status']) {
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

        // Pass everything to the view
        return view('bookings/create_booking', [
            'room' => $room,
            'selectedDate' => $selectedDate,
            'timeSlots' => $timeSlots,
        ]);
    }

}
