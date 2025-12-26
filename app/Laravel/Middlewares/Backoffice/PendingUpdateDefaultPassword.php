<?php

namespace App\Laravel\Middlewares\Backoffice;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use App\Laravel\Traits\ResponseGenerator;

class PendingUpdateDefaultPassword
{
    /**
    * The Guard implementation.
    *
    * @var Guard
    */
    protected $auth;

    /**
    * Create a new filter instance.
    *
    * @param  Guard  $auth
    * @return void
    */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        $user = auth('admin')->user();

        if($user->is_default_password == 1) {
            session()->flash('notification-status', "warning");
            session()->flash('notification-msg', "Please update your existing default password first before you can continue.");
            return redirect()->route('backoffice.profile.change_password');
        }

        return $next($request);
    }

}
