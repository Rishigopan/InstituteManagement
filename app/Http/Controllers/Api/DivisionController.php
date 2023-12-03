<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\DivisionResource;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisionController extends BaseController
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

        $divisions = Division::all()->sortDesc();
        return $this->sendResponse("divisions", DivisionResource::collection($divisions), '1', 'Division retrieved successfully.');

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
        $CheckExists = Division::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("divisions", 'Exists' , '0', 'Division Already Exists');
        } else {
            $divisions = Division::create($input);
            return $this->sendResponse("divisions", new DivisionResource($divisions), '1', 'Division created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Division  $divisions
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $divisions = Division::find($id);

        if (is_null($divisions)) {
            return $this->sendError('Division not found.');
        }

        return $this->sendResponse("divisions", new DivisionResource($divisions), '1', 'Division retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Division  $divisions
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $divisions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Division  $divisions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $divisions = Division::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Division::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("divisions", 'Exists' , '0', 'Division Already Exists');
        } else {
            $divisions->name = $input['name'];
            $divisions->remarks = $input['remarks'];
            $divisions->updated_by = $input['updated_by'];
            $divisions->save();           
            return $this->sendResponse("divisions", new DivisionResource($divisions), '1', 'Division Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Division  $divisions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $divisions = Division::find($id);

        if (is_null($divisions)) {
            return $this->sendError('Division not found.');
        }

        $divisions->delete();
        return $this->sendResponse("divisions", new DivisionResource($divisions), '1', 'Division Deleted successfully');
        
    }
}
