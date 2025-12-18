<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $password = password_hash('sadmin', PASSWORD_DEFAULT);

        $data = [
            'staffno'    => '1960',
            'username'   => 'SUPER',
            'password'   => $password,
            'is_admin'   => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $exists = $this->db->table('users')->where('username', 'admin')->get()->getRow();

        if (!$exists) {
            $this->db->table('users')->insert($data);
            echo "Admin user created.\n";
        } else {
            echo "Admin user already exists.\n";
        }
    }
}
