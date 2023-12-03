<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\QualificationResource;
use App\Models\Qualification;
use App\Models\Stream;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QualificationController extends BaseController
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

        $qualifications = Qualification::all()->sortDesc();
        return $this->sendResponse("qualifications", QualificationResource::collection($qualifications), '1', 'Qualification retrieved successfully.');

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
        $CheckExists = Qualification::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("qualifications", 'Exists' , '0', 'Qualification Already Exists');
        } else {
            $qualifications = Qualification::create($input);
            return $this->sendResponse("qualifications", new QualificationResource($qualifications), '1', 'Qualification created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Qualification  $qualifications
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qualifications = Qualification::find($id);

        if (is_null($qualifications)) {
            return $this->sendError('Qualification not found.');
        }

        return $this->sendResponse("qualifications", new QualificationResource($qualifications), '1', 'Qualification retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Qualification  $qualifications
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualifications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Document  $qualifications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $qualifications = Qualification::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Qualification::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("qualifications", 'Exists' , '0', 'Qualification Already Exists');
        } else {
            $qualifications->name = $input['name'];
            $qualifications->remarks = $input['remarks'];
            $qualifications->updated_by = $input['updated_by'];
            $qualifications->save();           
            return $this->sendResponse("qualifications", new QualificationResource($qualifications), '1', 'Qualification Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Qualification  $qualifications
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qualifications = Qualification::find($id);

        if (is_null($qualifications)) {
            return $this->sendError('Qualification not found.');
        }
        $CheckStreamExists = Stream::select('qualification_id') -> where( 'qualification_id', '=' , $id) -> get();
         $CheckCourseExists = Course::select('course_type_id') -> where( 'course_type_id', '=' , $id) -> get();

        if (count($CheckStreamExists)  > 0 || count($CheckCourseExists ) > 0) {
            return $this->sendResponse("qualifications", 'Exists' , '0', ' Qualification is  in Use');
        } else {

        $qualifications->delete();
        return $this->sendResponse("qualifications", new QualificationResource($qualifications), '1', 'Qualification Deleted successfully');
        
    }
}
}