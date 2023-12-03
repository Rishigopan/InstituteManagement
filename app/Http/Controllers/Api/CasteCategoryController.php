<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CasteCategoryResource;
use App\Models\CasteCategory;
use App\Models\Caste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CasteCategoryController extends BaseController
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

        $castecategories = CasteCategory::all()->sortDesc();
        return $this->sendResponse("castecategories", CasteCategoryResource::collection($castecategories), '1', 'Caste Category retrieved successfully.');

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
        $CheckExists = CasteCategory::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("castecategories", 'Exists' , '0', 'Caste Category Already Exists');
        } else {
            $castecategories = CasteCategory::create($input);
            return $this->sendResponse("castecategories", new CasteCategoryResource($castecategories), '1', 'Caste Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\CasteCategory  $castecategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $castecategories = CasteCategory::find($id);

        if (is_null($castecategories)) {
            return $this->sendError('Caste Category not found.');
        }

        return $this->sendResponse("castecategories", new CasteCategoryResource($castecategories), '1', 'Caste Category retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\CasteCategory  $castecategories
     * @return \Illuminate\Http\Response
     */
    public function edit(CasteCategory $castecategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\CasteCategory  $castecategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $castecategories = CasteCategory::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = CasteCategory::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("castecategories", 'Exists' , '0', 'Caste Category Already Exists');
        } else {
            $castecategories->name = $input['name'];
            $castecategories->remarks = $input['remarks'];
            $castecategories->updated_by = $input['updated_by'];
            $castecategories->save();           
            return $this->sendResponse("castecategories", new CasteCategoryResource($castecategories), '1', 'Caste Category Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\CasteCategory  $castecategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $castecategories = CasteCategory::find($id);

        if (is_null($castecategories)) {
            return $this->sendError('Division not found.');
        }
        $CheckCasteExists = Caste::select('caste_category_id') -> where( 'caste_category_id', '=' , $id) -> get();

        if (count($CheckCasteExists)  > 0  ) {
            return $this->sendResponse("castecategories", 'Exists' , '0', 'Caste Category  is  in Use');
        } else {
        $castecategories->delete();
        return $this->sendResponse("castecategories", new CasteCategoryResource($castecategories), '1', 'Caste Category Deleted successfully');
        
    }
}
}