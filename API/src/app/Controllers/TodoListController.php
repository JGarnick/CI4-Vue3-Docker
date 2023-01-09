<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\{TodoList, TodoItem};
use CodeIgniter\API\ResponseTrait;

class TodoListController extends BaseController
{
    use ResponseTrait;

    private $model, $itemModel;
    
    function __construct(){
        $this->model = new TodoList();
        $this->itemModel = new TodoItem();
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
            $id = $this->model->insert($data);
            foreach($data->todos AS $todo_item){
                $todo_item->list_id = $id;
                $this->itemModel->insert($todo_item);
            }
            return $this->respond(["message" => created("Todo List")]);
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            
            return $this->respond(["message" => deleted("Todo List")]);
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }
}
