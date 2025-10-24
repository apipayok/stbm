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
        $bookings = $bookingModel->where('status', 'pending')->findAll();

        return view('bookings/manage_pending', ['bookings' => $bookings]);//edit route
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

        $updateData = ['status' => $newStatus];
        if ($newStatus === 'rejected') {
            $reason = $this->request->getPost('reason') ?? 'No reason provided';
            $updateData['reason'] = $reason;
        }

        $bookingModel->where('bookingId', $bookingId)->set($updateData)->update();
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    //logic untuk rejected
    public function viewRejected()
    {
        $bookingModel = new BookingModel();
        $rejected = $bookingModel->where('status', 'rejected')->findAll();

        return view('bookings/manage_rejected', ['rejected' => $rejected]);
    }
    public function manageRejected($bookingId)
    {
        $bookingModel = new BookingModel();
        $booking = $bookingModel->where('bookingId', $bookingId)->where('status', 'rejected')->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found or not rejected.');
        }

        $bookingModel->where('bookingId', $bookingId)->delete();
        return redirect()->back()->with('success', 'Rejected booking deleted successfully.');
    }

    //logic untuk approved
    public function viewApproved()
    {
        $bookingModel = new BookingModel();
        $approved = $bookingModel->where('status', 'approved')->findAll();

        return view('bookings/manage_approved', ['approved' => $approved]);
    }
    public function manageApproved($bookingId)
    {
        $bookingModel = new BookingModel();
        $booking = $bookingModel->where('bookingId', $bookingId)->where('status', 'approved')->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found or not approved.');
        }

        $bookingModel->where('bookingId', $bookingId)->delete();
        return redirect()->back()->with('success', 'Approved booking deleted successfully.');
    }
}