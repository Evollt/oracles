<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return Builder
     */
    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @return Model
     */
    public function createEmptyModel(): Model
    {
        $className = get_class($this->model);
        return new $className;
    }

    /**
     * @param $method
     * @param $parameters
     *
     * Forward all method calls to \Illuminate\Database\Eloquent\Model
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return call_user_func_array(array($this->model, $method), $parameters);
    }

    public function all(string $orderBy = 'name', string $direction = 'asc')
    {
        return $this->newQuery()->orderBy($orderBy, $direction)->get();
    }

    public function asList(string $orderBy = 'name', string $direction = 'asc', string $keyBy = 'id', string $nameBy = 'name')
    {
        return $this->newQuery()->orderBy($orderBy, $direction)->pluck($nameBy, $keyBy);
    }
}
