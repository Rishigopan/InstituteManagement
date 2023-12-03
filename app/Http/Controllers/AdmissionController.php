<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admission;
use App\Models\Enquiry;
use App\Models\Year;
use App\Models\Batch;
use App\Models\Course;

class AdmissionController extends Controller
{
    public function Admission(Request $request) {
       
        $ListStudents['student'] = Enquiry::select('id','name')->get();
        $ListAcademicYear['acadmic_year'] = Year::select('id','year')->get();
        $ListBatch['batch'] = Batch::select('id','batch_name')->get();
        $ListCourse['course'] = Course::select('id','course_name')->get();

     $data=array_merge($ListStudents,$ListAcademicYear,$ListBatch,$ListCourse);
     return view('Admission',$data);
    }

    public function getstudent(Request $request, $id) {
       
        $ListStudents['student'] = Enquiry::select('id','name')
                                    ->where('id',$id)->get();
        $ListAcademicYear['acadmic_year'] = Year::select('id','year')->get();
        $ListBatch['batch'] = Batch::select('id','batch_name')->get();
        $ListCourse['course'] = Course::select('id','course_name')->get();

     $data=array_merge($ListStudents,$ListAcademicYear,$ListBatch,$ListCourse);
     return view('AdmissionByEnquiry',$data);
    }



}
