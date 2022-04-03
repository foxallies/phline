<?php

namespace FOXALLIES;

use eftec\bladeone\BladeOne;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;

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
        $this->config();
        $this->database();
        $this->routes();
        $this->auth();
    }

    public function config()
    {
        $GLOBALS['config']['auth'] = include_once "./config/auth.php";
        $GLOBALS['config']['database'] = include_once "./config/database.php";
        require_once './core/libs/config.php';
    }

    // configure database
    public function database()
    {
        $this->database = new DatabaseManager();
        $connections = config('database');

        foreach ($connections as $name => $connection)
            $this->database->addConnection($connection, $name);

        $this->database->setEventDispatcher(new Dispatcher(new Container));

        $this->database->setAsGlobal();
        $this->database->bootEloquent();
    }

    // configure routes
    private function routes()
    {
        $views = './views';
        $cache = './.cache';

        global $blade;
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

        require_once 'core/libs/view.php';

        Router::start();
    }

    private function auth()
    {

    }
}
