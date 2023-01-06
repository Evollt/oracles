<?php

namespace App\Http\DataTables\Bot;

use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\Bot\ScamCategoryRepository;

class ScamCategoryDatatable extends BaseDataTable
{
    public function __construct(ScamCategoryRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param QueryDataTable $datatables
     *
     * @return QueryDataTable
     */
    protected function addColumns(QueryDataTable $datatables): QueryDataTable
    {
        return $datatables
            ->editColumn('color', function ($scamCategory) {
                $color = $scamCategory->color ? $scamCategory->color->id : 'info';
                return view('pages.scam-category.partials.table.combination', compact('color'));
            })
            ->addColumn('options', function ($scamCategory) {
                return view('pages.scam-category.partials.table.options', compact('scamCategory'));
            })
            ->rawColumns(['options']);
    }
}
