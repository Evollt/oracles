<?php

namespace App\Http\DataTables\Bot;

use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\Bot\ScamStatusRepository;

class ScamStatusDatatable extends BaseDataTable
{
    public function __construct(ScamStatusRepository $repository)
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
            ->editColumn('color', function ($scamStatus) {
                $color = $scamStatus->color ? $scamStatus->color->id : 'info';
                return view('pages.scam-status.partials.table.combination', compact('color'));
            })
            ->addColumn('options', function ($scamStatus) {
                return view('pages.scam-status.partials.table.options', compact('scamStatus'));
            })
            ->rawColumns(['options']);
    }
}
