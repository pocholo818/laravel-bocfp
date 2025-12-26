<?php

namespace App\Laravel\Middlewares\Backoffice;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;

class CheckUserRoleStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth('admin')->user();
        $role = $user ? $user->roles->first() : null;

        if ($user && $role && $role->status === 'inactive') {

            auth('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            session()->flash('notification-status', "warning");
            session()->flash('notification-msg', "Your assigned role is inactive. Please contact support team for assistance.");
            return redirect()->route('backoffice.auth.login');
        }

        return $next($request);
    }
}
