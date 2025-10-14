<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Booking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'roomId'    => ['type' => 'VARCHAR', 'constraint' => 255,],
            'roomName'  => ['type' => 'VARCHAR', 'constraint' => 255,],
            'date'      => ['type' => 'DATE'],
            'booking_start' => ['type' => 'TIME'],
            'booking_end'   => ['type' => 'TIME'],
            'created_at'=> ['type' => 'DATETIME', 'null' => true,],
            'updated_at'=> ['type' => 'DATETIME', 'null' => true,],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
