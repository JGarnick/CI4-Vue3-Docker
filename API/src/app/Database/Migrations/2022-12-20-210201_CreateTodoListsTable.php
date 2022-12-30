<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTodoListsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id",
            "title" => [
                "type" => "VARCHAR",
                "constraint" => "100"
            ],
            "description" => [
                "type" => "TEXT",
                "default" => ""
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->createTable('todo_lists');
    }

    public function down()
    {
        $this->forge->dropTable("todo_lists");
    }
}
