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

/* App Classes
 */
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Str, DB;

class AdminController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Administrator";

        $this->data['statuses'] = [""=>"--select status--", "active"=>"Active", "inactive"=>"Inactive"];
        $this->data['roles'] = [""=>"--select status--", "admin"=>"Admin", "staff"=>"Staff"];
    }

    public function index(PageRequest $request)
    {
        // $first_record = User::oldest()->first();

        // if($first_record){
        //     $start_date = $first_record->created_at;
        // }
        // else{
        //     $start_date = now()->subMonth();
        // }

        $this->data['keyword'] = $request->get('keyword');
        // $this->data['start_date'] = $request->get('start_date', $start_date->format('m/d/Y'));
		// $this->data['end_date'] = $request->get('end_date', now()->format('m/d/Y'));
        $this->data['selected_status'] = $request->input('status');
        $this->data['role'] = $request->input('role');

        return view('backoffice.admin.index', $this->data);
    }
}
