<?php

namespace App\Repositories\Bot;

use App\Models\Bot\ScamCategory;
use App\Repositories\Repository;

class ScamCategoryRepository extends Repository
{
    /**
     * @var ScamCategory
     */
    private $scamcategory;

    /**
     * @param ScamCategory $scamcategory
     */
    public function __construct(ScamCategory $scamcategory)
    {
        $this->model = $this->scamcategory = $scamcategory;
    }

    /**
     * @param array $attributes
     * @return ScamCategory
     */
    public function store(array $attributes): ScamCategory
    {
        /** @var ScamCategory $scamcategory */
        $scamcategory = new $this->scamcategory;
        $scamcategory->fill($attributes);

        $scamcategory->save();

        return $scamcategory;
    }

    /**
     * @param ScamCategory $scamcategory
     * @param array $attributes
     * @return ScamCategory
     */
    public function update(ScamCategory $scamcategory, array $attributes): ScamCategory
    {
        $scamcategory->update($attributes);

        return $scamcategory;
    }

    /**
     * @param ScamCategory $scamcategory
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(ScamCategory $scamcategory): ?bool
    {
        $scamcategory->delete();
        return true;
    }
}
