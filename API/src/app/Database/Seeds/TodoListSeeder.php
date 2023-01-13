<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;
use App\Models\TodoList;

class TodoListSeeder extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(TodoList::class);
        $fabricator->create(10);
    }
}