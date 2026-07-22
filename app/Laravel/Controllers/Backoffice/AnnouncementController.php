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
use App\Laravel\Models\{Announcement};

/* App Classes
 */
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Mail;
use Str, DB;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Announcements";

        $this->data['statuses'] = [""=>"-- Select Status --", "active"=>"Active", "inactive"=>"Inactive"];
    }

    public function index(PageRequest $request)
    {
        $first_record = Announcement::oldest()->first();

        if($first_record){
            $start_date = $first_record->created_at;
        }
        else{
            $start_date = now()->subMonth();
        }

        $this->data['keyword'] = trim($request->input('keyword'));
        $this->data['start_date'] = $request->input('start_date', $start_date);
		$this->data['end_date'] = $request->input('end_date', now());

        $this->data['records'] = Announcement::when($this->data['keyword'], function ($query, $data){
                                        return $query->where('title', 'LIKE', "%{$data}%");
                                    })
                                    ->when($this->data['start_date'], function ($query, $data) {
                                        return $query->where('created_at', '>=', Carbon::parse($data)->startOfDay());
                                    })
                                    ->when($this->data['end_date'], function ($query, $data) {
                                        return $query->where('created_at', '<=', Carbon::parse($data)->endOfDay());
                                    })
                                    ->orderBy('created_at','desc')
                                    ->paginate(10);

        return view('backoffice.announcement.index', $this->data);
    }

    public function show(PageRequest $request, $id = NULL){
        $this->data['page_title'] = "Announcement Details";

        $this->data['record'] = Announcement::find($id);

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

		return view('backoffice.announcement.show', $this->data);
	}

    public function create(PageRequest $request){
        $this->data['page_title'] = " Create Announcement";

        return view('backoffice.announcement.create', $this->data);
    }

    public function store(PageRequest $request){
        $title = $request->input('title');
        $content = $request->input('content');

        DB::beginTransaction();
        try{
            $announcement = new Announcement();
            $announcement->title = $title;
            $announcement->content = $content;
            $announcement->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Record created successfully.");
            return redirect()->route('backoffice.announcement.index');
        }catch(\Exception $e){ 
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }

    public function edit(PageRequest $request, $id = NULL){

        $this->data['record'] = Announcement::where('id', $id)->first();

        if(!$this->data['record']){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->route('backoffice.announcement.index', $this->data);
        }

        $this->data['page_title'] = " Edit Child";
        return view('backoffice.announcement.edit', $this->data);
    }

    public function update(PageRequest $request, $id = NULL){
        $announcement = Announcement::where('id', $id)->first();

        if(!$announcement){
            session()->flash('notification-status', 'error');
            session()->flash('notification-msg', "Record not found.");
            return redirect()->back();
        }

        $title = $request->input('title');
        $content = $request->input('content');

        DB::beginTransaction();
        try{
            $announcement->title = $title;
            $announcement->content = $content;
            $announcement->save();

            DB::commit();
            session()->flash('notification-status', 'success');
            session()->flash('notification-msg', "Record updated successfully.");
            return redirect()->route('backoffice.announcement.index');
        }catch(\Exception $e){
            DB::rollback();
            session()->flash('notification-status', 'failed');
            session()->flash('notification-msg', "Server Error: Code #{$e->getLine()}");
            return redirect()->back();
        }
    }
}
