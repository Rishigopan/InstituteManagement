<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\StreamResource;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class StreamController extends BaseController
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

        $streams = Stream::all()->sortDesc();
        return $this->sendResponse("streams", StreamResource::collection($streams), '1', 'Stream retrieved successfully.');

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
            'qualification_id' =>  ['required', 'max:25'],
            'stream' => ['required','max:250'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
         else {
            $streams = Stream::create($input);
            return $this->sendResponse("streams", new StreamResource($streams), '1', 'Stream created successfully');
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
        $streams = Stream::find($id);

        if (is_null($streams)) {
            return $this->sendError('Stream not found.');
        }

        return $this->sendResponse("streams", new StreamResource($streams), '1', 'Stream retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Stream  $relations
     * @return \Illuminate\Http\Response
     */
    public function edit(Stream $relations)
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
        $streams = Stream::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'qualification_id' => ['required', 'max:25'],
            'stream' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
         else {
            $streams->qualification_id = $input['qualification_id'];
            $streams->stream = $input['stream'];
            $streams->updated_by = $input['updated_by'];
            $streams->save();           
            return $this->sendResponse("streams", new StreamResource($streams), '1', 'Stream Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Stream  $relations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $streams = Stream::find($id);

        if (is_null($streams)) {
            return $this->sendError('Stream not found.');
        }

        $streams->delete();
        return $this->sendResponse("streams", new StreamResource($streams), '1', 'Stream Deleted successfully');
        
    }
}
