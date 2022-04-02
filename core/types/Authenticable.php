<?php

namespace FOXALLIES\types;

use FOXALLIES\data\auth\Role;
use function dd;

trait Authenticable
{
    public function hasRole($role)
    {
        dd($this);
    }

    public function assignRole(...$roles)
    {
        $roles = collect($roles)
            ->map(function ($role) {
                if (empty($role))
                    return false;

                return Role::firstWhere('name', $role);
            })
            ->filter(function ($role) {
                return $role instanceof Role;
            })
            ->map->id
            ->all();

        $this->roles()->sync($roles, false);

        return $this;
    }

    public function roles()
    {
        global $guard;
        $config = include "./config/auth.php";
        return $this->morphToMany(Role::class, 'model', 'model_has_role');
    }
}
