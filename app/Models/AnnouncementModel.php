<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'content',
    ];

    //make created/updted_at
    protected $useTimestamps = true;
}
