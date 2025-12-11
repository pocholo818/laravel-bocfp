<?php

namespace App\Laravel\Controllers\Backoffice;

use Illuminate\Http\Request;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;

/*
 * Email Notification
 */
// 

/*
 * Models
 */
// use App\Laravel\Models\{Administrator as Admin, PasswordReset};

/* App Classes
 */
// use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Str, DB, Auth;

class AuthenticationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function login(PageRequest $request)
    {
        return view('backoffice.auth.login');
    }
}
