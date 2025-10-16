<?php

namespace App\Controllers;

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
        $roomData = $helper->transformBook($roomId);

        $data['room'] = $roomData[0] ?? null;
        $data['timeSlots'] = TimeSlot::timeSlots($roomId);

        return view('rooms/details', $data);
    }
}
