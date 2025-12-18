<?php

namespace App\Controllers;

use App\Libraries\Model;
use App\Controllers\Receipt;
use App\Controllers\BaseController;

class Booking extends BaseController
{
    public function check($roomId, $slot)
    {
        $bookings = Model::booking();
        $room = Model::room()->where('roomId', $roomId)->first();

        $slot = urldecode($slot);
        $date = Get('date') ?? date('Y-m-d');

        $existing = $bookings
            ->where('roomId', $roomId)
            ->where('date', $date)
            ->where('time_slot', $slot)
            ->first();

        if ($existing) {
            $book = 'unavailable';
        } else {
            $book = 'available';
        }
        return view('bookings/create_booking', ['book' => $book, 'room' => $room]);
    }

    public function preview($roomId)
    {
        $room = Model::room()->where('roomId', $roomId)->first();

        $slots = Post('slots');
        $date = Post('date');

        if (!$slots) {
            return redirect()->back()->with('error', 'Invalid Request.');
        }

        $data = [
            'room' => $room,
            'slots' => $slots,
            'date' => $date
        ];

        return view('bookings/preview', ['data' => $data]);
    }

    public function create($roomId)
    {
        $bookings = Model::booking();
        $room = Model::room()->where('roomId', $roomId)->first();

        $slots = Post('slots');
        $date = Post('date');
        $reason = Post('reason');

        if (!$slots || !$reason) {
            return redirect()->back()->with('error', 'Incomplete booking data.');
        }

        foreach ($slots as $slot) {
            $bookingId = 'BK-' . date('Ymd') . '-' . substr(uniqid(), -4);

            $data = [
                'bookingId' => $bookingId,
                'roomId'    => $roomId,
                'roomName'  => $room['roomName'],
                'staffno'   => session()->get('staffno'),
                'username'  => session()->get('username'),
                'email'     => session()->get('email'),
                'date'      => $date,
                'time_slot' => $slot,
                'status'    => 'pending',
                'reason'    => $reason
            ];
            //dd($data);

            $bookings->insert($data);
        }

        return redirect()->to('/rooms/' . $roomId . '?date=' . $date);
    }
}
