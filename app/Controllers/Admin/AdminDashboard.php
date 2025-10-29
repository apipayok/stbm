<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;

class AdminDashboard extends BaseController
{
    public function view()
    {
        $bookings = Model::booking()->findAll();
        $users = Model::user()->findAll();
        $rooms = Model::room()->findAll();
        $announcements = Model::announcement()->orderBy('created_at', 'DESC')->findAll();

        $data = [
            'bookings' => $bookings,
            'users' => $users,
            'rooms' => $rooms,
            'announcements' => $announcements,
            'message' => empty($announcements) ? 'No current announcements.' : '',
        ];

        return view('admin/admin_dashboard', ['data' => $data]);
    }

    public function viewRoom()
    {
        $rooms = Model::room()->where('status', 'hidden')->findAll();
        $data = ['rooms' => $rooms];
        return view('admin/hidden_rooms', ['data' => $data]); // kiv dulu
    }

    public function announcement()
    {
        $data = $this->request->getPost([
            'title',
            'content'
        ]);

        Model::announcement()->insert($data);

        return redirect()->to('admin/dashboard');
    }
}
