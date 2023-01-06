<?php

namespace App\Repositories\Bot;

use App\Models\Bot\Scam;
use App\Models\Bot\ScamStatus;
use App\Repositories\Repository;

class ScamRepository extends Repository
{
    /**
     * @var Scam
     */
    private $scam;

    /**
     * @param Scam $scam
     */
    public function __construct(Scam $scam)
    {
        $this->model = $this->scam = $scam;
    }

    /**
     * @param array $attributes
     * @return Scam
     */
    public function store(array $attributes): Scam
    {
        $status = ScamStatus::where(['slug' => 'new'])->get()->first();
        if($status instanceof ScamStatus){
            $attributes['scam_status_id'] = $status->id;
        }

        /** @var Scam $scam */
        $scam = new $this->scam;
        $scam->fill($attributes);

        $scam->save();

        return $scam;
    }

    /**
     * @param Scam $scam
     * @param array $attributes
     * @return Scam
     */
    public function update(Scam $scam, array $attributes): Scam
    {
        $scam->update($attributes);

        return $scam;
    }

    /**
     * @param Scam $scam
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Scam $scam): ?bool
    {
        $scam->delete();
        return true;
    }
}
