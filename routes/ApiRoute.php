<?php

namespace Routes;

use FOXALLIES\Router;
use FOXALLIES\Types\IRouter;

class ApiRoute implements IRouter
{
    public function boot(Router $router)
    {
        $router->get('/', function () {
            echo 'bbbb';
        });
    }
}