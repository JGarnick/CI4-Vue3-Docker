<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TodoList;
use CodeIgniter\API\ResponseTrait;

class TodoListController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try{
            //TODO: Create permissions and check for authorization
            $listModel = new TodoList();
            $lists = $listModel->findAll();
            
            return $this->respond(["details" => $lists]);
            
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }
}
