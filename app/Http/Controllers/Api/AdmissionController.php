<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\AdmissionResource;
use App\Models\Admission;
use App\Models\Enquiry;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdmissionController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $admissions = Admission::all()->sortDesc();
       
        return $this->sendResponse("admissions", AdmissionResource::collection($admissions), '1', 'Admissions retrieved successfully.');
        
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
           
        'student_id' => 'required',
        'academic_year' => 'required',
        'date_of_admission' => 'required',
        'admission_no' => 'required|numeric',
        'course_id' => 'required',
        'batch_id' => 'required',
        'join_date' => 'required',
        'complete_date' => 'required',
        'id_no' => 'required|numeric' ,
        'reg_no'=>'required|numeric',
        'roll_no'=>'required|numeric',
        'email' => ['required', 'string', 'email', 'max:120'], 
        'fee_plan'=>'required',
        'special_discount'=>'required|numeric',
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error', $validator->errors());
    }
    
    else {
        
        Enquiry::where('id', $input['student_id'])->update(['feedback' => 1]);
        $Admission = Admission::create($input);
        return $this->sendResponse("admissions", new AdmissionResource($Admission), '1', 'Admission  created successfully');
       
    }
   


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admission  $Admission
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $Admission = Admission::find($id);

        if (is_null($Admission)) {
            return $this->sendError('Admission not found.');
        }

        return $this->sendResponse("Admission", $Admission, '1', 'Admission retrieved successfully.');

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admission  $Admission
     * @return \Illuminate\Http\Response
     */
    public function edit(Admission $Admission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admission  $Admission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Admission = Admission::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            
            'student_id' => 'required',
            'academic_year' => 'required',
            'admission_no' => 'required|numeric',
            'course_id' => 'required',
            'batch_id' => 'required',
            'join_date' => 'required',
            'complete_date' => 'required',
            'id_no' => 'required|numeric', 
            'reg_no'=>'required|numeric',
            'roll_no'=>'required|numeric',
            'email' => ['required', 'string', 'email', 'max:120'], 
            'fee_plan'=>'required',
            'special_discount'=>'required|numeric',
            'updated_by'=>'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        else {
            $Admission->student_id = $input['student_id'];
            $Admission->academic_year = $input['academic_year'];
            $Admission->admission_no = $input['admission_no'];
            $Admission->course_id = $input['course_id'];
            $Admission->join_date = $input['join_date'];
            $Admission->complete_date = $input['complete_date'];
            $Admission->id_no = $input['id_no'];
            $Admission->reg_no = $input['reg_no'];
            $Admission->roll_no = $input['roll_no'];
            $Admission->email = $input['email'];
            $Admission->fee_plan = $input['fee_plan'];
            $Admission->special_discount = $input['special_discount'];
            $Admission->updated_by = $input['updated_by'];


            $Admission->save();           
            return $this->sendResponse("admissions", new AdmissionResource($Admission), '1', 'Admission Type Updated successfully');
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admission  $Admission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Admission = Admission::find($id);

        if (is_null($Admission)) {
            return $this->sendError('Admission  not found.');
        }

        $Admission->delete();
        return $this->sendResponse("admissions", new AdmissionResource($Admission), '1', 'Admission Type Deleted successfully');
        
    }
}

?>