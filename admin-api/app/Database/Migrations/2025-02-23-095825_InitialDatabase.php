<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitialDatabase extends Migration
{
    public function up()
{
    // admin_ms (Admin Table)
    $this->forge->addField([
        'admin_id' => [
            'type'           => 'BIGINT',
            'constraint'     => 5,
            'auto_increment' => true,
            'unsigned'       => true
        ],
        'admin_uuid' => [
            'type'       => 'CHAR',
            'constraint' => 36,
            'unique'     => true
        ],
        'admin_name' => [
            'type'       => 'VARCHAR',
            'constraint' => 100
        ],
        'admin_email' => [
            'type'       => 'VARCHAR',
            'constraint' => 100,
            'unique'     => true
        ],
        'admin_password' => [
            'type'       => 'VARCHAR',
            'constraint' => 255
        ], 
        'admin_status' => [
            'type'    => 'BOOLEAN',
        ], 
        'created_at' => [
            'type' => 'DATETIME',
        ],
        'updated_at' => [
            'type' => 'DATETIME',
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true
        ],
    ]);
    $this->forge->addKey('admin_id', true);
    $this->forge->createTable('admin_ms');

    // role_ms (Role Table)
    $this->forge->addField([
        'role_id' => [
            'type'           => 'BIGINT',
            'constraint'     => 5,
            'auto_increment' => true,
            'unsigned'       => true
        ],
        'role_uuid' => [
            'type'       => 'CHAR',
            'constraint' => 36,
            'unique'     => true
        ],
        'role_name' => [
            'type'       => 'VARCHAR',
            'constraint' => 36,
        ],
        'role_code' => [
            'type'       => 'CHAR',
            'constraint' => 2,
        ],
        'created_at' => [
            'type' => 'DATETIME',
        ],
        'updated_at' => [
            'type' => 'DATETIME',
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true
        ],
    ]);
    $this->forge->addKey('role_id', true);
    $this->forge->createTable('role_ms');

    // admin_role_ms (Admin-Role Relationship Table)
    $this->forge->addField([
        'admin_id' => [
            'type'     => 'BIGINT',
            'unsigned' => true,
        ],
        'role_id' => [
            'type'     => 'BIGINT',
        ],
        'role_code' => [
            'type'       => 'CHAR',
            'constraint' => 2,
        ],
        'created_at' => [
            'type' => 'DATETIME',
        ],
        'updated_at' => [
            'type' => 'DATETIME',
        ],
        'deleted_at' => [
            'type' => 'DATETIME',
            'null' => true
        ],
    ]);

    $this->forge->addKey(['admin_id'], true);

    $this->forge->createTable('admin_role_ms');
}

    public function down()
    {
        $this->forge->dropTable('admin_role_ms', true);
        $this->forge->dropTable('role_ms', true);
        $this->forge->dropTable('admin_ms', true);
    }
}