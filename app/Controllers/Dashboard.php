<?php

namespace App\Controllers;

use App\Libraries\Model;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function main()
    {
        // Ensure user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        $bookingModel = Model::booking();
        $announcement = Model::announcement()->findAll();

        $username = session()->get('username');
        $staffno = session()->get('staffno');

        $status = Get('status') ?? '';

        $query = $bookingModel->where('staffno', $staffno);
        if (in_array($status, ['approved', 'pending', 'rejected'])) {
            $query = $query->where('status', $status);
        }

        $perPage = 10;
        $userBookings = $query->paginate($perPage, 'userBookings');
        $pager = $query->pager; 

        $data = [
            'announcement' => $announcement,
            'username' => $username,
            'staffno' => $staffno,
            'userBookings' => $userBookings,
            'status' => $status,
            'pager' => $pager
        ];

        return view('pages/dashboard', $data);
    }
}
