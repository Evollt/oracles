<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\User\User;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Crypto\Wallet;
use App\Models\User\Security;
use App\Api\Moralis\MoralisApi;
use App\Models\User\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Artesaos\SEOTools\Facades\SEOMeta;
use GuzzleHttp\Exception\ClientException;

class LoginController extends Controller
{
    /**
     * @return View|RedirectResponse
     */
    public function index()
    {
        if(auth()->user() instanceof User){
            session()->flash('success', 'Logged in successfully');
            return redirect()->route('dashboard.index');
        }
        SEOMeta::setTitle('Login');
        return view('pages.login.index');
    }

    /**
     * @param Request $request
     * @return boolean
     */
    public function login(Request $request)
    {
        if (Auth::check()) {return redirect()->route("login");};
        if ($request->missing("code") && $request->missing("access_token")) {return redirect()->route("login");};

        $tokenData = [
            "client_id" => env("DISCORD_CLIENT_ID"),
            "client_secret" => env("DISCORD_CLIENT_SECRET"),
            "grant_type" => "authorization_code",
            "code" => $request->get("code"),
            "redirect_uri" => env("DISCORD_REDIRECT_URI"),
            "scope" => "identifiy&email",
        ];

        $client = new Client();
        try {
            $accessTokenData = $client -> post(env("DISCORD_TOKEN_URL"), ["form_params" => $tokenData]);
            $accessTokenData = json_decode($accessTokenData -> getBody());
        } catch (ClientException $error) {
            return redirect()->route("login");
        };

        $userData = Http::withToken($accessTokenData->access_token)->get(env("DISCORD_API_BASE_URL"));
        if ($userData -> clientError() || $userData->serverError()) {return redirect()->route("login");};

        $userData = json_decode($userData);
        $user = User::where(['id' => $userData->id])->first();

        if(null !== $user){
            $user->update([
                'username' => $userData->username,
                'discriminator' => $userData->discriminator,
                'avatar' => $userData->avatar,
                'verified' => $userData->verified,
                'locale' => $userData->locale,
                'mfa_enabled' => $userData->mfa_enabled,
            ]);
            $user->save();
        }else{
            $security = new Security();
            $notification = new Notification();
            $security->save();
            $notification->save();
            $user = User::create([
                'id' => $userData->id,
                'username' => $userData->username,
                'discriminator' => $userData->discriminator,
                'avatar' => $userData->avatar,
                'verified' => $userData->verified,
                'locale' => $userData->locale,
                'mfa_enabled' => $userData->mfa_enabled,
                'security_id' => $security->id,
                'notification_id' => $notification->id,
            ]);
            $user->save();
            $user->assignRole('user');
        }

        Auth::login($user);

        return redirect()->route('scam.index');
    }

    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        if(auth()->user() instanceof User){
            session()->flash('success', 'Logged out successfully');
            Auth::logout();
        }
        return redirect()->route('login');
    }
}
