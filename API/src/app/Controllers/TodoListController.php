<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TodoList;
use CodeIgniter\API\ResponseTrait;

class TodoListController extends BaseController
{
    use ResponseTrait;

    private $model;
    
    function __construct(){
        $this->model = new TodoList();
    }

    public function index()
    {
        try{
            //TODO: Create permissions and check for authorization
            $lists = $this->model->findAll();
            
            return $this->respond(["data" => $lists, "message" => fetched("Todo Lists")]);
            
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getVar();
            $this->model->insert($data);
            return $this->respond(["message" => created("Todo List")]);
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }
}
