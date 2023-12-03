<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Enquiry;
use App\Models\Admission;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index(Request $request) 
    {



            return view('dashboard_index');

    }



}