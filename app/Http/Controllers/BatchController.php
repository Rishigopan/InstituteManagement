<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\BatchType;
use App\Models\Branch;
use App\Models\Course;
use App\Models\CourseProvider;
use App\Models\Session;
use Illuminate\Http\Request;

use Yajra\DataTables\DataTables;

class BatchController extends Controller
{
    public function Batch(Request $request)
    {

        
        $ListBranch['branch'] = Branch::select('id', 'branch_name')->get();
         $ListCourseProvider['Course'] = CourseProvider::select('id', 'provider_name')->get();
         $ListCourse['CourseName'] = Course::select('id', 'course_name')->get();
        $ListBatch['batch'] = Batch::select('id', 'batch_name')->get();
        $ListBatchType['batchtype'] = BatchType::select('id', 'name')->get();
        $data = array_merge($ListBranch,$ListCourseProvider,$ListCourse,  $ListBatch, $ListBatchType);




        //print_r($newDateTime);
        return view('Batch', $data);
    }
    public function BatchTable(Request $request)
    {

        if ($request->ajax()) {
            $data = Batch::select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = "<div class='text-center   actions text-nowrap'><a class='edit btn update_hover me-2' href='BatchEdit/" . $row["id"] . "'><i class='ri-pencil-line'></i></a> <button class='delete btn btn_delete' value=" . $row["id"] . "><i class='ri-delete-bin-6-line'></i></button></div>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('BatchTable');
    }
    public function BatchEdit(Request $request, $id)
    {
      
        $ListBranch['branch'] = Branch::select('id', 'branch_name')->get();
        $ListCourseProvider['Course'] = CourseProvider::select('id', 'provider_name')->get();
        $ListCourse['CourseName'] = Course::select('id', 'course_name')->get();
        $ListBatch['batch'] = Batch::select('id', 'batch_name')->get();
        $ListBatchType['batchtype'] = BatchType::select('id', 'name')->get();




        $getdata = Batch::find($id);
        $getBatchid = Session::select('batch_id')->get();
        $getSession = Session::find($getBatchid);


        //Get session ids
        $sessionDetails = Session::select('id','sessionFrom','sessionTo')->where('batch_id', '=', $id)->get();
        
        $data = array_merge($ListBranch, $ListCourseProvider, $ListCourse, $ListBatch, $ListBatchType);

        return view('BatchEdit', compact('getdata', 'getSession','sessionDetails'), $data);
    }
}
