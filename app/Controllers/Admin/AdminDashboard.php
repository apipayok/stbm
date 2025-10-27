<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminDashboard extends BaseController
{
    
    public function view()
    {
        $bookingModel = new BookingModel();
        $userModel = new UserModel();
        $roomModel = new RoomModel();

        

    }


}

/* admin dashboard
- view recent activites
- view hidden room
- buat/view announcement
*/