<?php

namespace Database\Seeders\Models;

use App\Models\User\Role;
use App\Models\User\Permission;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'super-admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'developer',
                'guard_name' => 'web',
            ],
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
        ];

        foreach($roles as $attributes){
            $role = Role::where($attributes)->first();
            if(!$role instanceof Role){
                $role = new Role($attributes);
                $role->save();
            }
        }

        // Define a set of permissions per role
        $permissions = [
            'admin' => [
                'role.index',
                'role.edit',
                'role.create',
                'role.delete',

                'users.index',
                'users.role',
                'users.show',
                'users.deactivate',

                'scam.index',
                'scam.edit',
                'scam.create',
                'scam.delete',
                'scam.post',
                'scam.status',

                'subscribers.index',
                'subscribers.edit',
                'subscribers.create',
                'subscribers.delete',

                'webhook.index',
                'webhook.edit',
                'webhook.create',
                'webhook.delete',

                'scam-status.index',
                'scam-status.edit',
                'scam-status.create',
                'scam-status.delete',

                'scam-category.index',
                'scam-category.edit',
                'scam-category.create',
                'scam-category.delete',

                'api.index',
                'api.edit',
                'api.create',
                'api.delete',
            ],
        ];

        foreach ($permissions as $roleName => $rolePermissions) {
            /** @var Role */
            $role = Role::findOrCreate($roleName, 'web');

            $syncPermissions = [];
            foreach ($rolePermissions as $rolePermission) {
                $permission = Permission::findOrCreate($rolePermission, 'web');
                $syncPermissions[] = $permission->id;
            }

            $role->syncPermissions($syncPermissions);
        }
    }
}
