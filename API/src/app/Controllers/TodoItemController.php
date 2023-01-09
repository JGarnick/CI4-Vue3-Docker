<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TodoItem;
use CodeIgniter\API\ResponseTrait;

class TodoItemController extends BaseController
{
    use ResponseTrait;

    private $model, $itemModel;
    
    function __construct(){
        $this->model = new TodoItem();
    }

    public function update($id)
    {
        try {
            $data = $this->request->getVar();
            $this->model->save($data);
            return $this->respond(["message" => updated("Todo Item")]);
        } catch (\Exception $e) {
            return $this->failServerError();
            exit($e->getMessage()); 
        }
    }

}
