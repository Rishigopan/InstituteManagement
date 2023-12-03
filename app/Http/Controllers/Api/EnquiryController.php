<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\EnquiryResource;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\followup;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class EnquiryController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $enquiries = Enquiry::whereNotIn('feedback', [2])->get()->sortDesc();
    return $this->sendResponse("enquiries", EnquiryResource::collection($enquiries), '1', 'Enquiries retrieved successfully.');

       
    }
//branch Wise staff
public function getStaffName($branchId)
{
    $staff = Staff::where('branch_id', $branchId)->
                                    select('id', 'name') 
                                    ->get();
    return response()->json($staff);
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

        $input['name'] = $input['name'] ?? '';
        $input['religion_id'] = $input['religion_id'] ?? 0;
        $input['caste_id'] = $input['caste_id'] ?? 0;
        $input['stream_id'] = $input['stream_id'] ?? 0;
        $input['religion_id'] = $input['religion_id'] ?? 0;
        $input['course_id'] = $input['course_id'] ?? 0;
        $input['enq_source'] = $input['enq_source'] ?? 0;
        $input['Assignedto'] = $input['Assignedto'] ?? 0;
        $input['parent_info_id'] = $input['parent_info_id'] ?? 0;
        
        $input['enq_stage'] = '';
        $validator = Validator::make($input, [
            'name' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'max:20'],
            'dob' => 'nullable',
            'remarks' => 'nullable',
            'religion_id' => 'nullable',
            'caste_id' => 'nullable',
            'education' => 'nullable',
            'stream_id' => 'nullable',
            'parent_info_id' => 'nullable',
            'colg_schl' => 'nullable',
            'staff_id'=> 'nullable',
            'Assignedto'=> 'required',
            'country' => 'nullable',
            'state' => 'nullable',
            'location'=>'nullable',
            'address'=>'nullable',
            'pincode'=>'nullable',
            'mob_no'=>'nullable',
            'email' => ['nullable', 'string', 'email', 'max:120'],
            'enq_date'=>'nullable',
            'course_id'=>'nullable',
            'discount'=>'nullable',
            'enq_source'=>'nullable',
            'enq_stage'=>'nullable',
            'next_folow_up'=>'nullable',
            'leaddata' => 'required'
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        
        $CheckExists = Enquiry::select('mob_no','name')->where(['name' => $input['name']])->where(['mob_no' => $input['mob_no']])->get();
        if (count($CheckExists ) > 0) {
            return $this->sendResponse("enquiries", 'Exists' , '0', 'Enquiry Type Already Exists');
        } else {
            $enquiry = Enquiry::create($input);
            return $this->sendResponse("enquiries", new EnquiryResource($enquiry), '1', 'Enquiry  created successfully');
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $enquiry = Enquiry::find($id);

        if (is_null($enquiry)) {
            return $this->sendError('Enquiry not found.');
        }

        return $this->sendResponse("enquiry", $enquiry, '1', 'Enquiry retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $Enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enquiry = Enquiry::find($id);
        date('d-m-Y', strtotime($enquiry->dob));
        $input = $request->all();
        $input['religion_id'] = $input['religion_id'] ?? 0;
        $input['caste_id'] = $input['caste_id'] ?? 0;
        $input['stream_id'] = $input['stream_id'] ?? 0;
        $input['religion_id'] = $input['religion_id'] ?? 0;
        $input['course_id'] = $input['course_id'] ?? 0;
        $input['enq_source'] = $input['enq_source'] ?? 0;
        $input['Assignedto'] = $input['Assignedto'] ?? 0;
        $input['parent_info_id'] = $input['parent_info_id'] ?? 0;
        $input['enq_stage'] = '';
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', 'max:20'],
            'dob' => 'nullable',
            'remarks' => 'nullable',
            'religion_id' => 'nullable',
            'caste_id' => 'nullable',
            'education' => 'nullable',
            'stream_id' => 'nullable',
            'parent_info_id' => 'nullable',
            'colg_schl' => 'nullable',
            'staff_id'=> 'nullable',
            'Assignedto'=> 'nullable',
            'country' => 'nullable',
            'state' => 'nullable',
            'location'=>'nullable',
            'address'=>'nullable',
            'pincode'=>'nullable',
            'mob_no'=>'nullable',
            'email' => ['nullable', 'string', 'email', 'max:120'],
            'enq_date'=>'nullable',
            'course_id'=>'nullable',
            'discount'=>'nullable',
            'enq_source'=>'nullable',
            'enq_stage'=>'nullable',
            'next_folow_up'=>'nullable',
            'leaddata' => 'nullable'
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Enquiry::select('mob_no','name')->where(['name' => $input['name']])->where(['mob_no' => $input['mob_no']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("enquiries", 'Exists' , '0', 'Enquiry  Already Exists');
        } else {
            $enquiry->name = $input['name'];
            $enquiry->gender = $input['gender'];
            $enquiry->dob = $input['dob'];
            
            $enquiry->remarks = $input['remarks'];
            $enquiry->religion_id = $input['religion_id'];
            $enquiry->caste_id = $input['caste_id'];
            $enquiry->Assignedto = $input['Assignedto'];
            $enquiry->education = $input['education'];
           
            $enquiry->stream_id = $input['streem'];
            $enquiry->branch_id = $input['branch'];
            $enquiry->colg_schl = $input['colg_schl'];
            $enquiry->photo = $input['photo'];
            $enquiry->country = $input['country'];
            $enquiry->state = $input['state'];
            $enquiry->location = $input['location'];
            $enquiry->address = $input['address'];
            $enquiry->pincode = $input['pincode'];
            $enquiry->mob_no = $input['mob_no'];
            $enquiry->enq_date = $input['enq_date'];
            
           
            
            $enquiry->course_id = $input['course_id'];
            $enquiry->discount = $input['discount'];
            $enquiry->enq_source = $input['enq_source'];
            $enquiry->enq_stage = $input['enq_stage'];
            $enquiry->next_folow_up = $input['next_folow_up'];
            $enquiry->leaddata = $input['leaddata'];


            $enquiry->save();           
            return $this->sendResponse("enquiries", new EnquiryResource($enquiry), '1', 'Enquiry  Updated successfully');
    }
}

public function getCourse($branchId)
{
    $courses = Course::where('course_type_id', $branchId)
                    ->select('id', 'course_name')
                    ->get();
    return response()->json($courses);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $Enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = Enquiry::find($id);

        if (is_null($enquiry)) {
            return $this->sendError('Enquiry  not found.');
        }
        
        $enquiry->delete();
        
        return $this->sendResponse("enquiries", new EnquiryResource($enquiry), '1', 'Enquiry  Deleted successfully');
        
    }

}
?>