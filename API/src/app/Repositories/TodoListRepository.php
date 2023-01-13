<?php

namespace App\Repositories;

use App\Interfaces\TodoListRepositoryInterface;
use CodeIgniter\HTTP\Request;
use CodeIgniter\API\ResponseTrait;

class TodoListRepository implements TodoListRepositoryInterface{
    use ResponseTrait;

    public function getAll(Request $request, TodoList $model){
        $page_data = [
            "perPage" => $request->getGet('perPage') ?? 4,
            "page"    => $request->getGet('page') ?? 1,
            "total"   => $model->countAll()
        ];
        
        //If passed up through query params, 'perPage' and 'page' become strings. Cast to int for consistency
        $data = [
            'lists' => $model->paginate((int)$page_data["perPage"], "default", (int)$page_data["page"]),
            'page_data' => $page_data
        ];
        
        return $this->respond(["data" => $data, "message" => fetched($model::$name)]);
    }
}