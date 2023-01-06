<?php

namespace Database\Seeders\Deploy;

use App\Models\User\User;
use App\Models\Crypto\Wallet;
use App\Models\User\Security;
use Illuminate\Database\Seeder;
use App\Models\User\Notification;
use Illuminate\Support\Facades\DB;

class CreateAdminAccounts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => 550745365775908904,
                'username' => '{{ Evollt }}',
                'role' => 'developer',
                'discriminator' => '6313',
                'avatar' => 'fd1e13a1b79066b61203d55c4476cf1a',
                'verified' => true,
                'locale' => 'en-US',
                'mfa_enabled' => true,
            ],
        ];

        DB::transaction(function () use ($users) {
            foreach($users as $userData){
                $user = new User();
                $security = new Security();
                $notification = new Notification();
                $security->save();
                $notification->save();
                $user->id = $userData['id'];
                $user->username = $userData['username'];
                $user->discriminator = $userData['discriminator'];
                $user->avatar = $userData['avatar'];
                $user->verified = $userData['verified'];
                $user->locale = $userData['locale'];
                $user->mfa_enabled = $userData['mfa_enabled'];
                $user->security_id = $security->id;
                $user->notification_id = $notification->id;
                $user->assignRole($userData['role']);

                $user->save();
            }
        });
    }

}
