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
            //I don't check against the URI matched ID because I'm setting it specifically from the data prop on the frontend
            $data = $this->request->getVar();
            $this->model->save($data);
            return $this->respond(["message" => updated("Todo Item")]);
        } catch (\Exception $e) {
            return $this->failServerError($e->getMessage());
            exit;
        }
    }

}
