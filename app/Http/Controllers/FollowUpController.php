<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Caste;
use App\Models\Stream;
use App\Models\ParentInfo;
use App\Models\Qualification;
use App\Models\Religion;
use App\Models\Enquiry;
use App\Models\EnquiryType;
use App\Models\Feedback;
use App\Models\Staff;

class FollowUpController extends Controller
{
    
    public function Followup(Request $request) {

    
      
        $ListCourse['course']=Course::select('id','course_name')->get();
        $ListStaff['staffs']=Staff::select('id','name')->get();
        $ListEnquiry['EnquiryType']=EnquiryType::select('id','name')->get();
        
        $ListFeedback['feedback']=Feedback::select('id','feedback')->get();
        $ListStream['stream']=Stream::select('id','stream')->get();
        
        $ListBranch['branch']=Branch::select('id','branch_name')->get();
        $GetPhoneAndName['NameAndPhone']=Enquiry::select('id','name','mob_no')->get();

        
        $data=array_merge($ListCourse,$ListEnquiry,
                        $ListStream, $ListBranch,$ListStaff,$ListFeedback,$GetPhoneAndName);
        return view('FollowUp',$data);      
        
    }
}
