<?php

namespace App\Http\Controllers\User;

use App\Repositories\User\SecurityRepository;
use Carbon\Carbon;
use App\Models\User\Role;
use App\Models\User\User;
use Illuminate\View\View;
use App\Models\Crypto\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\UserRepository;
use App\Http\DataTables\User\UserDataTable;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return View
     */
    public function index() :View
    {
        $this->middleware('users.index');
        return view('pages.user.index');
    }

    /**
     * @return JsonResponse
     */
    public function datatable(UserDataTable $userDataTable) :JsonResponse
    {
        $this->middleware('users.index');
        return $userDataTable->ajax();
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        $this->middleware('users.show');
        $nfts = $user->nfts;
        return view('pages.user.show', compact('user', 'nfts'));
    }

    /**
     * @param User $user
     * @return View
     */
    public function roleModal(User $user): View
    {
        $this->middleware('users.role');
        if(Auth::user()->hasRole('developer')){
            $roles = Role::get()->pluck('name', 'id');
        }else{
            $roles = Role::whereNotIn('name', ['developer', 'super-admin'])->get()->pluck('name', 'id');
        }
        return view('pages.user.modal.role-modal', compact('user', 'roles'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return JsonResponse
     */
    public function roleUpdate(Request $request, User $user): JsonResponse
    {
        $this->middleware('users.role');
        $data = $request->request->all();

        if(array_key_exists('role', $data)){
            $roles = [];
            $roles[] = $data['role'];
            $user->roles()->sync($roles);
            $user->save();
            session()->flash('success', 'Role for user succesfully updated');
        }else{
            session()->flash('error', 'Something went wrong with updating the role for the user');
        }

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }

    /**
     * @param User $user
     * @return View
     */
    public function activeModal(User $user): View
    {
        $this->middleware('users.deactivate');
        return view('pages.user.modal.active-modal', compact('user'));
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function toggleActive(User $user): JsonResponse
    {
        $this->middleware('users.deactivate');
        /** @var UserRepository */
        $userRepository = app()->make(UserRepository::class);
        $message = "activated";
        $attributes = [
            'deactivated_at' => null,
        ];

        if(null === $user->deactivated_at){
            $attributes['deactivated_at'] = Carbon::now();
            $message = "deactivated";
        }

        $userRepository->update($user, $attributes);

        session()->flash('success', 'User succesfully ' . $message);

        return response()->json([
            'actions' => [
                [
                    'name' => 'reloadPage',
                ],
            ],
        ]);
    }


    public function wallet() : View
    {
        $user = Auth::user();
        return view('pages.user.wallet', compact('user'));
    }
}
