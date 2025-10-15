<?php

namespace App\Controllers;

use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Booking extends BaseController
{
    public function viewBookings()
    {
        $RoomModel = new RoomModel();
        $BookingModel = new BookingModel();
        $data['rooms'] = $RoomModel->findAll();
        $data['bookings'] = $BookingModel->findAll();

        return view('pages/bookings', $data);
    }

    public function create()
    {
        return view('bookings/create_booking');
    }

    public function store()
    {
        $BookingModel = new BookingModel();
        $data = [
            'roomId'        => $this->request->getPost('roomId'),
            'roomName'      => $this->request->getPost('roomName'),
            'date'          => $this->request->getPost('date'),
            'booking_start' => $this->request->getPost('booking_start'),
            'booking_end'   => $this->request->getPost('booking_end'),
        ];
        $BookingModel->save($data);

        return redirect()->to('/bookings');
    }

    /*
    public function showBookings()
    {
        $BookingModel = new BookingModel();
        $data['bookings'] = $BookingModel->findAll();

        return view('pages/bookings', $data);
    }
    */

}
