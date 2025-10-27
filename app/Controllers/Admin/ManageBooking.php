<?php

namespace App\Controllers\Admin;

use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ManageBooking extends BaseController
{
    protected $bookingModel;
    protected $allowedStatuses = ['pending', 'approved', 'rejected'];

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function view($status = 'pending')
    {
        $bookings = $this->bookingModel->where('status', $status)->findAll();
        return view("bookings/manage_{$status}", ['bookings' => $bookings]);
    }

    public function updateStatus($bookingId)
    {
        $booking = $this->bookingModel->where('bookingId', $bookingId)->first();
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        } //cari booking

        $newStatus = $this->request->getPost('status');
        if (!in_array($newStatus, $this->allowedStatuses)) {
            return redirect()->back()->with('error', 'Invalid status.');
        } //cek status

        $updateData = ['status' => $newStatus,];
        if ($newStatus === 'rejected') {
            $updateData['reason'] = $this->request->getPost('reason') ?? 'No reason provided';
        } //update status

        $this->bookingModel->where('bookingId', $bookingId)->set($updateData)->update();
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function delete($bookingId)
    {
        $booking = $this->bookingModel->where('bookingId', $bookingId)->first();
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }

        $this->bookingModel->where('bookingId', $bookingId)->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }
}
