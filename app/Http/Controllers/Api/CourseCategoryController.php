<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CourseCategoryResource;
use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseCategoryController extends BaseController
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

        $coursecategory = CourseCategory::all()->sortDesc();
        return $this->sendResponse("coursecategory", CourseCategoryResource::collection($coursecategory), '1', 'Course Category retrieved successfully.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = CourseCategory::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("coursecategory", 'Exists' , '0', 'Course Category Already Exists');
        } else {
            $coursecategory = CourseCategory::create($input);
            return $this->sendResponse("coursecategory", new CourseCategoryResource($coursecategory), '1', 'Course Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\CourseCategory  $coursecategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coursecategory = CourseCategory::find($id);

        if (is_null($coursecategory)) {
            return $this->sendError('Course Category not found.');
        }

        return $this->sendResponse("coursecategory", new CourseCategoryResource($coursecategory), '1', 'Course Category retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\CourseCategory  $coursecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseCategory $coursecategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\CourseCategory  $coursecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coursecategory = CourseCategory::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = CourseCategory::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("coursecategory", 'Exists' , '0', 'Course Category Already Exists');
        } else {
            $coursecategory->name = $input['name'];
            $coursecategory->remarks = $input['remarks'];
            $coursecategory->updated_by = $input['updated_by'];
            $coursecategory->save();           
            return $this->sendResponse("coursecategory", new CourseCategoryResource($coursecategory), '1', 'Course Category Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\CourseCategory  $coursecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coursecategory = CourseCategory::find($id);

        if (is_null($coursecategory)) {
            return $this->sendError('Course Category not found.');
        }
        $CheckCourseExists = Course::select('course_category_id') -> where( 'course_category_id', '=' , $id) -> get();
        // $CheckStaffExists = Staff::select('department_id') -> where('department_id', '=' , $id) -> get();

        if (count($CheckCourseExists)  > 0  ) {
            return $this->sendResponse("coursecategory", 'Exists' , '0', 'Course Catagory is  in Use');
        } else {

        $coursecategory->delete();
        return $this->sendResponse("coursecategory", new CourseCategoryResource($coursecategory), '1', 'Course Category Deleted successfully');
        
    }
}
}