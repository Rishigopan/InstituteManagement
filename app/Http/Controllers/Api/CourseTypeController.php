<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CourseTypeResource;
use App\Models\CourseType ;
use App\Models\Course ;
use Illuminate\Http\Request;
class CourseTypeController extends BaseController
{
    public function index(){
        $coursetype = CourseType::all()->sortDesc();
        return $this->sendResponse("coursetype", CourseTypeResource::collection($coursetype), '1', 'Course Type retrieved successfully.');
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
        $CheckExists = CourseType::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("coursetype", 'Exists' , '0', 'Course Type Already Exists');
        } else {
            $coursetype = CourseType::create($input);
            return $this->sendResponse("coursetype", new CourseTypeResource($coursetype), '1', 'Course Type created successfully');
        }
    }
/**
     * Display the specified resource.
     *
     * @param  App\Models\CourseType  $CourseType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coursetype = CourseType::find($id);

        if (is_null($coursetype)) {
            return $this->sendError('Course  Type not found.');
        }

        return $this->sendResponse("coursetype", new CourseTypeResource($coursetype), '1', 'Course Type retrieved successfully.');
    }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\CourseType  $CourseTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseType $CourseTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\CourseType  $CourseType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $CourseTypes = CourseType::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = CourseType::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("coursetype", 'Exists' , '0', 'Course  Already Exists');
        } else {
            $CourseTypes->name = $input['name'];
            $CourseTypes->remarks = $input['remarks'];
            $CourseTypes->updated_by = $input['updated_by'];
            $CourseTypes->save();           
            return $this->sendResponse("coursetype", new CourseTypeResource($CourseTypes), '1', 'Course Type Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\CourseType  $CourseType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coursetype = CourseType::find($id);

        if (is_null($coursetype)) {
            return $this->sendError('Course Types not found.');
        }
        $CheckCourseExists = Course::select('id') -> where( 'id', '=' , $id) -> get();
        // $CheckStaffExists = Staff::select('department_id') -> where('department_id', '=' , $id) -> get();

        if (count($CheckCourseExists)  > 0  ) {
            return $this->sendResponse("coursecategory", 'Exists' , '0', 'Course Catagory is  in Use');
        } else {


        $coursetype->delete();
        return $this->sendResponse("CourseType", new CourseTypeResource($coursetype), '1', 'Course Type Deleted successfully');
        
    }
}
}