<?php

namespace App\Controllers\Function;

use App\Controllers\BaseController;
use App\Models\BookingModel;

class BookingHelper extends BaseController
{
    /**
     * Get bookings joined with room info (for admin view)
     */
    public function joinBook($roomId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rooms')
            ->select('rooms.*, bookings.date, bookings.book_start, bookings.book_end, bookings.status')
            ->join('bookings', 'bookings.roomId = rooms.roomId', 'left')
            ->where('rooms.roomId', $roomId);

        return $builder->get()->getResultArray();
    }

    /**
     * Transform joined bookings into nested structure for user view
     */
    public function transform($joinedData)
    {
        $rooms = [];

        foreach ($joinedData as $row) {
            $id = $row['roomId'];

            if (!isset($rooms[$id])) {
                $rooms[$id] = [
                    'roomId'   => $row['roomId'],
                    'roomName' => $row['roomName'],
                    'bookings' => []
                ];
            }

            if (!empty($row['date'])) {
                $rooms[$id]['bookings'][] = [
                    'date'       => $row['date'],
                    'book_start' => $row['book_start'],
                    'book_end'   => $row['book_end'],
                    'status'     => $row['status'] ?? 'pending',
                ];
            }
        }

        return array_values($rooms);
    }

    /**
     * Convenience method to get transformed bookings for a room
     */
    public function transformBook($roomId)
    {
        $joined = $this->joinBook($roomId);
        return $this->transform($joined);
    }

    /**
     * Get booked time ranges for a room on a specific date
     * Useful to filter available slots
     */
    public function getBookedRanges($roomId, $date = null)
    {
        $date ??= date('Y-m-d');

        $bookingModel = new BookingModel();
        $bookings = $bookingModel
            ->where('roomId', $roomId)
            ->where('date', $date)
            ->whereIn('status', ['approved', 'pending'])
            ->findAll();

        $ranges = [];
        foreach ($bookings as $b) {
            $ranges[] = [
                'start'  => strtotime($b['book_start']),
                'end'    => strtotime($b['book_end']),
                'status' => $b['status'],
            ];
        }

        return $ranges;
    }

    /**
     * Generate available time slots for a room on a given date,
     * automatically skipping booked ranges
     */
    public static function timeSlots($roomId, $date = null)
    {
        $date ??= date('Y-m-d');

        $slots = [
            '08:00',
            '08:30',
            '09:00',
            '09:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '12:00',
            '12:30',
            '13:00',
            '13:30',
            '14:00',
            '14:30',
            '15:00',
            '15:30',
            '16:00',
            '16:30',
            '17:00',
        ];

        $helper = new self();
        $bookedRanges = $helper->getBookedRanges($roomId, $date);

        $data = [];

        foreach ($slots as $slot) {
            $slotTime = strtotime($slot);
            $status = 'available';

            foreach ($bookedRanges as $range) {
                if ($slotTime >= $range['start'] && $slotTime < $range['end']) {
                    $status = $range['status'] === 'pending' ? 'pending' : 'booked';
                    break;
                }
            }

            $data[] = [
                'book_start' => $slot,
                'status'     => $status
            ];
        }

        return $data;
    }
}

/*
Usage:

$helper = new BookingHelper();

// Admin view
$joined = $helper->joinBook(1);

// User view
$nested = $helper->transformBook(1);

// Available slots for a room today
$timeSlots = BookingHelper::timeSlots(1);

// Available slots for a room on specific date
$timeSlots = BookingHelper::timeSlots(1, '2025-12-20');
*/
