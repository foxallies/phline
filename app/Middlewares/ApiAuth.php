<?php

namespace App\Middlewares;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use FOXALLIES\Packages\Router\Http\Middleware\IMiddleware;
use FOXALLIES\Packages\Router\Http\Request;

class ApiAuth implements IMiddleware
{
    public function handle(Request $request, $params): void
    {
        $config = config('auth');
        $authorization = $request->getHeader($config['api']['header']);
        if ($authorization) {
            try {
                $decoded = JWT::decode($authorization, new Key($config['api']['jwt_secret'], $config['api']['algorithm']));
                $key = $config['api']['key'];
                $token = $decoded->$key;

                $user = User::firstWhere($key, $token);
                if ($user) {
                    if (count($params) > 0)
                        if (!$user->hasRole($params))
                            $this->denied();
                } else
                    $this->denied();
            } catch (\Exception $invalidException) {
                $this->denied();
            }
        } else
            $this->denied();
    }

    private function denied()
    {
        response()->httpCode(403)->json([
            'ok' => false,
            'message' => 'access denied'
        ]);
    }
}
