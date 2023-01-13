<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class TodoList extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getTodoItems(){
        log_message("critical", "Firing for Todo List $this->id");
    }
}
