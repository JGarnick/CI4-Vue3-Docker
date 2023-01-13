<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\Fabricator;
use App\Models\TodoItem;

class TodoItemSeeder extends Seeder
{
    public function run()
    {
        $fabricator = new Fabricator(TodoItem::class);
        $fabricator->create(20);
    }
}