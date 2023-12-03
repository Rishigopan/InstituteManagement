<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendence;
use App\Models\Batch;
use App\Models\BatchType;
use App\Models\Course;
class AttendenceController extends Controller
{ 
    public function Attendence(Request $request) {

    
    $ListBatch['batch']=Batch::select('id','batch_name')->get();
    $ListBatchType['batchType']=BatchType::select('id','name')->get();
    $ListCourse['course']=Course::select('id','course_name')->get();
    $data=array_merge($ListBatch,$ListBatchType,$ListCourse);
    return view('Attendence',$data);      
    
}
}
