<?php

namespace Database\Seeders\Deploy;

use App\Models\Setting\Color;
use App\Models\User\Role;
use Illuminate\Database\Seeder;

class AddRoleColors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();

        $colorRoles = [
            'super-admin' => 'danger',
            'developer' => 'danger',
            'admin' => 'orange',
            'moderator' => 'warning',
            'manager' => 'secondary',
            'user' => 'primary',
        ];

        foreach($roles as $role){
            $color = Color::where('slug', '=', $colorRoles[$role->name])->first();
            $role->color_id = $color->id;
            $role->save();
        }
    }

}
