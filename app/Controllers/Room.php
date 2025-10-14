<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Controllers\BaseController;
use App\Controllers\Function\BookingHelper;


class Room extends BaseController
{
    // Show all rooms with their bookings
     public function view()
    {
        $roomModel = new RoomModel();
        $helper = new BookingHelper();

        $rooms = $roomModel->findAll();
        $results = [];

        foreach ($rooms as $room) {
            $transformed = $helper->transformBook($room['roomId']);
            $results[] = $transformed[0];
        }

        return view('pages/rooms', ['rooms' => $results]);
    }

    // Show a single room with its bookings
    public function viewBooking($roomId)
    {
        $helper = new BookingHelper();
        $data = $helper->transformBook($roomId);
        return $this->response->setJSON($data);
    }
}
