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
