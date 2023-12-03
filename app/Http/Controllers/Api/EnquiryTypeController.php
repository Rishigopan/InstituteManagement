<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\EnquiryTypeResource;
use App\Models\EnquiryType;
use App\Models\Enquiry;
use App\Models\Feedback;
use Illuminate\Http\Request;

class EnquiryTypeController extends BaseController
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        


        $enquirytype = EnquiryType::all()->sortDesc();
        return $this->sendResponse("enquirytype", EnquiryTypeResource::collection($enquirytype), '1', 'Enquiry Type retrieved successfully.');

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
            'name' => ['required', 'max:25' ],
            'remarks' => ['max:250'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = EnquiryType::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("enquirytype", 'Exists' , '0', 'Enquiry Type Already Exists');
        } else {
            $enquirytype = EnquiryType::create($input);
            return $this->sendResponse("enquirytype", new EnquiryTypeResource($enquirytype), '1', 'Enquiry Type created successfully');
        }
    }
/**
     * Display the specified resource.
     *
     * @param  App\Models\EnquiryType  $enquiryType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enquiryType = EnquiryType::find($id);

        if (is_null($enquiryType)) {
            return $this->sendError('Enquiry  Type not found.');
        }

        return $this->sendResponse("enquirytype", new EnquiryTypeResource($enquiryType), '1', 'Enquiry Type retrieved successfully.');
    }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\EnquiryType  $EnquiryTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(EnquiryType $EnquiryTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\EnquiryType  $enquirytype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $enquirytype = EnquiryType::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = EnquiryType::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("enquirytype", 'Exists' , '0', 'Enquiry  Already Exists');
        } else {
            $enquirytype->name = $input['name'];
            $enquirytype->remarks = $input['remarks'];
            $enquirytype->updated_by = $input['updated_by'];
            $enquirytype->save();           
            return $this->sendResponse("enquirytype", new EnquiryTypeResource($enquirytype), '1', 'Enquiry Type Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\EnquiryType  $enquirytype
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquirytype = EnquiryType::find($id);

        if (is_null($enquirytype)) {
            return $this->sendError('Enquiry Types not found.');
        }
        $CheckfeedbackExists = Feedback::select('enquiry_id') -> where( 'enquiry_id', '=' , $id) -> get();
        $CheckEnqExists = Enquiry::select('enq_source') -> where( 'enq_source', '=' , $id) -> get();

        if (count($CheckfeedbackExists)  > 0  || count($CheckEnqExists ) > 0) {
            return $this->sendResponse("enquirytype", 'Exists' , '0', 'Enquiry Type is  in Use');
        } else {
            $enquirytype->delete();
            return $this->sendResponse("enquirytype", new EnquiryTypeResource($enquirytype), '1', 'Enquiry Type Deleted successfully');
        }
        
    }
}
