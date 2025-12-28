<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Booking extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'bookingId' => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'roomId'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, ],
            'roomName'  => ['type' => 'VARCHAR', 'constraint' => 255,],
            'staffno'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, ],
            'email'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'username'  => ['type' => 'VARCHAR', 'constraint' => 255,],
            'date'      => ['type' => 'DATE'],
            'book_start' => ['type' => 'VARCHAR', 'constraint' => 50,],
            'book_end' => ['type' => 'VARCHAR', 'constraint' => 50,],
            'status'    => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected'], 'null' => false,],
            'reason'    => ['type' => 'VARCHAR', 'constraint' => 255,],
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