<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentInfo;
use Yajra\DataTables\DataTables;
class ParentInfotableController extends Controller
{
    public function ParentInfo(Request $request) {

        if ($request->ajax()) {
            $data = ParentInfo::select( 'id','father_name','mother_name','primary_mobile_no','secondary_mobile_no','primary_email',
            'secondary_email','permanent_address','permanent_mobile_no','permanent_lan_line_no','permanent_email','permanent_post_office',
            'permanent_lan_mark','communication_address','communication_mobile_no','communication_lan_line_no','communication_email',
            'communication_post_office','communication_lan_mark','father_occupation','mother_occupation','country','state','location',
            'user_name','password','created_by','updated_by')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='text-center px-0  actions text-nowrap'><a class='edit btn update_hover me-2' href='parentinfoedit/".$row["id"]."'><i class='ri-pencil-line'></i></a> <button class='delete btn btn_delete' value=".$row["id"]."><i class='ri-delete-bin-6-line'></i></button></div>";

            return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('ParentInfo');      
        
    }
    public function ParentInfoEdit(Request $request ,$id) {

        if ($request->ajax()) {
            $data = ParentInfo::select('*')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='text-center actions'>    <a  class='edit btn me-2' href='parentinfoedit/".$row["id"]."'> Update    </a>      </div>";

            return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $parent = ParentInfo::find($id);
        return view('parentinfoedit',compact('parent'));      
        
    }
    }
    ?>