<?php

namespace FOXALLIES;

use Routes\ApiRoute;
use Routes\WebRoute;

class Framework
{
    function __construct()
    {

    }

    public function start()
    {
        $this->database();
        $this->routes();
    }

    // configure routes

    private function database()
    {

    }

    private function routes()
    {
        $router = new Router();

        $router->setNamespace('\App\Controllers');
        // web route
        (new WebRoute())->boot($router);
        // api route
        $router->mount('/api', function () use ($router) {
            (new ApiRoute())->boot($router);
        });
        $router->run();
    }
}