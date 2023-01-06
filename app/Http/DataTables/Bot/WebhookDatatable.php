<?php

namespace App\Http\DataTables\Bot;

use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\Bot\WebhookRepository;

class WebhookDatatable extends BaseDataTable
{
    public function __construct(WebhookRepository $repository)
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
            ->addColumn('options', function ($webhook) {
                return view('pages.webhook.partials.table.options', compact('webhook'));
            })
            ->rawColumns(['options']);
    }
}
