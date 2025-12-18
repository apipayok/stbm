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
        'email',
        'date',
        'time_slot',
        'status',
        'reason'
    ];

    //make created/updted_at
    protected $useTimestamps = true;
}
