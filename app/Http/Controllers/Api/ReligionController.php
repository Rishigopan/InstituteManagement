<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ReligionResource;
use App\Models\Religion;
use App\Models\Caste;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReligionController extends BaseController
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

        $religions = Religion::all()->sortDesc();
        return $this->sendResponse("religions", ReligionResource::collection($religions), '1', 'Religion retrieved successfully.');

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
        $CheckExists = Religion::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("religions", 'Exists' , '0', 'Religion Already Exists');
        } else {
            $religions = Religion::create($input);
            return $this->sendResponse("religions", new ReligionResource($religions), '1', 'Religion created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Religion  $religions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $religions = Religion::find($id);

        if (is_null($religions)) {
            return $this->sendError('Religion not found.');
        }

        return $this->sendResponse("religions", new ReligionResource($religions), '1', 'Religion retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Religion  $religions
     * @return \Illuminate\Http\Response
     */
    public function edit(Religion $religions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Religion  $religions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $religions = Religion::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Religion::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("religions", 'Exists' , '0', 'Religion Already Exists');
        } else {
            $religions->name = $input['name'];
            $religions->remarks = $input['remarks'];
            $religions->updated_by = $input['updated_by'];
            $religions->save();           
            return $this->sendResponse("religions", new ReligionResource($religions), '1', 'Religion Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Religion  $religions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $religions = Religion::find($id);

        if (is_null($religions)) {
            return $this->sendError('Religion not found.');
        }
        $CheckCasteExists = Caste::select('religion_id') -> where( 'religion_id', '=' , $id) -> get();
        // $CheckEnqExists = Enquiry::select('enq_source') -> where( 'enq_source', '=' , $id) -> get();

        if (count($CheckCasteExists) > 0) {
            return $this->sendResponse("religions", 'Exists' , '0', 'Religion is  in Use');
        } else {

        $religions->delete();
        return $this->sendResponse("religions", new ReligionResource($religions), '1', 'Religion Deleted successfully');
        
        }
    }
}