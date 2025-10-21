<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function main()
    {
        // Ensure user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Please log in first.');
        }

        // Get user info from session
        $userData = [
            'staffno'  => session()->get('staffno'),
            'username' => session()->get('username'),
        ];

        $bookingModel = new BookingModel();
        $userId = session()->get('staffno');
        $userBookings = $bookingModel->where('staffno', $userId)->findAll();

        $data = [
            'user' => $userData,
            'bookings' => $userBookings,
        ];

        return view('pages/dashboard', $data);
    }

    public function bookRoom()
    {
        // Redirect to your room booking form
        return redirect()->to('admin/rooms');
    }
}
