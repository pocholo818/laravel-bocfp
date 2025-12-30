<?php

namespace App\Laravel\Controllers\Backoffice;

use Illuminate\Http\Request;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;

/*
 * Models
 */
use App\Laravel\Models\{User};

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
use Str, DB, Auth, Hash;

class AuthenticationController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Login";
    }

    public function login(PageRequest $request)
    {
        return view('backoffice.auth.login');
    }

    public function authenticate(PageRequest $request){
        $password = $request->input('login_password');
		$email = Str::lower($request->get('email'));

        $remember_me = $request->input('remember_me',0);
		$field = filter_var($email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(auth('admin')->attempt([$field => $email,'password' => $password],$remember_me)){

            $user = auth('admin')->user();

            if($user->status != "active"){
                auth('admin')->logout();
				session()->flash('notification-status','warning');
				session()->flash('notification-msg','Your account is currently inactive. Please contact support team for assistance.');
				goto callback;
			}
            
			$user->last_login_at = now();
			$user->save();

			// session()->flash('notification-status','success');
			// session()->flash('notification-msg',"Welcome {$user->name}!");
			return redirect()->route('backoffice.index');
		}

		session()->flash('notification-status','failed');
		session()->flash('notification-msg','Invalid account credentials.');

        callback:
		return redirect()->back();
	}

    public function logout(PageRequest $request){;
		auth('admin')->logout();
		session()->flash('notification-status', "success");
		session()->flash('notification-msg', "Logged out successfully. Session closed.");
        return redirect()->route('backoffice.auth.login');
	}
}
