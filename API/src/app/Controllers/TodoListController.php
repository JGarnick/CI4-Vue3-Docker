<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\{TodoList, TodoItem};
use CodeIgniter\API\ResponseTrait;
// use CodeIgniter\HTTP\Request;
// use App\Interfaces\TodoListRepositoryInterface;

class TodoListController extends BaseController
{
    use ResponseTrait;

    private $model, $itemModel;
    // private $repository;
    
    function __construct(){
        $this->model = new TodoList();
        $this->itemModel = new TodoItem();
    }

    //Testing dependency injection
    // function __construct(TodoListRepositoryInterface $repository){
    //     $this->model = new TodoList();
    //     $this->itemModel = new TodoItem();
    //     $this->repository = $repository;
    // }

    public function index()
    {
        try{
            //TODO: Create permissions and check for authorization
            $page_data = [
                "perPage" => $this->request->getGet('perPage') ?? 4,
                "page"    => $this->request->getGet('page') ?? 1,
                "total"   => $this->model->countAll()
            ];
            
            //If passed up through query params, 'perPage' and 'page' become strings. Cast to int for consistency
            $data = [
                'lists' => $this->model->paginate((int)$page_data["perPage"], "default", (int)$page_data["page"]),
                'page_data' => $page_data
            ];
            
            return $this->respond(["data" => $data, "message" => fetched($this->model::$name ?? $this->model::class)]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
            exit;
        }
    }

    //Testing dependency injection
    // public function index(Request $request)
    // {
    //     try{
    //         //TODO: Create permissions and check for authorization
    //         return $this->repository->getAll($request, $this->model);
    //     } catch (\Exception $e) {
    //         return $this->failServerError($e->getMessage());
    //         exit;
    //     }
    // }

    public function create()
    {
        try {
            $data = $this->request->getVar();
            $id = $this->model->insert($data);
            foreach($data->todo_items AS $todo_item){
                $todo_item->list_id = $id;
                $this->itemModel->insert($todo_item);
            }
            return $this->respond(["message" => created($this->model::$name)]);
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
            return $this->respond(["message" => updated($this->model::$name)]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
            exit;
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            
            return $this->respond(["message" => deleted($this->model::$name)]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
            exit;
        }
    }
}
