<?php

namespace App\Interfaces;

use CodeIgniter\HTTP\Request;
use CodeIgniter\HTTP\Response;
use App\Models\TodoList;

interface TodoListRepositoryInterface{

    public function getAll(Request $request, TodoList $model): Response;
}