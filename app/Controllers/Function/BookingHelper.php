<?php

namespace App\Controllers\Function;

use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BookingHelper extends BaseController
{
    public function joinBook($roomId)//ni untuk admin
    {
        $db = \Config\Database::connect();
        $builder = $db->table('rooms');
        $builder->select('rooms.*, bookings.date, bookings.booking_start, bookings.booking_end');
        $builder->join('bookings', 'bookings.roomId = rooms.roomId', 'left');
        $builder->where('rooms.roomId', $roomId);
        return $builder->get()->getResultArray();
    }

    public function transform($joinedData)//untuk user view/room view
    {
    $rooms = [];
    foreach ($joinedData as $row) {
        $id = $row['roomId'];

        if (!isset($rooms[$id])) 
            {
            $rooms[$id] = [
                'roomId' => $row['roomId'],
                'roomName' => $row['roomName'],
                'bookings' => []
            ];
            }

        if (!empty($row['date'])) 
            {
            $rooms[$id]['bookings'][] = [
            'date' => $row['date'],
            'booking_start' => $row['booking_start'],
            'booking_end' => $row['booking_end']
            ];
            }

        }

        return array_values($rooms);
    }

    public function transformBook($roomId)
    {
        $joined = $this->joinBook($roomId);
        return $this->transform($joined);
    }

}

/*
kalau nak guna function
----
$helper = new BookingHelper();
$joined = $helper->joinBook(1);
$nested = $helper->transformBook($joined);
return $this->response->setJSON($nested);
----
join untuk admin
nested untuk room
*/