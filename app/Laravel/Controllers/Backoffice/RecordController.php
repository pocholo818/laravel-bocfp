<?php

namespace App\Laravel\Controllers\Backoffice;

use Illuminate\Http\Request;

/*
 * Request Validator
 */
use App\Laravel\Requests\PageRequest;
use App\Laravel\Requests\Backoffice\{RecordRequest};

/*
 * Models
 */
use App\Laravel\Models\{Record, Child};

/*
 * Services
 */
use App\Laravel\Services\{BMIService};

/* App Classes
 */
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Mail;
use Str, DB;

class RecordController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Record";
    }

    public function index(PageRequest $request, $child_id = null)
    {
        $this->data['child'] = Child::find($child_id);

        if(!$this->data['child']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        $first_record = Child::latest()->first();

        if($first_record){
            $start_date = $first_record->created_at;
        }
        else{
            $start_date = now()->subMonth();
        }

        $this->data['start_date'] = $request->get('start_date', $start_date->format('m/d/Y'));
		$this->data['end_date'] = $request->get('end_date', now()->format('m/d/Y'));

        $this->data['records'] = Record::where('child_id', $this->data['child']->id)
                                    // ->when($this->data['start_date'], function($query, $data){
                                    //     return $query->where('created_at','>=',Carbon::parse($data)->format("Y-m-d"));
                                    // })
                                    // ->when($this->data['end_date'], function($query, $data){
                                    //     return $query->where('created_at','<=',Carbon::parse($data)->format("Y-m-d"));
                                    // })
                                    ->orderBy('created_at','desc')
                                    ->paginate(10);

        return view('backoffice.record.index', $this->data);
    }

    public function create(PageRequest $request, $child_id = null){
        $this->data['child'] = Child::find($child_id);

        if(!$this->data['child']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->route('backoffice.child.index', $this->data);
        }

        $this->data['page_title'] = " Create Record - ".nice_display($this->data['child']->name);

        return view('backoffice.record.create', $this->data);
    }

    public function store(RecordRequest $request, $child_id = null){
        $child = Child::find($child_id);

        if(!$child){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->route('backoffice.record.index', $this->data);
        }

        DB::beginTransaction();

        try{
            $record = new Record();
            $record->user_id = $this->data['auth']->id;
            $record->child_id = $child->id;
            $record->height = $request->input('height');
            $record->weight = $request->input('weight');

            $calculate = (new BMIService())->compute($record->weight, $record->height);
            $record->bmi = $calculate->bmi;
            $record->remarks = $calculate->remarks;
            $record->save();

            // update child measurements
            $child->height = $record->height;
            $child->weight = $record->weight;
            $child->bmi = $record->bmi;
            $child->remarks = $record->remarks;
            $child->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Record created successfully.");
            return redirect()->route('backoffice.record.index', $child_id);
        }catch(\Exception $e){ 
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function edit(PageRequest $request, $child_id = NULL, $id = NULL){
        $this->data['record'] = Record::find($id);

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->route('backoffice.record.index', $this->data);
        }

        $this->data['page_title'] = " Edit Record";
        return view('backoffice.record.edit', $this->data);
    }

    public function update(RecordRequest $request, $child_id = NULL, $id = NULL){
        $record = Record::find($id);

        if(!$record){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        DB::beginTransaction();
        try{
            $record->height = $request->input('height');
            $record->weight = $request->input('weight');

            $calculate = (new BMIService())->compute($record->weight, $record->height);
            $record->bmi = $calculate->bmi;
            $record->remarks = $calculate->remarks;
            $record->save();

            if($record->is(Record::latest()->first())){
                // update child measurements
                $record->child->height = $record->height;
                $record->child->weight = $record->weight;
                $record->child->bmi = $record->bmi;
                $record->child->remarks = $record->remarks;
                $record->child->save();
            }

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Record updated successfully.");
            return redirect()->route('backoffice.record.index', $child_id);
        }catch(\Exception $e){
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }
}
