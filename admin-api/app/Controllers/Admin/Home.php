<?php

namespace App\Controllers\Admin;

use App\Models\Admin\AdminModel;
use CodeIgniter\API\ResponseTrait;
use Ramsey\Uuid\Uuid;
use App\Controllers\BaseController;
use App\Entities\Admin\Admin as AdminEntity;

class Home extends BaseController
{
    use ResponseTrait;
    protected $validation;

    function __construct()
    {
        $this->validation = \Config\Services::validation();
    }

    function index()
    {
        $adminModel = new AdminModel();
        $adminModel->orderBy('admin_name', 'ASC');
        $data = $adminModel->find();
        $result = [];
        foreach ($data as $dataRow) {
            array_push($result, [
                'id' => $dataRow->admin_uuid,
                'name' => $dataRow->admin_name,
                'email' => $dataRow->admin_email,
                'status' => $dataRow->admin_status
            ]);
        }
        return $this->respond([
            'data' => $result
        ]);
    }

    function insert()
    {
        $postData = $this->request->getJSON();
        $this->validation->setRules([
            'name' => [
                'label' => 'Admin name',
                'rules' => 'required|string'
            ],
            'email' => [
                'label' => 'Admin Email',
                'rules' => 'required|valid_email|string'
            ],
            'password' => [
                'label' => 'Admin password',
                'rules' => 'required|string'
            ],
        ]);

        if ($this->validation->run((array)$postData) === false) {
            return $this->fail($this->validation->getErrors());
        }

        $adminModel = new AdminModel();
        if ($adminModel->insert(new AdminEntity([
            'admin_uuid' => Uuid::uuid4()->toString(),
            'admin_name' => $postData->name,
            'admin_email' => $postData->email,
            'admin_password' => password_hash($postData->password, PASSWORD_BCRYPT),
            'admin_status' => filter_var($postData->status, FILTER_VALIDATE_BOOLEAN),
        ])) === false) {
            return $this->fail($adminModel->errors());
        }

        return $this->respondCreated([
            'message' => 'Data has been created'
        ]);
    }

    function detailUpdate(string $admin_uuid)
    {
        
        $adminModel = new AdminModel();
        $adminModel->where('admin_uuid', $admin_uuid);
        $data = $adminModel->first();
        if (empty($data)) {
            return $this->fail([
                'message' => 'Data Not Found'
            ]);
        }

        $result = [
            'id' => $data->admin_uuid,
            'name' => $data->admin_name,
            'email' => $data->admin_email,
            'status' => filter_var($data->admin_status, FILTER_VALIDATE_BOOLEAN),
        ];

        return $this->respond([
            'data' => $result,
            'message' => 'Data Updated Successfully'
        ]);
    }

    function update(string $uuid)
    {

        $adminModel = new AdminModel();
        $admin = $adminModel->where('admin_uuid', $uuid)->first();

        if (empty($admin)) {
            return $this->fail(['message' => 'Admin not found']);
        }

        $postData = $this->request->getJSON(); // put ambilnya pake getwarinput

        $this->validation->setRules([
            'name' => [
                'label' => 'Admin name',
                'rules' => 'required|string'
            ],
            'email' => [
                'label' => 'Admin Email',
                'rules' => 'required|valid_email'
            ],
        ]);

        if ($this->validation->run((array)$postData) === false) {
            return $this->fail($this->validation->getErrors());
        }

        $adminModel->where('admin_id', $admin->admin_id);
        $adminModel->set([
            'admin_name' => $postData->name,
            'admin_email' => $postData->email,
            'admin_status' => filter_var($postData->status, FILTER_VALIDATE_BOOLEAN),
        ]);
        if ($adminModel->update() === false) {
            return $this->fail($this->validation->getErrors());
        }

        return $this->respondUpdated([
            'message' => 'Data has been updated'
        ]);
    }

    function delete(string $admin_uuid)
    {
        $adminModel = new AdminModel();
        $adminModel->where('admin_uuid', $admin_uuid);

        if ($adminModel->delete() === false) {
            return $this->fail($adminModel->errors());
        }

        return $this->respondDeleted([
            'message' => 'Data has been deleted'
        ]);
    }
}
