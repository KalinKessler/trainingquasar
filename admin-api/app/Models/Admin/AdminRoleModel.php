<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class AdminRoleModel extends Model
{
    protected $table = 'role_ms';
    protected $primaryKey = false;
    protected $returnType = 'array';
    protected $allowedFields = ['role_uuid', 'role_id', 'role_name','role_code'];
    protected $useTimestamps = true;

}
