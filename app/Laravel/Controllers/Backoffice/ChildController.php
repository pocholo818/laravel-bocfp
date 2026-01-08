<?php

namespace App\Laravel\Controllers\Backoffice;

use Illuminate\Http\Request;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Backoffice\{ChildRequest};

/*
 * Models
 */
use App\Laravel\Models\{Child};

/* App Classes
 */
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Str, DB;

class ChildController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Children";

        $this->data['statuses'] = [""=>"-- Select Status --", "active"=>"Active", "inactive"=>"Inactive"];
        $this->data['sexes'] = [""=>"-- Select Sex --", "M"=>"Male", "F"=>"Female"];
    }

    public function index(PageRequest $request)
    {
        $first_record = Child::oldest()->first();

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
        $this->data['selected_sex'] = $request->input('sex');

        $this->data['records'] = Child::where(function ($query) {
                                        if(strlen($this->data['keyword']) > 0) {
                                            return $query
                                                ->where('name', 'LIKE', '%' . $this->data['keyword'] . '%');
                                        }
                                    })
                                    ->where(function ($query) {
                                        if(strlen($this->data['selected_sex']) > 0) {
                                            $query->where('sex', $this->data['selected_sex']);
                                        }                                    
                                    })
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
                                    ->orderBy('created_at','desc')
                                    ->paginate(10);

        return view('backoffice.child.index', $this->data);
    }

    public function show(PageRequest $request, $id = NULL){
        $this->data['page_title'] = "Child Details";

        $this->data['record'] = Child::find($id);

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

		return view('backoffice.child.show', $this->data);
	}

    public function create(PageRequest $request){
        $this->data['page_title'] = " Create Child";

        return view('backoffice.child.create', $this->data);
    }

    public function store(ChildRequest $request){
        DB::beginTransaction();

        try{
            $child = new Child();
            $child->first_name = strtoupper(trim($request->input('first_name')));
            $child->last_name = strtoupper(trim($request->input('last_name')));

            // set guardian if existed
            // if($request->input('guardian')){
            //     $guardian = Guardian::find($request->input('guardian'));
            //     $child->guardian_id = $guardian->id;
            //     $child->guardian_first_name = $guardian->first_name;
            //     $child->guardian_last_name = $guardian->last_name;
            //     $child->relationship = $request->input('relationship');
            // }

            $child->sex = $request->input('sex');
            $child->status = $request->input('status');
            $child->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Admin created successfully.");
            return redirect()->route('backoffice.child.index');
        }catch(\Exception $e){ 
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function edit(PageRequest $request, $id = NULL){

        $this->data['record'] = Child::where('id', $id)->first();

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->route('backoffice.child.index', $this->data);
        }

        $this->data['page_title'] = " Edit Child";
        return view('backoffice.child.edit', $this->data);
    }

    public function update(ChildRequest $request, $id = NULL){
        
        $child = Child::where('id', $id)->first();

        if(!$child){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        DB::beginTransaction();
        try{
            $child->first_name = strtoupper(trim($request->input('first_name')));
            $child->last_name = strtoupper(trim($request->input('last_name')));

            // set guardian if existed
            // if($request->input('guardian')){
            //     $guardian = Guardian::find($request->input('guardian'));
            //     $child->guardian_id = $guardian->id;
            //     $child->guardian_first_name = $guardian->first_name;
            //     $child->guardian_last_name = $guardian->last_name;
            //     $child->relationship = $request->input('relationship');
            // }

            $child->sex = $request->input('sex');
            $child->status = $request->input('status');
            $child->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Admin updated successfully.");
            return redirect()->route('backoffice.child.index');
        }catch(\Exception $e){
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function update_status(PageRequest $request, $id = NULL){
        $admin = Child::find($id);

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
