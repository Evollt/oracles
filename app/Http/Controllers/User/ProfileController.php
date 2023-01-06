<?php

namespace App\Http\Controllers\User;

use App\Api\Moralis\MoralisApi;
use App\Http\Requests\Profile\SecurityRequest;
use App\Models\Crypto\Nft;
use App\Models\User\User;
use App\Repositories\User\SecurityRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Crypto\Contract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\User\UserRepository;
use App\Http\Requests\User\ProfileRequest;
use PhpParser\Node\Expr\Cast\String_;

class ProfileController extends Controller
{
    /**
     * @return View
     */
    public function profile(): View
    {
        /** @var User */
        $user = auth()->user();
        $navName = 'Profile';
        return view('pages.profile.profile', compact('navName', 'user'));
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function updateProfile(ProfileRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            /** @var UserRepository */
            $userRepository = app()->make(UserRepository::class);

            return $userRepository->update(auth()->user(), $request->request->all());
        });

        session()->flash('success', 'Successfully updated your profile');

        return redirect()->route('user.account.profile');
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function updateWallet(): RedirectResponse
    {
        $api = new MoralisApi;
        $api->refreshWallet(auth()->user());

        session()->flash('success', 'Successfully updated your wallet');

        return redirect()->route('user.account.nfts');
    }

    /**
     * @return View
     */
    public function security(): View
    {
        $security = auth()->user()->security;
        $navName = 'Security';
        return view('pages.profile.security', compact('navName', 'security'));
    }

    /**
     * @param SecurityRequest $request
     * @return RedirectResponse
     */
    public function updateSecurity(SecurityRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            /** @var SecurityRepository */
            $securityRepository = app()->make(SecurityRepository::class);

            return $securityRepository->update(auth()->user(), $request->request->all());
        });

        session()->flash('success', 'Successfully updated your security settings');

        return redirect()->route('user.account.security');
    }

    /**
     * @return View
     */
    public function delete(): View
    {
        return view('pages.profile.modal.delete');
    }

    /**
     * @return JsonResponse
     */
    public function destroy(): JsonResponse
    {
        DB::transaction(function () {
            /** @var UserRepository */
            $userRepository = app()->make(UserRepository::class);

            return $userRepository->destroy(auth()->user());
        });

        session()->flash('success', 'Your account has been successfully deleted');
        return response()->json([
            'actions' => [
                [
                    'name' => 'redirectPage',
                    'params' => [
                        'url' => route('login'),
                    ]
                ],
            ],
        ]);
    }

    /**
     * @return View
     */
    public function notifications(): View
    {
        $notification = auth()->user()->notification;
        $navName = 'Notifications';
        return view('pages.profile.notifications', compact('navName', 'notification'));
    }

    /**
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function updateNotifications(ProfileRequest $request): RedirectResponse
    {
        return redirect()->route('user.account.security');
    }

    public function showPublicProfile(User $user): View
    {
        $nfts = $user->nfts;

        return view('pages.profile.public', compact('nfts', 'user'));
    }

    public function generateApiKeyModal(): View
    {
        return view('pages.profile.modal.generate-api-key');
    }

    public function createApiKey(): JsonResponse
    {
        /** @var User */
        $user = auth()->user();
        if(null !== $user->tokens()->first() ){
            $user->tokens()->delete();
        }

        $token = $user->createToken('key')->plainTextToken;

        session()->flash('success', 'Your token has been regenerated! Key: ' . $token);
        return response()->json([
            'actions' => [
                [
                    'name' => 'redirectPage',
                    'params' => [
                        'url' => route('user.account.profile'),
                    ]
                ],
            ],
        ]);
    }
}
