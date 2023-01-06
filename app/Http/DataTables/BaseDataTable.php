<?php

namespace App\Http\DataTables;

use App\Repositories\Repository;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\QueryDataTable;

class BaseDataTable
{
    /** @var Repository */
    protected $repository;
    /** @var mixed  */
    protected $datatables;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
        $this->datatables = DataTables::make($this->query());
    }

    /**
     * Return JSON response to use as ajax response.
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function ajax(): JsonResponse
    {
        return $this->addColumns($this->datatables)->toJson();
    }

    /**
     * Modify columns used in DataTable
     *
     * @param QueryDataTable $datatables
     * @return QueryDataTable
     */
    protected function addColumns(QueryDataTable $datatables): QueryDataTable
    {
        // By default we won't add extra columns
        return $datatables;
    }

    /**
     * Apply different filters and scopes at query
     *
     * @param \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function applyScopes($builder)
    {
        // By default we won't apply any scopes
        return $builder;
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        $query = $this->repository->createEmptyModel()->newQuery();
        return $this->applyScopes($query);
    }
}
