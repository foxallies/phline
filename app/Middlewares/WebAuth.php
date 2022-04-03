<?php

namespace App\Middlewares;

use FOXALLIES\Auth;
use FOXALLIES\Packages\Router\Http\Middleware\IMiddleware;
use FOXALLIES\Packages\Router\Http\Request;

class WebAuth implements IMiddleware
{
    public function handle(Request $request, $params): void
    {
        $user = Auth::user();
        if ($user) {
            if (count($params) > 0)
                if (!$user->hasRole($params))
                    $this->denied();
        } else
            $this->denied();
    }

    private function denied()
    {
        response()->httpCode(403)->redirect('/');
    }
}
