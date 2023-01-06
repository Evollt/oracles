<?php

namespace App\Repositories\User;

use App\Models\User\User;
use Illuminate\Support\Arr;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $this->user = $user;
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function store(array $attributes): User
    {
        /** @var User $user */
        $user = new $this->user;
        $user->fill($attributes);

        $user->save();

        return $user;
    }

    /**
     * @param User $user
     * @param array $attributes
     * @return User
     */
    public function update(User $user, array $attributes): User
    {
        if(Arr::has($attributes, 'use_nft')){
            $attributes['use_nft'] = true;
        }else{
            $attributes['use_nft'] = false;
        }

        if(true === $attributes['use_nft']){
            $attributes['profile_pic'] = $attributes['nft_profile_pic'];
            unset($attributes['nft_profile_pic']);
        }

        if($attributes['email'] !== auth()->user()->email){
            $attributes['email_verified_at'] = null;
        }

        $user->update($attributes);

        return $user;
    }

    /**
     * @param User $user
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(User $user): ?bool
    {
        $security = $user->security;
        $notification = $user->notification;
        $user->delete();
        $security->delete();
        $notification->delete();
        return true;
    }
}
