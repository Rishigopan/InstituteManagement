<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentInfo;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\Staff;
use App\Models\Course;
use App\Models\EnquiryType;
use App\Models\Enquiry;
use App\Models\Branch;
use App\Models\Stream;
use Yajra\DataTables\DataTables;
class NotinterestController extends Controller

{
public function EnquiryTable(Request $request) {
        
        if ($request->ajax()) {
            $data = Enquiry::select('enquiries.id', 'enquiries.name', 'enquiries.mob_no', )
            ->whereIn('enquiries.feedback', [2])
            ->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='text-center   actions text-nowrap'><a class='edit btn update_hover me-2' href='enquiryedit/".$row["id"]."'><i class='ri-pencil-line'></i></a> <button class='delete btn btn_delete' value=".$row["id"]."><i class='ri-delete-bin-6-line'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('notinterest');
    }
}