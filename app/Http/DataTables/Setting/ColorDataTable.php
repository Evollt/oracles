<?php

namespace App\Http\DataTables\Setting;

use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\Setting\ColorRepository;

class ColorDataTable extends BaseDataTable
{
    public function __construct(ColorRepository $repository)
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
            ->addColumn('combination', function ($color) {
                $color = $color->id;
                return view('pages.color.partials.table.combination', compact('color'));
            })
            ->addColumn('options', function ($color) {
                return view('pages.color.partials.table.options', compact('color'));
            })
            ->rawColumns(['options', 'combination']);
    }
}
