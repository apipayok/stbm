<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\RoomModel;
use App\Controllers\BaseController;
use App\Controllers\Function\BookingHelper;
use App\Controllers\Function\TimeSlot;

class Room extends BaseController
{
    
    public function view() //but card untuk rooms
    {
        $roomModel = new RoomModel();
        $data['rooms'] = $roomModel->findAll();

        return view('pages/rooms', $data);
    }

    public function details($roomId) //details bilik after clicked on cards
    {
        $helper = new BookingHelper();
        $roomModel = new RoomModel();
        $bookingModel = new \App\Models\BookingModel();

        // Get room info
        $roomData = $helper->transformBook($roomId);
        $room = $roomData[0] ?? null;

        if (!$room) 
            {
            session()->setFlashdata('error', 'Room not found.');
            return redirect()->to('/rooms');
            }


        $selectedDate = $this->request->getGet('date') ?? date('Y-m-d');
        $timeSlots = TimeSlot::timeSlots($roomId);

        $bookings = $bookingModel
            ->where('roomId', $roomId)
            ->where('date', $selectedDate)
            ->findAll();

        foreach ($timeSlots as &$slot) {
            $slotStatus = 'available';
            foreach ($bookings as $booking) {
                if ($booking['time_slot'] === $slot['slot']) {
                    $slotStatus = $booking['status'];
                    break;
                }
            }
            $slot['status'] = $slotStatus;
        }

        // Pass everything to the view
        return view('rooms/details', [
            'room' => $room,
            'selectedDate' => $selectedDate,
            'timeSlots' => $timeSlots,
        ]);
    }

}
