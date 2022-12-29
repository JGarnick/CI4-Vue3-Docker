<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTodoItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id",
            "list_id" => [
                "type" => "INT",
                "constraint" => 9,
                "null" => false
            ],
            "title" => [
                "type" => "VARCHAR",
                "constraint" => "100"
            ],
            "description" => [
                "type" => "TEXT",
                "null" => true
            ]
        ]);

        $this->forge->addForeignKey('list_id', 'todo_lists', 'id', '', 'CASCADE');
        $this->forge->createTable('todo_items');
    }

    public function down()
    {
        $this->forge->dropTable("todo_items");
    }
}
