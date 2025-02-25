<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Ramsey\Uuid\Uuid;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_uuid' => Uuid::uuid4()->toString(), // Generate unique UUID
                'role_name' => 'super_admin',
                'role_code' => 'SA',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'role_uuid' => Uuid::uuid4()->toString(),
                'role_name' => 'admin',
                'role_code' => 'AD',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert data into the role_ms table
        $this->db->table('role_ms')->insertBatch($data);
    }
}
