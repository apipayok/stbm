<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rooms extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'roomId'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'unique' => true],
            'roomName'  => ['type' => 'VARCHAR', 'constraint' => 255,],
            'status'    => ['type' => 'ENUM', 'constraint' => ['available', 'hidden'], 'default' => 'available', 'null' => false,],
            'created_at'=> ['type' => 'DATETIME', 'null' => true,],
            'updated_at'=> ['type' => 'DATETIME', 'null' => true,],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('rooms');
    }

    public function down()
    {
        $this->forge->dropTable('rooms');
    }
}
