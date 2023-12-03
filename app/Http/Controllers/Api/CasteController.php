<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CasteResource;
use App\Models\Caste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CasteController extends BaseController
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

        $castes = Caste::all()->sortDesc();
        return $this->sendResponse("castes", CasteResource::collection($castes), '1', 'Caste retrieved successfully.');

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
            'religion_id' => ['required', 'max:25'],
            'caste_category_id' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = Caste::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("castes", 'Exists' , '0', 'Caste Already Exists');
        } else {
            $castes = Caste::create($input);
            return $this->sendResponse("castes", new CasteResource($castes), '1', 'Caste created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Caste  $castes
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $castes = Caste::find($id);

        if (is_null($castes)) {
            return $this->sendError('Caste not found.');
        }

        return $this->sendResponse("castes", new CasteResource($castes), '1', 'Caste retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Caste  $castes
     * @return \Illuminate\Http\Response
     */
    public function edit(Caste $castes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Caste  $castes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $castes = Caste::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'religion_id' => ['required', 'max:25'],
            'caste_category_id' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Caste::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("castes", 'Exists' , '0', 'Caste Already Exists');
        } else {
            $castes->name = $input['name'];
            $castes->religion_id = $input['religion_id'];
            $castes->caste_category_id = $input['caste_category_id'];
            $castes->remarks = $input['remarks'];
            $castes->updated_by = $input['updated_by'];
            $castes->save();           
            return $this->sendResponse("castes", new CasteResource($castes), '1', 'Caste Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Caste  $castes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $castes = Caste::find($id);

        if (is_null($castes)) {
            return $this->sendError('Caste not found.');
        }

        $castes->delete();
        return $this->sendResponse("castes", new CasteResource($castes), '1', 'Caste Deleted successfully');
        
    }
}
