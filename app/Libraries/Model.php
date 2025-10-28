<?php
//refactor kemudian

namespace App\Libraries;

use App\Models\UserModel;
use App\Models\RoomModel;
use App\Models\BookingModel;
use App\Models\AnnouncementModel;

class Model
{
    protected static $instances = [];

    public static function booking()
    {
        return self::$instances['booking'] ??= new BookingModel();
    }

    public static function user()
    {
        return self::$instances['user'] ??= new UserModel();
    }

    public static function room()
    {
        return self::$instances['room'] ??= new RoomModel();
    }

    public static function announcement()
    {
        return self::$instances['announcement'] ??= new AnnouncementModel();
    }
}

/* usage:

$bookings = Model::booking()->findAll();
$users = Model::user()->findAll();
$rooms = Model::room()->findAll();

*/

