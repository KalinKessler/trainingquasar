<?php

namespace App\Entities\Admin;

use CodeIgniter\Entity\Entity;

class Admin extends Entity
{
    protected $attributes = [
        'admin_id' => null,
        'admin_uuid' => '',
        'admin_name' => '',
        'admin_email' => '',
        'admin_password' => '',
        'admin_status' => false,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];

    protected $casts =[
        'admin_uuid' => 'string',
        'admin_name' => 'string',
        'admin_email' => 'string',
        'admin_password' => 'string',
        'admin_status' => 'boolean',
    ];

    public function getStatus(): bool
    {
        return $this->attributes['admin_status'] === 't' ? true : false;
    }
}