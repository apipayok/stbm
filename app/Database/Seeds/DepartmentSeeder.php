<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Parent departments
            [
                'DID' => 1,
                'Dparent' => null,
                'Ddesc' => 'Bahagian Teknologi Maklumat',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'DID' => 2,
                'Dparent' => null,
                'Ddesc' => 'Bahagian Pengurusan',
                'created_at' => date('Y-m-d H:i:s')
            ],

            // Child departments
            [
                'DID' => 3,
                'Dparent' => 1,
                'Ddesc' => 'Unit Sistem',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'DID' => 4,
                'Dparent' => 1,
                'Ddesc' => 'Unit Infrastruktur',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'DID' => 5,
                'Dparent' => 2,
                'Ddesc' => 'Unit Pentadbiran',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('departments')->insertBatch($data);
    }
}
