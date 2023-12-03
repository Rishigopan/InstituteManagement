<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DuplicateController extends Controller
{
    public function Duplicate()
    {
        $duplicates = DB::table('enquiries')
        ->select('*', DB::raw('COUNT(*) as `count`'))
        ->groupBy('name', 'location')
        ->having('count', '>', 1)
        ->get();
    }

    
}
