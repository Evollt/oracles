<?php

namespace App\Repositories\User;

use App\Models\User\Role;
use App\Repositories\Repository;

class RoleRepository extends Repository
{
    /**
     * @var Role
     */
    private $role;

    /**
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        $this->model = $this->role = $role;
    }

    /**
     * @param array $attributes
     * @return Role
     */
    public function store(array $attributes): Role
    {
        $permissions = null;
        unset($attributes['_token']);
        if(array_key_exists('permissions', $attributes)){
            $permissions = $attributes['permissions'];
            unset($attributes['permissions']);
        }
        $attributes['guard_name'] = 'web';

        /** @var Role $role */
        $role = new $this->role;
        $role->fill($attributes);

        $role->save();

        if(null !== $permissions){
            $role->permissions()->sync(array_keys($permissions));
        }

        return $role;
    }

    /**
     * @param Role $role
     * @param array $attributes
     * @return Role
     */
    public function update(Role $role, array $attributes): Role
    {
        $permissions = null;
        unset($attributes['_token']);
        if(array_key_exists('permissions', $attributes)){
            $permissions = $attributes['permissions'];
            unset($attributes['permissions']);
        }

        $role->update($attributes);

        if(null !== $permissions){
            $role->permissions()->sync(array_keys($permissions));
        }

        return $role;
    }

    /**
     * @param Role $role
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Role $role): ?bool
    {
        $role->delete();
        return true;
    }
}
