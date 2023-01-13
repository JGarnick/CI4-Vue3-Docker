<?php

namespace App;

use CodeIgniter\CodeIgniter;
use Ray\Di\Injector;
use Config\Services;
use App\Module\AppModule;

class MyCodeIgniter extends CodeIgniter
{
    protected function createController(){
        dd("THREE");
        $controllerName = $this->controller;

        $injector = new Injector(new AppModule);
        $controller = $injector->getInstance($controllerName);

        $controller->initController($this->request, $this->response, Services::logger());

        $this->benchmark->stop('controller_constructor');

        return $controller;
    }
}