<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\RelationResource;
use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RelationController extends BaseController
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

        $relations = Relation::all()->sortDesc();
        return $this->sendResponse("relations", RelationResource::collection($relations), '1', 'Relation retrieved successfully.');

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
        $CheckExists = Relation::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("relations", 'Exists' , '0', 'Relation Already Exists');
        } else {
            $relations = Relation::create($input);
            return $this->sendResponse("relations", new RelationResource($relations), '1', 'Relation created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Relation  $relations
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = Relation::find($id);

        if (is_null($relations)) {
            return $this->sendError('Relation not found.');
        }

        return $this->sendResponse("relations", new RelationResource($relations), '1', 'Relation retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Relation  $relations
     * @return \Illuminate\Http\Response
     */
    public function edit(Relation $relations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Relation  $relations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $relations = Relation::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Relation::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("relations", 'Exists' , '0', 'Relation Already Exists');
        } else {
            $relations->name = $input['name'];
            $relations->remarks = $input['remarks'];
            $relations->updated_by = $input['updated_by'];
            $relations->save();           
            return $this->sendResponse("relations", new RelationResource($relations), '1', 'Relation Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Relation  $relations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relations = Relation::find($id);

        if (is_null($relations)) {
            return $this->sendError('Relation not found.');
        }

        $relations->delete();
        return $this->sendResponse("relations", new RelationResource($relations), '1', 'Relation Deleted successfully');
        
    }
}
