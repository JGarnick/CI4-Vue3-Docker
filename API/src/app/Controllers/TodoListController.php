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
            return $this->failServerError($e->getMessage());
            exit;
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getVar();
            $id = $this->model->insert($data);
            foreach($data->todo_items AS $todo_item){
                $todo_item->list_id = $id;
                $this->itemModel->insert($todo_item);
            }
            return $this->respond(["message" => created("Todo List")]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
            exit;
        }
    }

    public function update($id)
    {
        try {
            $data = $this->request->getVar();
            $this->model->save($data);

            //Rather than complicated comparison logic, for simplicity's sake, remove all existing relationships and simply add all passed up items
            $existing_todo_items = $this->itemModel->where("list_id", $id)->findAll();
            foreach ($existing_todo_items as $todo_item) {
                $this->itemModel->delete($todo_item["id"]);
            }

            //Now just add all passed up items
            foreach( $data->todo_items AS $todo_item ){
                $todo_item->list_id = $id;
                $this->itemModel->insert($todo_item);
            }
            return $this->respond(["message" => updated("Todo List")]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
            exit;
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            
            return $this->respond(["message" => deleted("Todo List")]);
        } catch (\Exception $e) {
            return $this->failServerError("Internal Server Error", 500, $e->getMessage());
            exit;
        }
    }
}
