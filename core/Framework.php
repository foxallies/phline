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
    /***
     * @var DatabaseManager $database
     */
    public $database;

    function __construct()
    {

    }

    public function start()
    {
        session_start();
        $this->database();
        $this->routes();
        $this->auth();
    }

    // configure database
    public function database()
    {
        $this->database = new DatabaseManager();
        $connections = include './config/databse.php';

        foreach ($connections as $name => $connection)
            $this->database->addConnection($connection, $name);

        $this->database->setEventDispatcher(new Dispatcher(new Container));

        $this->database->setAsGlobal();
        $this->database->bootEloquent();
    }

    // configure routes
    private function routes()
    {
        global $guard;
        $guard = 'web';

        $views = './views';
        $cache = './.cache';

        global $blade;
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

        require_once 'core/libs/view.php';
        $router = new Router();

        $router->setBasePath('/');
        $router->setNamespace('\App\Controllers');
        // web route
        (new WebRoute())->boot($router);
        // api route
        $router->mount('/api', function () use ($router, &$guard) {
            $guard = 'api';
            (new ApiRoute())->boot($router);
        });
        $detector = new FinfoMimeTypeDetector();
        $router->get('(.*)', function ($path) use ($detector) {
            if (file_exists("./public/{$path}")) {
                http_response_code(200);
                header('Content-Type: ' . $detector->detectMimeType("./public/{$path}", 'string contents'));
                require "./public/{$path}";
            } else
                http_response_code(404);
        });
        $router->run();
    }

    private function auth()
    {

    }
}
