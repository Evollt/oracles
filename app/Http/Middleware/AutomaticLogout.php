<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutomaticLogout
{
    protected $sessionKey = 'user.last-activity';
    protected $logoutRoute = 'logout';

    protected $timeout;

    public function __construct()
    {
        $this->timeout = (Auth::user()->security->inactive_timer ?? 30) * 60;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->logoutRoute === $request->route()->getName()) {
            session()->forget($this->sessionKey);

            return $next($request);
        }

        $lastActivity = session($this->sessionKey);

        if (null === $lastActivity) {
            session()->put($this->sessionKey, time());

            return $next($request);
        }

        if ((time() - $lastActivity) > $this->timeout) {
            session()->forget($this->sessionKey);

            Auth::logout();

            $redirect = redirect();
            $redirect->setIntendedUrl($request->get('intended', route('login')));
            return $redirect->to(route($this->logoutRoute));
        }

        session()->put($this->sessionKey, time());

        return $next($request);
    }
}
