<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\User;

class HomeController
{
    public function index()
    {
        $users = User::all();
        return [
            'ok' => true,
            'data' => $users
        ];
    }
}
