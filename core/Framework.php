<?php

namespace FOXALLIES;

use eftec\bladeone\BladeOne;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use League\MimeTypeDetection\FinfoMimeTypeDetector;
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
        $views = './views';
        $cache = './.cache';

        global $blade;
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

        require_once 'core/libs/view.php';
        $router = new Router();

        $router->setNamespace('\App\Controllers');
        // web route
        (new WebRoute())->boot($router);
        // api route
        $router->mount('/api', function () use ($router) {
            (new ApiRoute())->boot($router);
        });
        $detector = new FinfoMimeTypeDetector();
        $router->get('(.*)', function ($path) use ($detector) {
            if (file_exists("./public/{$path}")) {
                header('Content-Type: ' . $detector->detectMimeType("./public/{$path}", 'string contents'));
                require "./public/{$path}";
            }
        });
        $router->run();
    }
}
