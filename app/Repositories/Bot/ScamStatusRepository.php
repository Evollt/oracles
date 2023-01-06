<?php

namespace App\Repositories\Bot;

use App\Models\Bot\ScamStatus;
use App\Repositories\Repository;

class ScamStatusRepository extends Repository
{
    /**
     * @var ScamStatus
     */
    private $scamstatus;

    /**
     * @param ScamStatus $scamstatus
     */
    public function __construct(ScamStatus $scamstatus)
    {
        $this->model = $this->scamstatus = $scamstatus;
    }

    /**
     * @param array $attributes
     * @return ScamStatus
     */
    public function store(array $attributes): ScamStatus
    {
        /** @var ScamStatus $scamstatus */
        $scamstatus = new $this->scamstatus;
        $scamstatus->fill($attributes);

        $scamstatus->save();

        return $scamstatus;
    }

    /**
     * @param ScamStatus $scamstatus
     * @param array $attributes
     * @return ScamStatus
     */
    public function update(ScamStatus $scamstatus, array $attributes): ScamStatus
    {
        $scamstatus->update($attributes);

        return $scamstatus;
    }

    /**
     * @param ScamStatus $scamstatus
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(ScamStatus $scamstatus): ?bool
    {
        $scamstatus->delete();
        return true;
    }
}
