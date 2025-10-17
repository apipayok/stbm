<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\RoomModel;
use App\Controllers\BaseController;
use App\Controllers\Function\BookingHelper;
use App\Controllers\Function\TimeSlot;

class Booking extends BaseController
{
    
    public function check($roomId, $slot)
    {
        $bookingModel = new BookingModel();
        $roomModel = new RoomModel();
        

        $slot = urldecode($slot);

        // Check if the slot is already booked today
        $existing = $bookingModel
            ->where('roomId', $roomId)
            ->where('date', date('Y-m-d'))
            ->where('time_slot', $slot)
            ->first();

        if ($existing) {
            session()->setFlashdata('error', 'This slot is already booked.');
        } else {
            $room = $roomModel->where('roomId', $roomId)->first();

            if (!$room) {
                session()->setFlashdata('error', 'Room not found.');
                return redirect()->back();
            }

        
            $bookingModel->insert([
                'roomId'    => $roomId,
                'roomName'  => $room['roomName'],
                'staffno'   => session()->get('staffno'),
                'username'  => session()->get('username'),
                'date'      => date('Y-m-d'),
                'time_slot' => $slot,
                'status'    => 'pending',
            ]);

            session()->setFlashdata('success', 'Your booking has been submitted.');
        }

        return redirect()->to('/rooms/' . $roomId);
    }

    /**
     * Admin view: return all bookings for a room (flat join)
     */
    public function adminView($roomId)
    {   
        $helper = new BookingHelper();
        $joined = $helper->joinBook($roomId);
        return $this->response->setJSON($joined);
    }
}
