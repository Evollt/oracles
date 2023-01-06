<?php

namespace App\Repositories\User;

use App\Models\User\Security;
use App\Repositories\Repository;

class SecurityRepository extends Repository
{
    /**
     * @var Security
     */
    private $security;

    /**
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->model = $this->security = $security;
    }

    /**
     * @param Security $security
     * @param array $attributes
     * @return Security
     */
    public function update($user, array $attributes): Security
    {
        $security = Security::find($user->security->id);

        if(null === $attributes['data_usage']){
            $attributes['data_usage'] = false;
        }

        unset($attributes['_token']);
        $security->update($attributes);

        return $security;
    }

    /**
     * @param Security $security
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Security $security): ?bool
    {
        $security->delete();
        return true;
    }
}
