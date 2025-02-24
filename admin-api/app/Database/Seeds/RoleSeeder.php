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
            ],
            [
                'role_uuid' => Uuid::uuid4()->toString(),
                'role_name' => 'admin',
            ]
        ];

        // Insert data into the role_ms table
        $this->db->table('role_ms')->insertBatch($data);
    }
}
