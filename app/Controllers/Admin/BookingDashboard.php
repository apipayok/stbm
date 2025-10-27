<?php

namespace App\Controllers\Admin;

use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BookingDashboard extends BaseController
{
    public function view()
    {
        $bookingModel = new BookingModel();
        $bookings = $bookingModel->findAll();

        $approvedCount = $bookingModel->where('status', 'approved')->countAllResults();
        $rejectedCount = $bookingModel->where('status', 'rejected')->countAllResults();
        $pendingCount = $bookingModel->where('status', 'pending')->countAllResults();
        $totalCount = $bookingModel->countAllResults();

        $data = [
            'bookings' => $bookings,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
            'pendingCount' => $pendingCount,
            'totalCount' => $totalCount,
        ];

        return view('admin/admin_bookings', $data);
    }

    public function filterBookings()
    {
        // Placeholder for future filter logic
    }

}