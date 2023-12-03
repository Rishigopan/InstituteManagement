<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends BaseController
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

        $organizations = Organization::all()->sortDesc();
        return $this->sendResponse("organizations", OrganizationResource::collection($organizations), '1', 'Organization retrieved successfully.');

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
            'organization_name' => ['required', 'max:35'],
            'code' => ['required', 'max:50'],
            'permanent_address' => [ 'nullable','max:500'],
            'permanent_mobile_no' => [ 'nullable','max:25'],
            'permanent_lan_line_no' => [ 'nullable','max:25'],
            'permanent_email' => [ 'nullable','max:120'],
            'permanent_post_office' => [ 'nullable','max:50'],
            'permanent_lan_mark' => [ 'nullable','max:120'],
            'communication_address' => ['required', 'max:500'],
            'communication_mobile_no' => ['required', 'max:25'],
            'communication_lan_line_no' => [ 'nullable','max:25'],
            'communication_email' => ['nullable', 'max:120'],
            'communication_post_office' => [ 'nullable','max:50'],
            'communication_lan_mark' => [ 'nullable','max:120'],
            'gst_no' => ['nullable', 'max:30'],
            'pan_no' => [ 'nullable','max:30'],
            'website' => [ 'nullable','max:100'],
            'country' => [ 'nullable','max:50'],
            'state' => ['nullable', 'max:50'],
            'location' => ['nullable', 'max:50'],   
            'created_by' => ['nullable','max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = Organization::select('organization_name')->where(['organization_name' => $input['organization_name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("organizations", 'Exists' , '0', 'Organization Already Exists');
        } else {
            $organizations = Organization::create($input);
            return $this->sendResponse("organizations", new OrganizationResource($organizations), '1', 'Organization created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Organization  $organizations
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $organizations = Organization::find($id);

        if (is_null($organizations)) {
            return $this->sendError('Organization not found.');
        }

        return $this->sendResponse("organizations", new OrganizationResource($organizations), '1', 'Organization retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Organization  $organizations
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organizations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Organization  $organizations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $organizations = Organization::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'organization_name' => ['required', 'max:35'],
            'code' => ['required', 'max:50'],
            'permanent_address' => [ 'nullable','max:500'],
            'permanent_mobile_no' => [ 'nullable','max:25'],
            'permanent_lan_line_no' => [ 'nullable','max:25'],
            'permanent_email' => [ 'nullable','max:120'],
            'permanent_post_office' => [ 'nullable','max:50'],
            'permanent_lan_mark' => [ 'nullable','max:120'],
            'communication_address' => ['required', 'max:500'],
            'communication_mobile_no' => ['required', 'max:25'],
            'communication_lan_line_no' => [ 'nullable','max:25'],
            'communication_email' => ['nullable', 'max:120'],
            'communication_post_office' => [ 'nullable','max:50'],
            'communication_lan_mark' => [ 'nullable','max:120'],
            'gst_no' => ['nullable', 'max:30'],
            'pan_no' => [ 'nullable','max:30'],
            'website' => [ 'nullable','max:100'],
            'country' => [ 'nullable','max:50'],
            'state' => ['nullable', 'max:50'],
            'location' => ['nullable', 'max:50'],   
            
            'updated_by' => ['nullable','max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Organization::select('organization_name')->where(['organization_name' => $input['organization_name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("organizations", 'Exists' , '0', 'Organization Already Exists');
        } else {
            $organizations->organization_name = $input['organization_name'];
            $organizations->code = $input['code'];
            $organizations->permanent_address = $input['permanent_address'];
            $organizations->permanent_mobile_no = $input['permanent_mobile_no'];
            $organizations->permanent_lan_line_no = $input['permanent_lan_line_no'];
            $organizations->permanent_email = $input['permanent_email'];
            $organizations->permanent_post_office = $input['permanent_post_office'];
            $organizations->permanent_lan_mark = $input['permanent_lan_mark'];
            $organizations->communication_address = $input['communication_address'];
            $organizations->communication_mobile_no = $input['communication_mobile_no'];
            $organizations->communication_lan_line_no = $input['communication_lan_line_no'];
            $organizations->communication_email = $input['communication_email'];
            $organizations->communication_post_office = $input['communication_post_office'];
            $organizations->communication_lan_mark = $input['communication_lan_mark'];
            $organizations->gst_no = $input['gst_no'];
            $organizations->pan_no = $input['pan_no'];
            $organizations->website = $input['website'];
            $organizations->country = $input['country'];
            $organizations->state = $input['state'];
            $organizations->location = $input['location'];
            $organizations->updated_by = $input['updated_by'];
            $organizations->save();           
            return $this->sendResponse("organizations", new OrganizationResource($organizations), '1', 'Organization Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Organization  $organizations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizations = Organization::find($id);

        if (is_null($organizations)) {
            return $this->sendError('Organization not found.');
        }

        $organizations->delete();
        return $this->sendResponse("organizations", new OrganizationResource($organizations), '1', 'Organization Deleted successfully');
        
    }
}
