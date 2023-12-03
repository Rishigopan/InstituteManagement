<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Yajra\DataTables\DataTables;
class BranchController extends Controller
{
    public function Branch(Request $request) {

        if ($request->ajax()) {
            $data = Branch::select( 'id','branch_name','code','permanent_address','permanent_mobile_no',
            'permanent_lan_line_no','permanent_email','permanent_post_office',
            'permanent_lan_mark','communication_address','communication_mobile_no',
            'communication_lan_line_no','communication_email','communication_post_office',
            'communication_lan_mark','gst_no','pan_no','website','country','state','location',
            'headding','subheading')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
            
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('Branch');      
        
    }
    }
    ?>
