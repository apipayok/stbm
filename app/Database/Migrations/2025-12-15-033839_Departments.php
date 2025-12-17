<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Departments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'DID'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'Dparent'     => ['type' => 'INT', 'constraint' => 20, 'null' => true, ],
            'Ddesc'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, ],
            'created_at'=> ['type' => 'DATETIME', 'null' => true,],
            'updated_at'=> ['type' => 'DATETIME', 'null' => true,],
        ]);
        $this->forge->addKey('DID', true);
        $this->forge->createTable('departments');
    }

    public function down()
    {
        $this->forge->dropTable('departments');
    }
}
