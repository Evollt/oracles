<?php

namespace App\Http\Controllers\User;

use App\Models\User\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Setting\Color;
use App\Models\User\Permission;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\RoleRepository;
use App\Http\DataTables\User\RoleDataTable;

class RoleController extends Controller
{
    /**
     * @return View
     */
    public function index() :View
    {
        $this->middleware('role.index');
        return view('pages.role.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(RoleDataTable $roleDataTable) :JsonResponse
    {
        $this->middleware('role.index');
        return $roleDataTable->ajax();
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $this->middleware('role.create');
        $permissions = Permission::orderBy('name', 'asc')->get();
        $colors = Color::get()->pluck('name', 'slug');
        return view('pages.role.create', compact('permissions', 'colors'));
    }

    /**
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->middleware('role.create');
        /** @var RoleRepository */
        $roleRepository = app()->make(RoleRepository::class);
        $role = $roleRepository->store($request->request->all());

        session()->flash('success', 'Successfully created role: ' . $role->name);

        return redirect()->route('roles.index');
    }

    /**
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        $this->middleware('role.edit');
        $permissions = Permission::orderBy('name', 'asc')->get();
        $colors = Color::get()->pluck('name', 'slug');
        return view('pages.role.edit', compact('role', 'permissions', 'colors'));
    }

    /**
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->middleware('role.edit');

        /** @var RoleRepository */
        $roleRepository = app()->make(RoleRepository::class);
        $role = $roleRepository->update($role, $request->request->all());

        session()->flash('success', 'Successfully updated role: ' . $role->name);

        return redirect()->route('roles.index');
    }

    /**
     * @param Role $role
     * @return View
     */
    public function delete(Role $role): View
    {
        $this->middleware('role.delete');
        return view('pages.role.modal.delete', compact('role'));
    }

    /**
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->middleware('role.delete');

        /** @var RoleRepository */
        $roleRepository = app()->make(RoleRepository::class);
        $roleRepository->destroy($role);

        session()->flash('success', 'Deleted role successfully');

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }
}
