<?php

namespace App\Http\DataTables\Bot;

use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\Bot\SubscriberRepository;

class SubscriberDatatable extends BaseDataTable
{
    public function __construct(SubscriberRepository $repository)
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
            ->editColumn('user_id', function ($subscriber) {
                return $subscriber->user->discord;
            })
            ->editColumn('receive_message', function ($subscriber) {
                return view('pages.subscriber.partials.table.message', compact('subscriber'));
            })
            ->addColumn('options', function ($subscriber) {
                return view('pages.subscriber.partials.table.options', compact('subscriber'));
            })
            ->rawColumns(['options']);
    }
}
