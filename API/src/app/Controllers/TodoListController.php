<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TodoList;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Request;

class TodoListController extends BaseController
{
    use ResponseTrait;
    
    function __construct(){
        $this->model = new TodoList();
    }

    public function index()
    {
        try{
            //TODO: Create permissions and check for authorization
            $lists = $this->model->findAll();
            
            return $this->respond(["data" => $lists, "message" => fetched("ToDo Lists")]);
            
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }

    public function create()
    {
        try {
            return $this->respond(["data" => $this->request->getPost(), "message" => fetched("ToDo Lists")]);
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }
}
