<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Models\CourseProvider;
use App\Http\Resources\CourseProviderResource ;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\BaseController;
use App\Models\Course;

class CourseProviderController extends BaseController
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

        $CourseProvider = CourseProvider::all()->sortDesc();
        return $this->sendResponse("CourseProvider", CourseProviderResource::collection($CourseProvider), '1', 'Course Category retrieved successfully.');

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
            'provider_name' => ['required', 'max:25'],
            'id_card_prefix' => ['nullable','max:250'],
            'code' => ['nullable','max:50'],
            'permanent_address' => ['nullable', 'max:25'],
            'permanent_mobile_no' => ['nullable', 'max:25'],
            'permanent_lan_line_no' => ['nullable', 'max:25'],
            'permanent_email' => ['nullable', 'max:25'],
            'permanent_post_office' => ['nullable', 'max:25'],
            'permanent_lan_mark' => ['nullable', 'max:25'],
            'communication_address' => ['required', 'max:25'],
            'communication_mobile_no' => ['required', 'max:15'],
            'communication_lan_line_no' => ['nullable','max:25'],
            'communication_email' => ['nullable','max:25'],
            'communication_post_office' => ['nullable','max:25'],
            'communication_lan_mark' => ['nullable','max:25'],
            'gst_no' => ['nullable', 'max:25'],
            'pan_no' => ['nullable', 'max:25'],
            'website' => ['nullable', 'max:25'],
            'country' => ['nullable','max:25'],
            'state' => [ 'nullable','max:25'],
            'location' => ['nullable', 'max:25'],
            'created_by' => ['max:10'],

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = CourseProvider::select('provider_name')->where(['provider_name' => $input['provider_name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("CourseProvider", 'Exists' , '0', 'Course Category Already Exists');
        } else {
            $CourseProvider = CourseProvider::create($input);
            return $this->sendResponse("CourseProvider", new CourseProviderResource($CourseProvider), '1', 'Course Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\CourseProvider  $CourseProvider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $CourseProvider = CourseProvider::find($id);

        if (is_null($CourseProvider)) {
            return $this->sendError('Course provider not found.');
        }

        return $this->sendResponse("CourseProvider", new CourseProviderResource($CourseProvider), '1', 'Course Category retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\CourseProvider  $CourseProvider
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseProvider $CourseProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\CourseProvider  $CourseProvider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $CourseProvider = CourseProvider::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'provider_name' => ['required', 'max:25'],
            'id_card_prefix' => ['nullable','max:250'],
            'code' => ['nullable','max:50'],
            'permanent_address' => ['nullable', 'max:25'],
            'permanent_mobile_no' => ['nullable', 'max:25'],
            'permanent_lan_line_no' => ['nullable', 'max:25'],
            'permanent_email' => ['nullable', 'max:25'],
            'permanent_post_office' => ['nullable', 'max:25'],
            'permanent_lan_mark' => ['nullable', 'max:25'],
            'communication_address' => ['required', 'max:25'],
            'communication_mobile_no' => ['required', 'max:15'],
            'communication_lan_line_no' => ['nullable','max:25'],
            'communication_email' => ['nullable','max:25'],
            'communication_post_office' => ['nullable','max:25'],
            'communication_lan_mark' => ['nullable','max:25'],
            'gst_no' => ['nullable', 'max:25'],
            'pan_no' => ['nullable', 'max:25'],
            'website' => ['nullable', 'max:25'],
            'country' => ['nullable','max:25'],
            'state' => [ 'nullable','max:25'],
            'location' => ['nullable', 'max:25'],
           
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = CourseProvider::select('provider_name')->where(['provider_name' => $input['provider_name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("CourseProvider", 'Exists' , '0', 'Course Category Already Exists');
        } else {
            $CourseProvider->provider_name = $input['provider_name'];
            $CourseProvider->id_card_prefix = $input['id_card_prefix'];
            $CourseProvider->code = $input['code'];
            $CourseProvider->permanent_address = $input['permanent_address'];
            $CourseProvider->permanent_mobile_no = $input['permanent_mobile_no'];
            $CourseProvider->permanent_lan_line_no = $input['permanent_lan_line_no'];
            $CourseProvider->permanent_email = $input['permanent_email'];
            $CourseProvider->permanent_post_office = $input['permanent_post_office'];
            $CourseProvider->permanent_lan_mark= $input['permanent_lan_mark'];
            $CourseProvider->communication_address = $input['communication_address'];
            $CourseProvider->communication_mobile_no = $input['communication_mobile_no'];
            $CourseProvider->communication_lan_line_no = $input['communication_lan_line_no'];
            $CourseProvider->communication_email = $input['communication_email'];
            $CourseProvider->communication_post_office = $input['communication_post_office'];
            $CourseProvider->communication_lan_mark = $input['communication_lan_mark'];
            $CourseProvider->gst_no = $input['gst_no'];
            $CourseProvider->pan_no = $input['pan_no'];
            $CourseProvider->website = $input['website'];
            $CourseProvider->country = $input['country'];
            $CourseProvider->state = $input['state'];
            $CourseProvider->location = $input['location'];
            
            $CourseProvider->save();           
            return $this->sendResponse("CourseProvider", new CourseProviderResource($CourseProvider), '1', 'Course Category Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\CourseProvider  $CourseProvider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $CourseProvider = CourseProvider::find($id);

        if (is_null($CourseProvider)) {
            return $this->sendError('Course Provider not found.');
        }
        $CheckCourseProExists = Course::select('course_provider_id') -> where( 'course_provider_id', '=' , $id) -> get();
        //  $CheckCourseExists = Course::select('course_type_id') -> where( 'course_type_id', '=' , $id) -> get();

        if (count($CheckCourseProExists)  > 0  ) {
            return $this->sendResponse("CourseProvider", 'Exists' , '0', ' CourseProvider is  in Use');
        } else {


        $CourseProvider->delete();
        return $this->sendResponse("CourseProvider", new CourseProviderResource($CourseProvider), '1', 'Course Provider Deleted successfully');
        
    }

}
}
?>