<?php

use FOXALLIES\Router;

Router::get('/', function () {
    response()->json([
        'ok' => true,
        'message' => 'everything is ok!'
    ]);
});
