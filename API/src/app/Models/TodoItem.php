<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoItem extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'todo_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["title", "description", "complete", "content", "list_id"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public static $name = "Todo Item";

    public function fake(\Faker\Generator &$faker){
        $listModel = new TodoList();
        $list_ids = $listModel->findColumn("id");
        
        return [
            "title" => $faker->words(rand(1, 5), true),
            "description" => $faker->words(rand(3, 10), true),
            "content" => $faker->text(rand(50, 300)),
            "list_id" => $list_ids[array_rand($list_ids)],
            "complete" => $faker->boolean()
        ];
    }
}
