<?php

use FOXALLIES\Types\IMigration;

use Illuminate\Database\Capsule\Manager as Database;
use Illuminate\Database\Schema\Blueprint as Table;

class UserMigrationTable implements IMigration
{

    public function boot()
    {
        Database::schema()->create('users', function (Table $table) {
            $table->id();
            $table->string('fullname');
            $table->string('username');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Database::schema()->dropIfExists('users');
    }
}