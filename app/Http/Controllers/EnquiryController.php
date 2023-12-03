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
use App\Models\CourseType;
use Yajra\DataTables\DataTables;
class EnquiryController extends Controller

{
    public function Enquiry(Request $request) {
       
        $ListReligions['religion'] = Religion::select('id','name')->get();
        $ListCaste['caste'] = Caste::select('id','name')->get();
        $ListParentInfo['parent'] = ParentInfo::select('id','father_name')->get();
        $ListStaff['staffs'] = Staff::select('id','name')->get();
        $ListCourse['course'] = Course::select('id','course_name')->get();
        $ListEnquiry['enquiry'] = EnquiryType::select('id','name')->get();
        $ListBranch['branch'] = Branch::select('id','branch_name')->get();
        $ListStream['stream'] = Stream::select('id','stream')->get();
        $ListCourseType['course_type'] = CourseType::select('id','name')->get();
     $data=array_merge($ListReligions,$ListCaste,$ListParentInfo,$ListStaff,$ListCourse,
     $ListEnquiry,$ListBranch,$ListStream,$ListCourseType);
     return view('Enquiry',$data);
    }

    public function EnquiryTable(Request $request) {
        
        if ($request->ajax()) {
            $data = Enquiry::select('enquiries.id', 'enquiries.name', 'enquiries.mob_no', 'branches.branch_name', 'enquiries.remarks','enquiries.leaddata')
            ->leftJoin('branches', 'enquiries.branch_id', '=', 'branches.id')
            ->whereNotIn('enquiries.feedback', [1,2])
            ->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='text-center   actions text-nowrap'><a class='edit btn update_hover me-2' href='enquiryedit/".$row["id"]."'><i class='ri-pencil-line'></i></a> <button class='delete btn btn_delete' value=".$row["id"]."><i class='ri-delete-bin-6-line'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('EnquiryTable');
    }
    public function EnquiryEdit(Request $request ,$id) {
        
        
        $ListReligions['religion'] = Religion::select('id','name')->get();
        $ListCaste['caste'] = Caste::select('id','name')->get();
        $ListParentInfo['parent'] = ParentInfo::select('id','father_name')->get();
        $ListStaff['staffs'] = Staff::select('id','name')->get();
        $ListCourse['course'] = Course::select('id','course_name')->get();
        $ListEnquiry['enquiry'] = EnquiryType::select('id','name')->get();
        $ListBranch['branch'] = Branch::select('id','branch_name')->get();
        $ListStream['stream'] = Stream::select('id','stream')->get();
        $ListCourseType['course_type'] = CourseType::select('id','name')->get();
        
     $data=array_merge($ListReligions,$ListCaste,$ListParentInfo,$ListStaff,$ListCourse,
     $ListEnquiry,$ListBranch,$ListStream,$ListCourseType);
     $Enquiry = Enquiry::find($id);
     return view('EnquiryEdit',compact('Enquiry'),$data);
    }
  
}

?>