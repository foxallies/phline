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
            $table->string('token', 80)->index()->unique();
            $table->string('email')->index()->unique();
            $table->string('fullname');
            $table->string('password', 60);
            $table->timestamps();
        });
    }

    public function down()
    {
        Database::schema()->dropIfExists('users');
    }
}
