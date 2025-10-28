<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminDashboard extends BaseController
{
    protected $bookingModel;
    protected $userModel;
    protected $roomModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
        $this->roomModel = new RoomModel();
    }

    public function view() 
    {
        $bookings = $this->bookingModel->findAll();

        return view('admin/dashboard', $bookings);
    }
}

/* admin dashboard
- view recent activites
- view hidden room
- buat/view announcement
*/