<?php

use FOXALLIES\Types\IMigration;

use Illuminate\Database\Capsule\Manager as Database;
use Illuminate\Database\Schema\Blueprint as Table;

class BooksMigrationTable implements IMigration
{

    public function boot()
    {
        Database::schema()->create('books', function (Table $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    public function down()
    {
        Database::schema()->dropIfExists('books');
    }
}