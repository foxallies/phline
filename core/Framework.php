<?php

namespace FOXALLIES;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Routes\ApiRoute;
use Routes\WebRoute;

use Illuminate\Database\Capsule\Manager as DatabaseManager;

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

    // configure database
    public function database()
    {
        $database = new DatabaseManager();
        $connections = include './config/databse.php';

        foreach ($connections as $name => $connection)
            $database->addConnection($connection, $name);

        $database->setEventDispatcher(new Dispatcher(new Container));

        $database->setAsGlobal();
        $database->bootEloquent();
    }

    // configure routes
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