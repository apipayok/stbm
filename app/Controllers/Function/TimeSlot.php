<?php

namespace App\Controllers\Function;

use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TimeSlot extends BaseController
{
     //ni untuk time slots(rooms/details)
    public static function timeSlots($roomId)
    {
        $slots = [
            '08:00 - 09:00',
            '09:00 - 10:00',
            '10:00 - 11:00',
            '11:00 - 12:00',
            '12:00 - 13:00',
            '13:00 - 14:00',
            '14:00 - 15:00',
            '15:00 - 16:00',
            '16:00 - 17:00',
        ];

        $bookingModel = new BookingModel();
        $bookedSlots = $bookingModel
            ->where('roomId', $roomId)
            ->where('date', date('Y-m-d'))
            ->whereIn('status', ['approved', 'pending'])
            ->findAll();

        $bookedSlotTimes = array_column($bookedSlots, 'time_slot');
        
        $data = [];

        foreach($slots as $slot)
        {
            $isBooked = in_array($slot, $bookedSlotTimes ?? []);
            $status = $isBooked ? (self::getSlotStatus($bookingModel, $roomId, $slot)) : 'available';

            $data[] = [
                'slot'     => $slot,
                'status'   => $status,
            ];
        }

        return $data;
    }
    private static function getSlotStatus($bookingModel, $roomId, $slot)
    {
        $booking = $bookingModel
            ->where('roomId', $roomId)
            ->where('date', date('Y-m-d'))
            ->where('time_slot', $slot)
            ->first();

        return $booking['status'] ?? 'available';
    }
}