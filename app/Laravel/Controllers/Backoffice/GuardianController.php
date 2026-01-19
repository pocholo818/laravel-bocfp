<?php

namespace App\Laravel\Controllers\Backoffice;

use Illuminate\Http\Request;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Backoffice\{GuardianRequest};

/*
 * Models
 */
use App\Laravel\Models\{Guardian};

/* App Classes
 */
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Str, DB;

class GuardianController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Guardian";

        $this->data['statuses'] = [""=>"-- Select Status --", "active"=>"Active", "inactive"=>"Inactive"];
    }

    public function index(PageRequest $request)
    {
        $first_record = Guardian::oldest()->first();

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

        $this->data['records'] = Guardian::where(function ($query) {
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

        return view('backoffice.guardian.index', $this->data);
    }

    public function show(PageRequest $request, $id = NULL){
        $this->data['page_title'] = "Guardian Details";

        $this->data['record'] = Guardian::find($id);

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

		return view('backoffice.guardian.show', $this->data);
	}

    public function create(PageRequest $request){
        $this->data['page_title'] = " Create Guardian";

        return view('backoffice.guardian.create', $this->data);
    }

    public function store(GuardianRequest $request){
        DB::beginTransaction();

        try{
            $guardian = new Guardian();
            $guardian->first_name = strtoupper(trim($request->input('first_name')));
            $guardian->last_name = strtoupper(trim($request->input('last_name')));
            $guardian->contact_number = $request->input('contact_number');
            $guardian->address = $request->input('address');
            $guardian->purok = $request->input('purok');
            $guardian->household_id = $request->input('household_id');
            $guardian->status = $request->input('status');
            $guardian->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Guardian created successfully.");
            return redirect()->route('backoffice.guardian.index');
        }catch(\Exception $e){ 
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function edit(PageRequest $request, $id = NULL){

        $this->data['record'] = Guardian::where('id', $id)->first();

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->route('backoffice.guardian.index', $this->data);
        }

        $this->data['page_title'] = " Edit Guardian";
        return view('backoffice.guardian.edit', $this->data);
    }

    public function update(GuardianRequest $request, $id = NULL){
        
        $guardian = Guardian::find($id);

        if(!$guardian){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        DB::beginTransaction();
        try{
            $guardian->first_name = strtoupper(trim($request->input('first_name')));
            $guardian->last_name = strtoupper(trim($request->input('last_name')));
            $guardian->contact_number = $request->input('contact_number');
            $guardian->address = $request->input('address');
            $guardian->purok = $request->input('purok');
            $guardian->household_id = $request->input('household_id');
            $guardian->status = $request->input('status');
            $guardian->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Guardian updated successfully.");
            return redirect()->route('backoffice.guardian.index');
        }catch(\Exception $e){
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function update_status(PageRequest $request, $id = NULL){
        $guardian = Guardian::find($id);

        if(!$guardian){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        $guardian->status = $guardian->status == "active" ? "inactive" : "active";
        $guardian->save();

        session()->flash('notification-status', 'success');
        session()->flash('notification-msg', "Record updated successfully.");
		return redirect()->back();
	}
}
