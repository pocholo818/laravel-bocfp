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
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Administrator";

        $this->data['statuses'] = [""=>"-- Select status --", "active"=>"Active", "inactive"=>"Inactive"];
        $this->data['roles'] = [""=>"-- Select role --", "admin"=>"Admin", "staff"=>"Staff"];
    }

    public function index(PageRequest $request)
    {
        $first_record = User::oldest()->first();

        if($first_record){
            $start_date = $first_record->created_at;
        }
        else{
            $start_date = now()->subMonth();
        }

        $this->data['keyword'] = $request->get('keyword');
        $this->data['start_date'] = $request->get('start_date', $start_date->format('m/d/Y'));
		$this->data['end_date'] = $request->get('end_date', now()->format('m/d/Y'));
        $this->data['selected_status'] = $request->input('status');
        // $this->data['role'] = $request->input('role');

        $this->data['records'] = User::where(function ($query) {
                                        if(strlen($this->data['keyword']) > 0) {
                                            return $query
                                                ->where('name', 'LIKE', '%' . $this->data['keyword'] . '%')
                                                ->orWhere('username', 'LIKE', '%' . $this->data['keyword'] . '%')
                                                ->orWhere('email', 'LIKE', '%' . $this->data['keyword'] . '%');
                                        }
                                    })
                                    // ->where(function ($query) {
                                    //     if(strlen($this->data['role']) > 0) {
                                    //         $query->where('role_id', $this->data['role']);
                                    //     }                                    
                                    // })
                                    ->where(function ($query) {
                                        if(strlen($this->data['selected_status']) > 0) {
                                            $query->where('status', $this->data['selected_status']);
                                        }                                    
                                    })
                                    ->where(function($query){
                                        return $query->where(function($q){
                                                    if(strlen($this->data['start_date']) > 0){
                                                        return $q->whereDate('created_at','>=',Carbon::parse($this->data['start_date'])->format("Y-m-d"));
                                                    } 
                                                })->where(function($q){
                                                    if(strlen($this->data['end_date']) > 0){
                                                        return $q->whereDate('created_at','<=',Carbon::parse($this->data['end_date'])->format("Y-m-d"));
                                                    }
                                                });
                                    })
                                    // ->whereNot('id', 1)
                                    ->orderBy('created_at','desc')
                                    ->paginate(10);

        return view('backoffice.admin.index', $this->data);
    }

    public function show(PageRequest $request, $admin_id = NULL){
        $this->data['page_title'] = "Admin Details";

        $this->data['record'] = User::find($admin_id);

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

		return view('backoffice.admin.show', $this->data);
	}

    public function create(PageRequest $request){
        $this->data['page_title'] = " Create Admin";

        return view('backoffice.admin.create', $this->data);
    }

    public function store(AdminRequest $request){
        DB::beginTransaction();

        try{
            $password = Str::random(8);

            $admin = new Admin();
            $admin->name = trim("{$request->input('name')}");
            $admin->email = $request->input('email');
            // $admin->username = $request->input('username');
            $admin->contact_number = $request->input('contact_number');
            // $admin->type = $request->input('type');
            // $admin->role_id = $user_role->id;
            // $admin->role = $user_role->name;
            $admin->password = bcrypt($password );
            $admin->status = $request->input('status');
            $admin->save();

            $admin->assignRole($user_role);

            if (env( 'EMAIL_SERVICE', false)) {
                $data = [
                    'admin' => $admin,
                    'password_plain' => $password,
                    'link' => route('backoffice.auth.login'),
                    'web_link' => route('web.home'),
                ];

                Mail::to($admin->email)->send(new AdminCreated($data));
            }

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Admin created successfully.");
            return redirect()->route('backoffice.admin.index');
        }catch(\Exception $e){ 
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function update_status(PageRequest $request, $admin_id = NULL){
        $admin = User::find($admin_id);

        if(!$admin){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        $admin->status = $admin->status == "active" ? "inactive" : "active";
        $admin->save();

        session()->flash('notification-status', 'success');
        session()->flash('notification-msg', "Record updated successfully.");
		return redirect()->back();
	}
}
