<?php

declare(strict_types=1);

namespace App\Module;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;
use Config\Services;
use App\Repositories\TodoListRepository;

class AppModule extends AbstractModule
{
    protected function configure()
    {
        dd("ONE");
        // $this->bind(Validation::class)->toInstance(Services::validation());
        $this->bind(TodoListRepository::class)->in(Scope::SINGLETON);
    }
}