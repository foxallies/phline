<?php

namespace FOXALLIES;

use FOXALLIES\data\auth\AuthenticableModel;

class Auth
{
    /**
     * @var AuthenticableModel
     */
    private static $_user;

    public static function attempt(array $values): bool
    {
        $config = config('auth');
        $model = $config['web']['model'];
        $key = $config['web']['key'];
        $data = $model::where($values);
        if ($data->count() >= 1) {
            $auth = $data->first()[$key];
            if (!is_null($auth)) {
                $_SESSION['auth'] = $auth;
                return true;
            }
        }
        return false;
    }

    /***
     * @return false|AuthenticableModel
     */
    public static function user()
    {
        $config = config('auth');
        $model = $config['web']['model'];
        $key = $config['web']['key'];
        if (is_null(self::$_user)) {
            self::$_user = $model::where([$key => $_SESSION['auth']])->first() ?? false;
            return self::$_user;
        } else
            return self::$_user;
    }
}
