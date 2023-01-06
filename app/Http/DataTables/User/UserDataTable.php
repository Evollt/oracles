<?php

namespace App\Http\DataTables\User;

use App\Models\User\Role;
use App\Models\User\User;
use Yajra\DataTables\QueryDataTable;
use App\Http\DataTables\BaseDataTable;
use App\Repositories\User\UserRepository;

class UserDataTable extends BaseDataTable
{
    public function __construct(UserRepository $repository)
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
            ->editColumn('email', function (User $user) {
                return view('pages.user.partials.table.email')->with(['user' => $user]);
            })
            ->addColumn('discord', function (User $user) {
                return $user->username . "#" . $user->discriminator;
            })
            ->addColumn('role', function (User $user) {
                /** @var Role */
                $role = $user->roles->first();

                $color = $role && $role->color ? $role->color->id : 'info';
                $name = $role ? $role->name : 'Has no role!';

                return view('pages.user.partials.table.role')->with(['color' => $color, 'name' => $name]);
            })
            ->addColumn('options', function ($user) {
                return view('pages.user.partials.table.options')->with(['user' => $user]);
            })
            ->rawColumns(['options', 'role']);
    }
}
