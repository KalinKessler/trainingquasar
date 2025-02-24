<?php

namespace App\Models\Admin;

use App\Models\BaseModel;

class AdminModel extends BaseModel
{
    protected $table = 'admin_ms';
    protected $primaryKey = 'admin_id';
    protected $returnType = "App\Entities\Admin\Admin";
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'admin_uuid',
        'admin_name',
        'admin_email',
        'admin_password',
        'admin_status',
    ];
    protected $validationRules = [
        'admin_uuid' => [
            'label' => 'Admin ID',
            'rules' => 'required|string',
        ],
        'admin_name' => [
            'label' => 'Admin Name',
            'rules' => 'required|string',
        ],
        'admin_email' => [
            'label' => 'Admin Email',
            'rules' => 'required|valid_email',
        ],
        'admin_password' => [
            'label' => 'Admin Password',
            'rules' => 'required|string',
        ],
        
    ];
}
