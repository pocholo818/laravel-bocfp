<?php

namespace App\Laravel\Controllers\Backoffice;

// use App\Laravel\Controllers\Controller as BaseController;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Route, Auth;

class Controller extends BaseController
{
    // use AuthorizesRequests, ValidatesRequests;

    protected $data;

	public function __construct(){
		self::set_current_route();
		self::set_loggedin_user();
	}

	public function get_data(){
        $this->data['page_title'] = "";
		return $this->data;
	}

	public function set_current_route(){
        $this->data['current_route'] = Route::currentRouteName();
	}

	public function set_loggedin_user(){
		// consider Portal namespace will use the User model define in auth.php config file 
		// 'web' is the declared guard for User Model in auth.php and as default guard
		// adjust the guard "web" if necessary to other base Controller file like System namespace etc. if you'll use different Authenticable Model
		if (auth('admin')->user()) {
        	$this->data['auth'] = auth('admin')->user();
		}
	}
}
