<?php

use FOXALLIES\Types\IMigration;

use Illuminate\Database\Capsule\Manager as Database;
use Illuminate\Database\Schema\Blueprint as Table;

class RolesMigrationTable implements IMigration
{

    public function boot()
    {
        Database::schema()->create('roles', function (Table $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Database::schema()->create('model_has_role', function (Table $table) {
            $table->unsignedBigInteger('role_id');
            $table->morphs('model');
            $table->index(['model_id', 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete();
            $table->primary(['role_id', 'model_type', 'model_id'], 'model_has_roles_role_model_type_primary');
        });
    }

    public function down()
    {
        Database::schema()->dropIfExists('roles');
        Database::schema()->dropIfExists('model_has_role');
    }
}
