<?php

namespace FOXALLIES;

use League\MimeTypeDetection\FinfoMimeTypeDetector;
use FOXALLIES\Packages\Router\SimpleRouter\SimpleRouter;

class Router extends SimpleRouter
{
    public static function start(): void
    {
        // helpers
        require_once './core/libs/router-helpers.php';
        parent::setDefaultNamespace('\App\Controllers');

        // web route
        require_once './routes/web.php';
        // api route
        parent::group(['prefix' => '/api'], function () {
            require_once './routes/api.php';
        });
        $detector = new FinfoMimeTypeDetector();

        // public route
        parent::get('/', function ($path) use ($detector) {
            $path = rtrim($path, "/");
            if (file_exists("./public/{$path}")) {
                http_response_code(200);
                header('Content-Type: ' . $detector->detectMimeType("./public/{$path}", 'string contents'));
                require "./public/{$path}";
            } else
                http_response_code(404);
        })->setMatch('(.*)')->name('pub');

        parent::enableMultiRouteRendering(false);
        parent::start();
    }
}
