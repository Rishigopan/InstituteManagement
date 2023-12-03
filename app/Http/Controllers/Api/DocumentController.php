<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\DocumentResource;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DocumentController extends BaseController
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

        $documents = Document::all()->sortDesc();
        return $this->sendResponse("documents", DocumentResource::collection($documents), '1', 'Documents retrieved successfully.');

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
        $CheckExists = Document::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("documents", 'Exists' , '0', 'Documents Already Exists');
        } else {
            $documents = Document::create($input);
            return $this->sendResponse("documents", new DocumentResource($documents), '1', 'Documents created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documents = Document::find($id);

        if (is_null($documents)) {
            return $this->sendError('Documents not found.');
        }

        return $this->sendResponse("documents", new DocumentResource($documents), '1', 'Documents retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $documents)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $documents = Document::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = Document::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("documents", 'Exists' , '0', 'Documents Already Exists');
        } else {
            $documents->name = $input['name'];
            $documents->remarks = $input['remarks'];
            $documents->updated_by = $input['updated_by'];
            $documents->save();           
            return $this->sendResponse("documents", new DocumentResource($documents), '1', 'Documents Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Document  $documents
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documents = Document::find($id);

        if (is_null($documents)) {
            return $this->sendError('Documents not found.');
        }
       
        $documents->delete();
        return $this->sendResponse("documents", new DocumentResource($documents), '1', 'Documents Deleted successfully');
        
    }
}
