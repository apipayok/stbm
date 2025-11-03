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

        $countHidden = Model::room()->where('status', 'hidden')->countAllResults();
        $countAvailable = Model::room()->where('status', 'available')->countAllResults();

        $hidden = Model::room()->where('status', 'hidden')->findAll();
        
        $message = [];
        if(empty($announcements)){
            $message[] = 'Tiada Pengumumuman';
        }
        if(empty($hidden)){
            $message[] = 'Tiada Bilik Tersembunyi';
        }

        $data = [
            'bookings' => $bookings,
            'users' => $users,
            'rooms' => $rooms,
            'announcements' => $announcements,
            'message' => $message,
            'countHidden' => $countHidden,
            'countAvailable' => $countAvailable,
            'hidden' => $hidden
        ];

        return view('admin/admin_dashboard', ['data' => $data]);
    }

    public function announcement()
    {
        $data = Post([
            'title',
            'content'
        ]);

        Model::announcement()->insert($data);

        return redirect()->to('admin/dashboard');
    }
}
