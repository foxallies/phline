<?php

namespace FOXALLIES\Packages\Router\SimpleRouter\Handlers;

use Exception;
use FOXALLIES\Packages\Router\Http\Request;

interface IExceptionHandler
{
    /**
     * @param Request $request
     * @param Exception $error
     */
    public function handleError(Request $request, Exception $error): void;

}
