<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendEmail()
    {
        $user = Auth::user();
        if(null != $user->email_verified_at)
        {
            return back();
        }
        $user = User::where('id', '=', $user->id)->first();
        $user->update(['verification_code' => $this->generateVerificationCode()]);

        Mail::to($user->email)->send(new EmailVerification($user));

        session()->flash('success', 'Email sent, please check your inbox to verify your email address');
        return redirect()->route('verification.form');
    }

    public function generateVerificationCode()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#$%!';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function showVerificationForm()
    {
        return view('pages.profile.verify-mail.verification');
    }

    public function verify(Request $request)
    {
        $user = Auth::user();
        $user = User::where('id', '=', $user->id)->first();

        if ($request->verification_code === $user->verification_code) {
            $time = Carbon::now();
            $user->update([
                'email_verified_at' => $time->toDateTimeString(),
                'verification_code' => null
            ]);

            session()->flash('success', 'Successfully verified your email');
            return redirect()->route('user.account.profile');
        }
        session()->flash('error', 'Wrong code, please try again');
        return back();
    }
}
