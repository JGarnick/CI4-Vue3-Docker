<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\TodoList;
use CodeIgniter\Test\Fabricator;

/**
 * @internal
 */
final class TodoListControllerTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    // For Migrations
    protected $migrate     = true;
    protected $migrateOnce = false;
    protected $refresh     = true;
    protected $namespace   = null;

    // For Seeds
    protected $seedOnce = false;
    protected $seed     = 'TodoListSeeder';
    protected $basePath = APPPATH . 'Database';

    protected $model, $fabricator;

    protected function setUp(): void
    {
        parent::setUp();
        $_SERVER['REMOTE_ADDR'] = "http://localhost";
        helper("response");
        $this->model = new TodoList();
        $this->fabricator = new Fabricator($this->model::class);
    }

    public function testCanGetPaginatedLists()
    {
        $headers = [
            'CONTENT_TYPE' => 'application/json',
        ];
        $result = $this->withHeaders($headers)->get("api/lists?perPage=4&page=1");
        $result->assertOK();

        $json = $result->getJSON();
        $result->assertJSONFragment(["message" => fetched($this->model::$name)]);
        dd($json);
    }
}
