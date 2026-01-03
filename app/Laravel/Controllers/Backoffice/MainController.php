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
use App\Laravel\Models\{User as Admin};

/* App Classes
 */
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Str, DB;

class MainController extends Controller
{
    protected $data;

    public function __construct()
    {
        parent::__construct();
		array_merge($this->data?:[], parent::get_data());
        $this->data['page_title'] .= " Dashboard";
    }

    public function index(PageRequest $request)
    {
        return view('backoffice.index', $this->data);
    }
}
