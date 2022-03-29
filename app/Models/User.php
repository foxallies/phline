<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'fullname',
        'username',
        'password'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'user_id', 'id');
    }
}