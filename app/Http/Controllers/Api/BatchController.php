<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\BatchResource;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BatchController extends BaseController
{
    /* Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {


        $batches = Batch::all()->sortDesc();
        return $this->sendResponse("batches", BatchResource::collection($batches), '1', 'Batch retrieved successfully.');
    }





    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'branch_id' => ['required', 'max:25'],
            'academic_year' => ['max:250'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        } else {
            DB::table('session')->insertGetId([
                'sessionFrom' => $input['sessionFrom'],
                'sessionTo' => $input['sessionTo'],
                'batch_id' => $input['batch-id'],
            ]);
        }
    }



    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [

            'branch_id' => ['required', 'max:25'],
            'academic_year' => ['max:250'],
            'created_by' => ['max:10'],
        ]);
        $batches = $request->all();

        $BatchInput = Batch::create($batches);


        $SessionFromArray = explode(",", $request->sessionDetails);
        foreach ($SessionFromArray as $SessionFromArrayElements) {
            $SessionFromArrayElementsDates = explode("-", $SessionFromArrayElements);
            DB::table('session')->insertGetId([
                'sessionFrom' => $SessionFromArrayElementsDates[0],
                'sessionTo' => $SessionFromArrayElementsDates[1],
                'batch_id' => $BatchInput->id,
            ]);
        }
        return $this->sendResponse("batches", new BatchResource($BatchInput), '1', 'batches Store sucessfully');
    }

    public function update(Request $request, $id)
    {
        $batches = Batch::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'branch_id' => ['required', 'max:25'],
            'academic_year' => ['max:250'],
            'created_by' => ['max:10'],
        ]);
        DB::table('course_requirmenttable')->where('course_id',$id)->delete();
        $affected = DB::table('batches')->where('id', $id)->update([
            'branch_id' => $input['branch_id'],
            'academic_year' => $input['academic_year'],
            'course_name' => $input['course_name'],
            'course_provider_id' => $input['course_provider_id'],
            'batch_name' => $input['batch_name'],
            'batch_no' => $input['batch_no'],
            'batch_type_id' => $input['batch_type_id'],
            'seat' => $input['seat'],
            'duration' => $input['duration'],
            'period' => $input['period'],
            'session' => $input['session'],
            'startdate' => $input['startdate'],

        ]);
        $batches = $request->all();

        $BatchInput = Batch::create($batches);
        $SessionFromArray = explode(",", $request->sessionDetails);
        foreach ($SessionFromArray as $SessionFromArrayElements) {
            $SessionFromArrayElementsDates = explode("-", $SessionFromArrayElements);
            DB::table('session')->insertGetId([
                'sessionFrom' => $SessionFromArrayElementsDates[0],
                'sessionTo' => $SessionFromArrayElementsDates[1],
                'batch_id' => $BatchInput->id,
            ]);
        }

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
         else {
                   
            return $this->sendResponse("batches", new BatchResource($batches), '1', 'batch Updated successfully');
        }
    
    }





    public function destroy($id)
    {
        $batches = Batch::find($id);

        if (is_null($batches)) {
            return $this->sendError('batch not found.');
        }

        $batches->delete();
        return $this->sendResponse("batches", new BatchResource($batches), '1', 'Batch Deleted successfully');
        
    }
}
