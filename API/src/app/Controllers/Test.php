<?php

namespace App\Controllers;

use App\Models\TodoList;

class Test extends BaseController
{
    public function test()
    {
        try{
            // $listModel = new TodoList();
            // $data = [
            //     "title" => "My Second List",
            //     "description" => "This is the description"
            // ];
            
            // $list->save($data);

            // $list = $listModel->findAll();
            // var_dump($list);die;
            
            return $this->response->setJSON(["success" => true, "message" => "Hello from the server!"]);
            
        } catch (\Exception $e) {

            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage()); 
         
        }
    }
}
