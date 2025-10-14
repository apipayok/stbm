<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'roomId',
        'roomName', 
        'date', 
        'booking_start', 
        'booking_end'
    ];

    //make created/updted_at
    protected $useTimestamps = true;
}
