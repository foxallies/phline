<?php

namespace App\Controllers;

use App\Models\User;

class HomeController
{
    public function index()
    {
        $user = new User([
            'fullname' => 'admin',
            'username' => 'admin',
            'password' => '12345678',
        ]);
        $user->save();

        echo json_encode($user);
    }
}