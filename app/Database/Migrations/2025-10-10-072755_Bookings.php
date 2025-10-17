<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Booking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'roomId'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, ],
            'roomName'  => ['type' => 'VARCHAR', 'constraint' => 255,],
            'staffno'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, ],
            'username'  => ['type' => 'VARCHAR', 'constraint' => 255,],
            'date'      => ['type' => 'DATE'],
            'time_slot' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => 'pending'],
            'status'    => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected'], 'null' => false,],
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