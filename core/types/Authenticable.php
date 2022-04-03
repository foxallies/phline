<?php

namespace FOXALLIES\types;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use FOXALLIES\data\auth\Role;
use Illuminate\Support\Str;
use function dd;

trait Authenticable
{
    public function roles()
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_role');
    }

    public function hasRole($roles)
    {
        if (is_string($roles))
            return $this->roles->contains('name', $roles);
        else if (is_array($roles))
            foreach ($roles as $role)
                if ($this->hasRole($role))
                    return true;
        return false;
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

    public function generateAuthorization(bool $newToken = false)
    {
        $config = config('auth');
        if ($newToken) {
            $this[$config['api']['key']] = Str::random(80);
            $this->save();
        }
        return JWT::encode($this->toArray(), $config['api']['jwt_secret'], $config['api']['algorithm']);
    }
}
