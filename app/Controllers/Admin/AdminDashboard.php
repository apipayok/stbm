<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminDashboard extends BaseController
{
    public function view()
    {
        $bookings = Model::booking()->findAll();
        $users = Model::user()->findAll();
        $rooms = Model::room()->findAll();

        $data = [
            'title' => 'Admin Dashboard',
            'bookings' => $bookings,
            'users' => $users,
            'rooms' => $rooms,
        ];
        return view('admin/dashboard', ['data' => $data]);
    }

    public function viewRoom()
    {
        $rooms = Model::room()->where('status', 'hidden')->findAll();
        return view('admin/hidden_rooms', ['rooms' => $rooms]);
    }

    public function announcement()
    {
        $announcements = Model::announcement()->findAll();
        if (!$announcements){

        };
    }
}

/* admin dashboard
- view recent activites
- view hidden room
- buat/view announcement
*/