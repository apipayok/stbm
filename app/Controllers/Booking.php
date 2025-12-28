<?php

namespace App\Controllers;

use App\Libraries\Model;
use App\Controllers\BaseController;
use App\Controllers\Function\TimeSlot;

class Booking extends BaseController
{
    public function create($roomId)
    {
        $bookings = Model::booking();
        $room = Model::room()->where('roomId', $roomId)->first();

        $bookStart = Post('book_start');
        $bookEnd   = Post('book_end');
        $date      = Post('date');
        $reason    = Post('reason');

        if (!$bookStart || !$bookEnd || !$reason) {
            return redirect()->back()->with('error', 'Incomplete booking data.');
        }

        // Validate time
        if (strtotime($bookEnd) <= strtotime($bookStart)) {
            return redirect()->back()->with('error', 'End time must be after start time.');
        }

        // Check conflicts for this date
        $conflict = $bookings
            ->where('roomId', $roomId)
            ->where('date', $date)
            ->where('book_start <', $bookEnd)
            ->where('book_end >', $bookStart)
            ->first();

        if ($conflict) {
            return redirect()->back()->with('error', 'Selected time overlaps with an existing booking.');
        }

        // Insert booking
        $bookingId = 'BK-' . date('Ymd') . '-' . substr(uniqid(), -4);
        $bookings->insert([
            'bookingId' => $bookingId,
            'roomId'    => $roomId,
            'roomName'  => $room['roomName'],
            'staffno'   => session()->get('staffno'),
            'username'  => session()->get('username'),
            'email'     => session()->get('email'),
            'date'      => $date,
            'book_start'=> $bookStart,
            'book_end'  => $bookEnd,
            'status'    => 'pending',
            'reason'    => $reason
        ]);

        return redirect()->to('/rooms/' . $roomId . '?date=' . $date)
                         ->with('success', 'Booking created successfully.');
    }

    // Display booking page with slots for selected date
    public function view($roomId)
    {
        $room = Model::room()->where('roomId', $roomId)->first();
        $selectedDate = Get('date') ?? date('Y-m-d');

        // Get slots for this room & selected date
        $timeSlots = TimeSlot::timeSlots($roomId, $selectedDate);

        return view('bookings/create_booking', [
            'room' => $room,
            'timeSlots' => $timeSlots,
            'selectedDate' => $selectedDate
        ]);
    }
}
