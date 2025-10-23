<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'bookingId',
        'roomId',
        'roomName',
        'staffno',
        'username',
        'date',
        'time_slot',
        'status',
    ];

    //make created/updted_at
    protected $useTimestamps = true;
}
