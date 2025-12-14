<?php

namespace App\Controllers\Admin;

use App\Libraries\Model;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BookingDashboard extends BaseController
{
    public function view()
    {
        $bookingModel = Model::booking();
        $bookings = $bookingModel
            ->orderBy('created_at', 'DESC')
            ->findAll(10);

        $approvedCount = Model::booking()->where('status', 'approved')->countAllResults();
        $rejectedCount = Model::booking()->where('status', 'rejected')->countAllResults();
        $pendingCount = Model::booking()->where('status', 'pending')->countAllResults();
        $totalCount = Model::booking()->countAllResults();

        $data = [
            'bookings' => $bookings,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
            'pendingCount' => $pendingCount,
            'totalCount' => $totalCount,
        ];

        return view('admin/admin_bookings', $data);
    }
}
