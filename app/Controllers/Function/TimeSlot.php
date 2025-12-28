<?php

namespace App\Controllers\Function;

use App\Models\BookingModel;
use App\Controllers\BaseController;

class TimeSlot extends BaseController
{
    // Generate time slots for a room, marking booked slots
    public static function timeSlots($roomId, $date)
    {
        // Define slots in 30-min increments
        $slots = [
            '08:00','08:30','09:00','09:30','10:00','10:30',
            '11:00','11:30','12:00','12:30','13:00','13:30',
            '14:00','14:30','15:00','15:30','16:00','16:30','17:00',
        ];

        $bookingModel = new BookingModel();
        $bookedSlots = $bookingModel
            ->where('roomId', $roomId)
            ->where('date', $date)
            ->whereIn('status', ['approved', 'pending'])
            ->findAll();

        // Convert existing bookings to timestamp ranges
        $bookedRanges = [];
        foreach ($bookedSlots as $b) {
            $bookedRanges[] = [
                'start' => strtotime($b['book_start']),
                'end'   => strtotime($b['book_end']),
                'status' => $b['status']
            ];
        }

        $data = [];
        foreach ($slots as $slot) {
            $slotTime = strtotime($slot);
            $slotStatus = 'available';

            foreach ($bookedRanges as $range) {
                if ($slotTime >= $range['start'] && $slotTime < $range['end']) {
                    $slotStatus = $range['status']; // approved or pending
                    break;
                }
            }

            $data[] = [
                'book_start' => $slot,
                'status'     => $slotStatus,
            ];
        }

        return $data;
    }

    // Get consecutive available slots starting from a selected start
    public static function getAvailableEndTimes($roomId, $date, $selectedStart)
    {
        $slots = self::timeSlots($roomId, $date);
        $available = [];
        $startAdding = false;

        foreach ($slots as $slot) {
            if ($slot['book_start'] == $selectedStart) {
                $startAdding = true;
            }
            if ($startAdding && $slot['status'] == 'available') {
                $available[] = $slot['book_start'];
            }
            if ($startAdding && $slot['status'] != 'available') {
                break;
            }
        }

        return $available;
    }
}
