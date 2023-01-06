<?php

namespace App\Http\DataTables\Bot;

use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\Bot\ScamRepository;

class ScamDatatable extends BaseDataTable
{
    public function __construct(ScamRepository $repository)
    {
        parent::__construct($repository);
    }

    public function applyScopes($builder)
    {
        $requests = request()->all();
        if(request()->get('filter_status')){
            $builder->where('scam_status_id', request()->get('filter_status'));
        }
        if(request()->get('filter_category')){
            $builder->where('scam_status_id', request()->get('filter_category'));
        }

        $builder->orderBy('created_at', 'DESC');

        return $builder;
    }

    /**
     * @param QueryDataTable $datatables
     *
     * @return QueryDataTable
     */
    protected function addColumns(QueryDataTable $datatables): QueryDataTable
    {
        return $datatables
            ->editColumn('scam_status_id', function($scam) {
                return view('pages.scam.partials.table.category', compact('scam'));
            })
            ->editColumn('scam_status_id', function($scam) {
                return view('pages.scam.partials.table.status', compact('scam'));
            })
            ->addColumn('options', function ($scam) {
                return view('pages.scam.partials.table.options', compact('scam'));
            })
            ->rawColumns(['options']);
    }
}
