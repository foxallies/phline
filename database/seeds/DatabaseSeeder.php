<?php

use FOXALLIES\Types\ISeeder;
use Illuminate\Database\Schema\Builder as Manager;
use \FOXALLIES\data\auth\Role;
use \App\Models\User;

class DatabaseSeeder implements ISeeder
{

    public function boot(Manager $manager)
    {
        $this->roles();
        $this->users();
    }

    private function roles()
    {
        $role = new Role([
            'name' => 'admin'
        ]);
        $role->save();
    }

    private function users()
    {
        $user = new User([
            'email' => 'admin@google.com',
            'fullname' => 'admin',
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
        ]);
        $user->save();
        $user->assignRole('admin');
    }
}
