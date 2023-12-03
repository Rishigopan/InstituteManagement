<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\YearResource;
use App\Models\Year;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AcademicYearController extends BaseController
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

        $years = Year::all()->sortDesc();
        return $this->sendResponse("years", YearResource::collection($years), '1', 'Academic Year retrieved successfully.');

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
            'year' => ['required'],
            'remark' => ['max:250'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = Year::select('year')->where(['year' => $input['year']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("year", 'Exists' , '0', 'Year Already Exists');
        } else {
            $year = Year::create($input);
            return $this->sendResponse("year", new YearResource($year), '1', 'Year added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $year = Year::find($id);

        if (is_null($year)) {
            return $this->sendError('Year not found.');
        }

        return $this->sendResponse("year", new YearResource($year), '1', 'Year retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $year = Year::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'year' => ['required'],
            'remark' => ['max:250'],
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Year::select('year')->where(['year' => $input['year']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("year", 'Exists' , '0', 'Year Already Exists');
        } else {
            $year->year = $input['year'];
            $year->remark = $input['remark'];
            
            $year->save();           
            return $this->sendResponse("year", new YearResource($year), '1', 'Year Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year = Year::find($id);

        if (is_null($year)) {
            return $this->sendError('Year not found.');
        }
      

        $year->delete();
        return $this->sendResponse("year", new YearResource($year), '1', 'Year Deleted successfully');
        
    }
}

