<?php

namespace App\Http\Controllers\Api;

use App\Models\CourseReq;
use App\Models\Course;
use App\Models\Qualification;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CourseReqResource;
use App\Http\Resources\courseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // if (!auth()->user()) {
        //    return $this->sendError('Access Denied.', ["You dont have privilege to access this page . Sorry Contact Administrator"]);
        // }

        $Course = CourseReq::all()->sortDesc();
        return $this->sendResponse("Course", CourseReqResource::collection($Course), '1', 'Course  retrieved successfully.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

    {

        $input = $request->all();

        $validator = Validator::make($input, [

            'requirment_id' => ['required', 'max:50'],
            'Requirement' => ['nullable', 'max:50'],
            'course_id' => ['nullable', 'max:50'],
            'course_provider_id' => ['required', 'max:30'],
            'code' => ['max:20'],
            'course_name' => ['required', 'max:120'],
            'printable_name' => ['nullable','max:120'],
            'batch_course' => ['nullable','max:50'],
            'department_id' => ['nullable', 'max:50'],
            'course_category_id' => ['nullable', 'max:50'],
            'course_type_id' => ['nullable', 'max:50'],
            'zonal_discount' => ['nullable','max:50'],
            'created_by' => ['max:10'],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = Course::select('course_name')->where(['course_name' => $input['course_name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("Course", 'Exists', '0', 'Course Already Exists');
        } else {
            DB::table('course_requirmenttable')->insertGetId([
                'requirment_id' => $input['requirment_id'],
                'Requirement' => $input['Requirement'],
                'course_id' => $input['course_id'],
            ]);
        }
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [

            'requirment_id' => ['required', 'max:50'],
            'Requirement' => ['nullable', 'max:50'],
            'course_id' => ['nullable', 'max:50'],
            'course_provider_id' => ['required', 'max:30'],
            'code' => ['max:20'],
            'course_name' => ['required', 'max:120'],
            'printable_name' => ['nullable','max:120'],
            'batch_course' => ['nullable','max:50'],
            'department_id' => ['nullable', 'max:50'],
            'course_category_id' => ['nullable', 'max:50'],
            'course_type_id' => ['nullable', 'max:50'],
            'zonal_discount' => ['nullable','max:50'],
            'created_by' => ['max:10'],


        ]);


        $courses = $request->all();

        $CourseInput = Course::create($courses);


        //$CourseInput['requirment_id'] = $CourseInput['requirment_id'] ?? 0;

        $DocumentArray = explode(",", $request->documents);

        foreach ($DocumentArray as $DocumentArrayElements) {

            DB::table('course_requirmenttable')->insertGetId([
                
                'requirment_id' => $DocumentArrayElements ? :0,
                'Requirement' => 'Document',
                'course_id' => $CourseInput->id,
            ]);
        }
        $QualificationArray = explode(",", $request->qualification);

        foreach ($QualificationArray as $QualificationArrayElements) {

            DB::table('course_requirmenttable')->insertGetId([
                
                'requirment_id' => $QualificationArrayElements ? :0,
                'Requirement' => 'qualification',
                'course_id' => $CourseInput->id,
            ]);
        }
        $BatchArray = explode(",", $request->batch);

        foreach ($BatchArray as $BatchArrayElements) {

            DB::table('course_requirmenttable')->insertGetId([
                
                'requirment_id' => $BatchArrayElements ? :0,
                'Requirement' => 'Batch',
                'course_id' => $CourseInput->id,
            ]);
            return $this->sendResponse("courses", new CourseResource($CourseInput), '1', 'Course Store');
        }
    }




    public function update(Request $request, $id)
    {
        $Courses = Course::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'requirment_id' => ['required', 'max:50'],
            'Requirement' => ['nullable', 'max:50'],
            'course_id' => ['nullable', 'max:50'],
            'course_provider_id' => ['required', 'max:30'],
            'code' => ['max:20'],
            'course_name' => ['required', 'max:50'],
            'printable_name' => ['nullable','max:120'],
            'batch_course' => ['nullable','max:50'],
            'department_id' => ['nullable', 'max:50'],
            'course_category_id' => ['nullable', 'max:50'],
            'course_type_id' => ['nullable', 'max:50'],
            'zonal_discount' => ['nullable','max:50'],
            'updated_by' => ['max:10'],

        ]);

        DB::table('course_requirmenttable')->where('course_id',$id)->delete();

        $affected = DB::table('courses')->where('id', $id)->update([
            'course_provider_id' => $input['course_provider_id'],
            'code' => $input['code'],
            'course_name' => $input['course_name'],
            'printable_name' => $input['printable_name'],
            'batch_course' => $input['batch_course'],
            'department_id' => $input['department_id'],
            'course_category_id' => $input['course_category_id'],
            'course_type_id' => $input['course_type_id'],
            'zonal_discount' => $input['zonal_discount'],

        ]);


        $DocumentArrayUpdate = explode(",", $request->documents);
        foreach ($DocumentArrayUpdate as $DocumentArrayUpdateElements) {
            DB::table('course_requirmenttable')->insertGetId([
                'requirment_id' => $DocumentArrayUpdateElements ? :0,
                'Requirement' => 'Document',
                'course_id' => $request->id,
            ]);
        }


        $QualificationArrayUpdate = explode(",", $request->qualification);
        foreach ($QualificationArrayUpdate as $QualificationArrayUpdateElements) {
            DB::table('course_requirmenttable')->insertGetId([
                'requirment_id' => $QualificationArrayUpdateElements ? :0,
                'Requirement' => 'qualification',
                'course_id' => $request->id,
            ]);
        }


        $BatchArrayUpdate = explode(",", $request->batch);
        foreach ($BatchArrayUpdate as $BatchArrayUpdateElements) {
            DB::table('course_requirmenttable')->insertGetId([
                'requirment_id' => $BatchArrayUpdateElements ? :0,
                'Requirement' => 'Batch',
                'course_id' => $request->id,
            ]);
        }


        DB::commit();
        return $this->sendResponse("courses",  new CourseReqResource($Courses), '1', 'Course Store successfully');
    }






    public function show($id)
    {
        $course = Course::find($id);

        if (is_null($course)) {
            return $this->sendError('Course  not found.');
        }

        return $this->sendResponse("course", new CourseResource($course), '1', 'Course  retrieved successfully.');
    }

    public function destroy($id)
    {
        $Courses = Course::find($id);

        if (is_null($Courses)) {
            return $this->sendError('Course  not found.');
        }

        $Courses->delete();
        return $this->sendResponse("Courses", new CourseResource($Courses), '1', 'Course  Deleted successfully');
        
    }


}
