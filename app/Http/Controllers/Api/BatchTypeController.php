<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BatchTypeResource;
use App\Models\BatchType;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BatchTypeController extends BaseController
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

        $batchtypes = BatchType::all()->sortDesc();
        return $this->sendResponse("batchtypes", BatchTypeResource::collection($batchtypes), '1', 'Batch Type retrieved successfully.');

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
        $CheckExists = BatchType::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("batchtypes", 'Exists' , '0', 'Batch Type Already Exists');
        } else {
            $batchtypes = BatchType::create($input);
            return $this->sendResponse("batchtypes", new BatchTypeResource($batchtypes), '1', 'Batch Type created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\BatchType  $batchtypes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batchtypes = BatchType::find($id);

        if (is_null($batchtypes)) {
            return $this->sendError('Batch Type not found.');
        }

        return $this->sendResponse("batchtypes", new BatchTypeResource($batchtypes), '1', 'Batch Type retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\BatchType  $batchtypes
     * @return \Illuminate\Http\Response
     */
    public function edit(BatchType $batchtypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\BatchType  $batchtypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $batchtypes = BatchType::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = BatchType::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("batchtypes", 'Exists' , '0', 'Batch Type Already Exists');
        } else {
            $batchtypes->name = $input['name'];
            $batchtypes->remarks = $input['remarks'];
            $batchtypes->updated_by = $input['updated_by'];
            $batchtypes->save();           
            return $this->sendResponse("batchtypes", new BatchTypeResource($batchtypes), '1', 'Batch Type Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\BatchType  $batchtypes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batchtypes = BatchType::find($id);

        if (is_null($batchtypes)) {
            return $this->sendError('Batch Types not found.');
        }
        // $CheckCourseExists = Course::select('batch_course') -> where( 'batch_course', '=' , $id) -> get();
        // // $CheckStaffExists = Staff::select('department_id') -> where('department_id', '=' , $id) -> get();

        // if (count($CheckCourseExists)  > 0  ) {
        //     return $this->sendResponse("batchtypes", 'Exists' , '0', 'Batch Type is  in Use');
        // } else {

        $batchtypes->delete();
        return $this->sendResponse("batchtypes", new BatchTypeResource($batchtypes), '1', 'Batch Type Deleted successfully');
        
    // }
}
}
