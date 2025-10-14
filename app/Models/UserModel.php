<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['staffno','username','password'];

    //make created/updted_at
    protected $useTimestamps = true;
}
