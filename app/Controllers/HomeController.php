<?php

namespace App\Controllers;

use App\Models\User;
use FOXALLIES\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', ['title' => 'home page !']);
    }

    public function get_users()
    {
        $users = User::all();
        return [
            'ok' => true,
            'data' => $users
        ];
    }
}
