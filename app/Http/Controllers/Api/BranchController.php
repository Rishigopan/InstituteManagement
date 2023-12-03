<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends BaseController
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

        $branches = Branch::all()->sortDesc();
        return $this->sendResponse("branches", BranchResource::collection($branches), '1', 'Branch retrieved successfully.');

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
            'branch_name' => ['required', 'max:35'],
            'code' => ['required', 'max:50'],
            'permanent_address' => ['nullable', 'max:500'],
            'permanent_mobile_no' => [ 'nullable','max:25'],
            'permanent_lan_line_no' => [ 'nullable', 'max:25'],
            'permanent_email' => [ 'nullable','max:120'],
            'permanent_post_office' => [ 'nullable','max:50'],
            'permanent_lan_mark' => [ 'nullable','max:120'],
            'communication_address' => ['required', 'max:500'],
            'communication_mobile_no' => ['required', 'max:25'],
            'communication_lan_line_no' => [ 'nullable','max:25'],
            'communication_email' => ['required', 'max:120'],
            'communication_post_office' => [ 'nullable', 'max:50'],
            'communication_lan_mark' => [ 'nullable','max:120'],
            'gst_no' => ['nullable', 'max:30'],
            'pan_no' => ['nullable','max:30'],
            'website' => ['nullable','max:100'],
            'country' => ['nullable','max:50'],
            'state' => ['nullable','max:50'],
            'location' => ['nullable','max:50'],
            'headding' => ['nullable','max:150'],    
            'subheading' => ['nullable','max:200'],          
            'created_by' => ['nullable','max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = Branch::select('branch_name')->where(['branch_name' => $input['branch_name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("branches", 'Exists' , '0', 'Branch Already Exists');
        } else {
            $branches = Branch::create($input);
            return $this->sendResponse("branches", new BranchResource($branches), '1', 'Branch created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Branch  $branches
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branches = Branch::find($id);

        if (is_null($branches)) {
            return $this->sendError('Branch not found.');
        }

        return $this->sendResponse("branches", new BranchResource($branches), '1', 'Branch retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Branch  $branches
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branches)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Branch  $branches
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $branches = Branch::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'branch_name' => ['required', 'max:35'],
            'code' => ['required', 'max:50'],
            'permanent_address' => ['nullable', 'max:500'],
            'permanent_mobile_no' => [ 'nullable','max:25'],
            'permanent_lan_line_no' => [ 'nullable', 'max:25'],
            'permanent_email' => [ 'nullable','max:120'],
            'permanent_post_office' => [ 'nullable','max:50'],
            'permanent_lan_mark' => [ 'nullable','max:120'],
            'communication_address' => ['required', 'max:500'],
            'communication_mobile_no' => ['required', 'max:25'],
            'communication_lan_line_no' => [ 'nullable','max:25'],
            'communication_email' => ['required', 'max:120'],
            'communication_post_office' => [ 'nullable', 'max:50'],
            'communication_lan_mark' => [ 'nullable','max:120'],
            'gst_no' => ['nullable', 'max:30'],
            'pan_no' => ['nullable','max:30'],
            'website' => ['nullable','max:100'],
            'country' => ['nullable','max:50'],
            'state' => ['nullable','max:50'],
            'location' => ['nullable','max:50'],
            'headding' => ['nullable','max:150'],    
            'subheading' => ['nullable','max:200'],   
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Branch::select('branch_name')->where(['branch_name' => $input['branch_name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("branches", 'Exists' , '0', 'Branch Already Exists');
        } else {
            $branches->branch_name = $input['branch_name'];
            $branches->code = $input['code'];
            $branches->permanent_address = $input['permanent_address'];
            $branches->permanent_mobile_no = $input['permanent_mobile_no'];
            $branches->permanent_lan_line_no = $input['permanent_lan_line_no'];
            $branches->permanent_email = $input['permanent_email'];
            $branches->permanent_post_office = $input['permanent_post_office'];
            $branches->permanent_lan_mark = $input['permanent_lan_mark'];
            $branches->communication_address = $input['communication_address'];
            $branches->communication_mobile_no = $input['communication_mobile_no'];
            $branches->communication_lan_line_no = $input['communication_lan_line_no'];
            $branches->communication_email = $input['communication_email'];
            $branches->communication_post_office = $input['communication_post_office'];
            $branches->communication_lan_mark = $input['communication_lan_mark'];
            $branches->gst_no = $input['gst_no'];
            $branches->pan_no = $input['pan_no'];
            $branches->website = $input['website'];
            $branches->country = $input['country'];
            $branches->state = $input['state'];
            $branches->location = $input['location'];
            $branches->headding = $input['headding'];
            $branches->subheading = $input['subheading'];
            $branches->updated_by = $input['updated_by'];
            $branches->save();           
            return $this->sendResponse("branches", new BranchResource($branches), '1', 'Branch Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Branch  $branches
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branches = Branch::find($id);

        if (is_null($branches)) {
            return $this->sendError('Branch not found.');
        }
        $CheckCasteExists = Enquiry::select('branch_id') -> where( 'branch_id', '=' , $id) -> get();

        if (count($CheckCasteExists)  > 0  ) {
            return $this->sendResponse("branches", 'Exists' , '0', 'Branch  is  in Use');
        }


        $branches->delete();
        return $this->sendResponse("branches", new BranchResource($branches), '1', 'Branch Deleted successfully');
        
    }
}
