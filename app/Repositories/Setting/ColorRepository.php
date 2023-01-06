<?php

namespace App\Repositories\Setting;

use App\Models\Setting\Color;
use App\Models\User\Role;
use App\Repositories\Repository;

class ColorRepository extends Repository
{
    /**
     * @var Color
     */
    private $color;

    /**
     * @param Color $color
     */
    public function __construct(Color $color)
    {
        $this->model = $this->color = $color;
    }

    /**
     * @param array $attributes
     * @return Color
     */
    public function store(array $attributes): Color
    {
        /** @var Color $color */
        $color = new $this->color;
        $color->fill($attributes);

        $color->save();

        return $color;
    }

    /**
     * @param Color $color
     * @param array $attributes
     * @return Color
     */
    public function update(Color $color, array $attributes): Color
    {
        $color->update($attributes);

        return $color;
    }

    /**
     * @param Color $color
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Color $color): ?bool
    {
        //To make sure that we can delete stuff
        Role::where('color_id', '=', $color->id)->update(['color_id' => null]);

        $color->delete();
        return true;
    }
}
