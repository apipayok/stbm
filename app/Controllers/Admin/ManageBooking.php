<?php

namespace App\Controllers\Admin;

use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageBooking extends BaseController
{
    public function view()
    {
        $bookingModel = new BookingModel();
        $bookings = $bookingModel->findAll();

        return view('admin/admin_bookings', ['bookings' => $bookings]);
    }

    public function editBooking($bookingId)
    {
        $bookingModel = new BookingModel();
        $bookings = $bookingModel->where('bookingId', $bookingId)->first();

        if (!$bookings) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $newStatus = $this->request->getPost('status');

        $allowedStatuses = ['pending', 'approved', 'rejected'];
        if (!in_array($newStatus, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $bookingModel->where('bookingId', $bookingId)->set(['status' => $newStatus])->update();

        if ($this->request->getPost('status') === 'rejected') {
            $bookingModel->delete($bookingId);
        }

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }
}