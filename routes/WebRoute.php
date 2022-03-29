<?php

namespace Routes;

use FOXALLIES\Router;
use FOXALLIES\Types\IRouter;

class WebRoute implements IRouter
{
    public function boot(Router $router)
    {
        $router->get('/', [\App\Controllers\HomeController::class, 'index']);
    }
}