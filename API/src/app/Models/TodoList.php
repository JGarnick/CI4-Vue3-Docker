<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoList extends Model
{
    use \Tatter\Relations\Traits\ModelTrait;

    protected $with = 'todo_items';

    protected $DBGroup          = 'default';
    protected $table            = 'todo_lists';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    // protected $returnType       = \App\Entities\TodoList::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["title", "description"];

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

    public static $name = "Todo List";

    public function fake(\Faker\Generator &$faker){
        return [
            "title" => $faker->words(rand(1, 5), true),
            "description" => $faker->words(rand(3, 10), true)
        ];
    }
}
