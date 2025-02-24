<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    protected $request;

    public function index()
    {
        return $this->respond([
            'email' => 'budi@email.com',
            'name' => 'budi',
            'password' => 'budi123',
            'roles' => ['Super Admin', 'admin'],
            'status' => 'active'
        ]);
    }

    public function insertAdmin()
    {
        $postData = $this->request->getJSON();
        var_dump($postData->email); 
        var_dump($postData->password);
        var_dump($postData->name);
        var_dump($postData->roles);
        var_dump($postData->status);
        return $this->respondCreated([
            'message' => 'Insert Success'
        ]);
    }
}
