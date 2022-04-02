<?php

namespace FOXALLIES\Packages\Router\Http\Middleware;

use FOXALLIES\Packages\Router\Http\Request;

interface IMiddleware
{
    /**
     * @param Request $request
     */
    public function handle(Request $request, ...$parameters): void;

}
