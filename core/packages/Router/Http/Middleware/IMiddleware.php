<?php

namespace FOXALLIES\Packages\Router\Http\Middleware;

use FOXALLIES\Packages\Router\Http\Request;

interface IMiddleware
{
    /**
     * @param Request $request
     * @param $params
     */
    public function handle(Request $request, $params): void;

}
