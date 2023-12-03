<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

use Yajra\DataTables\DataTables;
class BranchEditController extends Controller
{  
    public function BranchEdit(Request $request , $id) {

    if ($request->ajax()) {
        $data = Branch::select('id','branch_name','code','permanent_address','permanent_mobile_no',
        'permanent_lan_line_no','permanent_email','permanent_post_office',
        'permanent_lan_mark','communication_address','communication_mobile_no',
        'communication_lan_line_no','communication_email','communication_post_office',
        'communication_lan_mark','gst_no','pan_no','website','country','state','location',
        'headding','subheading')->get();
        return Datatables::of($data)->addIndexColumn()
        ->addColumn('action', function($row){
            $actionBtn = "<div class='text-center actions text-nowrap'>    <a  class='edit btn me-2' href='branchEdit/".$row["id"]."'> Update</a>      </div>";

        return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }


    $branch = Branch::find($id);
    return view('BranchEdit', compact('branch'));      
    
}
}
?>