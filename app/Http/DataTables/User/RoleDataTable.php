<?php

namespace App\Http\DataTables\User;

use App\Models\User\Role;
use App\Models\User\User;
use App\Models\Setting\Color;
use Illuminate\Support\Collection;
use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\User\RoleRepository;
use App\Repositories\User\UserRepository;

class RoleDataTable extends BaseDataTable
{
    public function __construct(RoleRepository $repository)
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
            ->addColumn('users', function (Role $role) {
                return $role->users->count();
            })
            ->addColumn('color', function (Role $role) {
                $color = $role->color_id;

                return view('pages.role.partials.table.role-color', compact('color'));
            })
            ->addColumn('options', function (Role $role) {
                return view('pages.role.partials.table.options')->with(['role' => $role]);
            })
            ->rawColumns(['options']);
    }
}
