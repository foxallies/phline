<?php

namespace App\Controllers;

use App\Models\Book;
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

        $book = new Book([
            'user_id' => $user['id'],
            'name' => 'my-book'
        ]);
        $book->save();
        $user = $user->with('books')->find($user)[0];
        echo json_encode($user);
    }
}