<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseProvider;
use Yajra\DataTables\DataTables;

class CourseProTableController extends Controller
{
    public function CourseProTable(Request $request 
    ) {

        if ($request->ajax()) {
            $data = CourseProvider::select('id', 'provider_name','id_card_prefix','code','permanent_address','permanent_mobile_no','permanent_lan_line_no','permanent_email',
            'permanent_post_office','permanent_lan_mark','communication_address','communication_mobile_no','communication_lan_line_no',
            'communication_email','communication_post_office','communication_lan_mark','gst_no','pan_no','website','country','state','location')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
            $actionBtn = "<div class='text-center   actions text-nowrap'><a class='edit btn update_hover me-2' href='courseproviderEdit/".$row["id"]."'><i class='ri-pencil-line'></i></a> <button class='delete btn btn_delete' value=".$row["id"]."><i class='ri-delete-bin-6-line'></i></button></div>";
            return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('CourseProviderTable');      
        
    }
}
?>
