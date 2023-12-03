<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseReq;
use App\Models\Qualification;
use App\Models\Document;
use App\Models\Department;
use App\Models\CourseType;
use App\Models\CourseCategory;
use App\Models\CourseProvider;
use App\Models\BatchType;
use Yajra\DataTables\DataTables;
class CourseMainController extends Controller
{
    public function Course(Request $request ) {

        $ListCourseType['CType']=CourseType::select('id','name')->get();
        $ListDepartment['department']=Department::select('id','name')->get();
        $ListCourse['course']=CourseProvider::select('id','provider_name')->get();
        $ListDocuments['document']=Document::select('id','name')->get();
        $ListQualification['Qualification']=Qualification::select('id','name')->get();
        $ListCcat['Cat']=CourseCategory::select('id','name')->get();
        $ListBatchType['Batchtype']=BatchType::select('id','name')->get();
        $data=array_merge($ListDocuments,$ListQualification, $ListCourse,$ListDepartment,$ListCourseType,$ListCcat,$ListBatchType);
        return view('Course',$data);      
        
    }
    public function CourseEdit(Request $request ,$id){
        if ($request->ajax()) {
            $data = Course::select( 'courses.id', 'course_providers.provider_name AS CoName','courses.code', 'courses.course_name', 'courses.printable_name','courses.batch_course',
             'department.name AS DepName ',
            'course_categories.name AS CourseName',
            'course_types.name AS CoTypeName', 'courses.zonal_discount')
            ->join('course_providers','courses.course_provider_id','=','course_providers.id')
            ->join('departments','courses.depatments.id','=','departments.id')
            ->join('course_categories','courses.course_category_id','=','course_categories.id')
            ->join('course_types','courses.course_type_id','=','course_types.id')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='text-center actions text-nowrap'>    <a  class='edit btn me-2' href='CourseEdit/".$row["id"]."'>  Update    </a>      </div>";            
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        
        $ListCourseType['CType']=CourseType::select('id','name')->get();
        $ListDepartment['department']=Department::select('id','name')->get();
        $ListCourse['course']=CourseProvider::select('id','provider_name')->get();
        $ListDocuments['document']=Document::select('id','name')->get();
        $ListQualification['Qualification']=Qualification::select('id','name')->get();
        $ListCcat['Cat']=CourseCategory::select('id','name')->get();
        $ListBatchType['Batchtype']=BatchType::select('id','name')->get();
        $checkboxvalues['requirement']=CourseReq::select('course_id','requirment_id','id','Requirement')->get();
         
        //Get documentrequirement ids
        $getDocuments = CourseReq::select('requirment_id')->where('Requirement' ,'=','Document' )->where('course_id','=',$id)->get();
        //Create a requirement array
                            $documentsArray = array();
                            //add ids in array
                            foreach ($getDocuments as $getDocumentsResults){
                                array_push($documentsArray, $getDocumentsResults['requirment_id']);
                            }
        //convert array to json and pass through compact
        $editDocuments['EditDocumentsArray'] = json_encode($documentsArray);

         //get qualification ids
        $getQualification=CourseReq::select('requirment_id')->where('Requirement' ,'=','qualification')->where('course_id','=',$id)->get();
                        $qualificationArray=array();
                        foreach ($getQualification as $getqualificationResults){
                            array_push($qualificationArray, $getqualificationResults['requirment_id']);
                        }
                       
        $editQualification['EditQualificationArray'] = json_encode($qualificationArray);

        $getBatch=CourseReq::select('requirment_id')->where('Requirement' ,'=','Batch')->where('course_id','=',$id)->get();
                        $batchArray=array();
                        foreach ($getBatch as $getBatchResults){
                            array_push($batchArray, $getBatchResults['requirment_id']);
                        }
        $editBatch['EditBatchArray'] = json_encode($batchArray);

        $data=array_merge($ListDocuments,$ListQualification, $ListCourse,$ListDepartment,
        
        $ListCourseType,$ListCcat,$ListBatchType,$checkboxvalues,$editDocuments,$editQualification,$editBatch);
        $getdata = Course::find($id);

        
        return view('CourseEdit',compact('getdata'),$data );      
        
    } 
    
 



    public function CourseTable(Request $request) {

        if ($request->ajax()) {
            $data = Course::select( 'id', 'course_provider_id','code', 'course_name', 'printable_name','batch_course', 'department_id','course_category_id','course_type_id', 'zonal_discount')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = "<div class='text-center px-0  actions text-nowrap'><a class='edit btn update_hover me-2' href='CourseEdit/".$row["id"]."'><i class='ri-pencil-line'></i></a> <button class='delete btn btn_delete' value=".$row["id"]."><i class='ri-delete-bin-6-line'></i></button></div>";            return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('courseTable');      
        
    }
    }
    ?>