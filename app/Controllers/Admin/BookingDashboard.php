<?php

namespace App\Controllers\Admin;

use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BookingDashboard extends BaseController
{
    protected $bookingModel;
    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }
    public function view()
    {
        $bookings = $this->bookingModel->findAll();

        $approvedCount = $this->bookingModel->where('status', 'approved')->countAllResults();
        $rejectedCount = $this->bookingModel->where('status', 'rejected')->countAllResults();
        $pendingCount = $this->bookingModel->where('status', 'pending')->countAllResults();
        $totalCount = $this->bookingModel->countAllResults();

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