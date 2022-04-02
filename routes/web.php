<?php

use FOXALLIES\Router;

Router::get('/', [\App\Controllers\HomeController::class, 'index']);
