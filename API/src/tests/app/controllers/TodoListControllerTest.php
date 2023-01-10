<?php

namespace App\Controllers;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;

/**
 * @internal
 */
final class TodoListControllerTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        $_SERVER['REMOTE_ADDR'] = "http://localhost";
    }

    public function testCanGetPaginatedLists()
    {
        $result = $this->call("get", "/api/lists");
        dd($result);
    }
}
