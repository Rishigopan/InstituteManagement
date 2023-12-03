<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\TaskstatusResource;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskStatusController extends BaseController
{
    public function index()
    {
        


        $taskStatus = TaskStatus::all()->sortDesc();
        return $this->sendResponse("taskStatus", TaskstatusResource::collection($taskStatus), '1', 'Task Status retrieved successfully.');

    }
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
            'taskstatus' => ['required'],
            'created_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }
        $CheckExists = TaskStatus::select('taskstatus')->where(['taskstatus' => $input['taskstatus']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("taskstatus", 'Exists' , '0', 'Task Status Already Exists');
        } else {
            $taskStatus = TaskStatus::create($input);
            return $this->sendResponse("taskStatus", new TaskstatusResource($taskStatus), '1', 'Task Status added successfully');
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
        $taskStatus = TaskStatus::find($id);

        if (is_null($taskStatus)) {
            return $this->sendError('Task Status not found.');
        }

        return $this->sendResponse("taskStatus", new TaskstatusResource($taskStatus), '1', 'Task Status retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\TaskStatus  $year
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\TaskStatus  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taskStatus = TaskStatus::find($id);
        if ($taskStatus->is_deletable === 'NO') {
            return $this->sendResponse("taskStatus", new TaskstatusResource($taskStatus), '2', 'This Task Status Cannot update');
        }
        $input = $request->all();

        $validator = Validator::make($input, [
            'taskstatus' => ['required'],
            
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = TaskStatus::select('taskstatus')->where(['taskstatus' => $input['taskstatus']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("taskStatus", 'Exists' , '0', 'Task Status Already Exists');
        } else {
            $taskStatus->taskstatus = $input['taskstatus'];
            $taskStatus->save();           
            return $this->sendResponse("taskStatus", new TaskstatusResource($taskStatus), '1', 'Task Status Updated successfully');
        }
    }
    public function destroy($id)
    {
        $taskStatus = TaskStatus::find($id);
        if ($taskStatus->is_deletable === 'NO') {
            return $this->sendResponse("taskStatus", new TaskstatusResource($taskStatus), '2', 'This Task Status Cannot delete');
        }

        if (is_null($taskStatus)) {
            return $this->sendError('Task Status not found.');
        }
      

        $taskStatus->delete();
        return $this->sendResponse("year", new TaskstatusResource($taskStatus), '1', 'Task Status Deleted successfully');
        
    }
  

}
