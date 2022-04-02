<?php

namespace App\Models;

use FOXALLIES\types\Authenticable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class User extends Model
{
    use Authenticable;

    protected $table = 'users';

    protected $fillable = [
        'token',
        'email',
        'fullname',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (&$model) {
            $model['token'] = Str::random(80);
        });
    }
}
