<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Models\AssignTask;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\TaskChecklist;
use App\Http\Resources\TaskResources;
use App\Http\Resources\TaskCategoryResources;
use App\Http\Resources\TaskstatusResource;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskTemplateController extends BaseController
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

        $tasks = Task::all()->sortDesc();
        return $this->sendResponse("tasks", TaskResources::collection($tasks), '1', 'tasks retrieved successfully.');

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
    try {
        DB::beginTransaction();

        $input = $request->all();

        $validator = Validator::make($input, [
            'task_name' => 'required',
            'task_category_id' => 'required',
            'repeat_cycle' => 'nullable',
            'repeat_status' => 'nullable',
            'task_description' => 'nullable',
            'task_id' => 'nullable',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $taskID = DB::table('tasks')->insertGetId([
            'task_name' => $input['task_name'],
            'task_category_id' => $input['task_category_id'],
            'repeat_cycle' => $input['repeat_cycle'],
            'repeat_status' => $input['repeat_status'],
            'task_description' => $input['task_description'],
            // Add other fields from the $input array as needed
        ]);

        $checklist = $input['checklist'] ?? [];
        if (is_string($checklist)) {
            // If checklist is a string, convert it into an array
            $checklist = explode(',', $checklist);
        }

        foreach ($checklist as $item) {
            DB::table('task_checklists')->insert([
                'task_id' => $taskID,
                'checklist' => $item,
            ]);
        }
        DB::commit();


        $CheckExists = Task::select('task_name')->where(['task_name' => $input['task_name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("tasks", 'Exists', '1', 'Tasks created successfully');
        } else {
            return $this->sendResponse("tasks", $taskID, '0', 'Tasks Already Exists.');
        }

        
    } catch (\Exception $e) {
        DB::rollback();
        return $this->sendError($e->getMessage(), $errorMessages = [], $code = 404);
    }
}


    /**
     * Display the specified resource.
     *
     * @param  App\Models\Task  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasks = Task::find($id);
        $taskchecks = TaskChecklist::where('task_id', $id)->get();

        if (is_null($tasks)) {
            return $this->sendError('tasks not found.');
        }

        $responseData = [
            'tasks' => new TaskResources($tasks),
            'taskchecks' => $taskchecks,
        ];
    
        return $this->sendResponse("Tasks", $responseData, '1', 'Tasks retrieved successfully.');

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Task  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Task  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();

            $validator = Validator::make($input, [
                'task_name' => 'required',
                'task_category_id' => 'required',
                'repeat_cycle' => 'nullable',
                'repeat_status' => 'nullable',
                'task_description' => 'nullable',
                'task_id' => 'nullable',
                
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $CheckExists = Task::select('task_name')->where(['task_name' => $input['task_name']])->where('id','<>',$id)->get();
            if (count($CheckExists) > 0) {
                return $this->sendResponse("tasks", 'Exists' , '0', 'Record Already Exists');
            } else {


                DB::table('task_checklists')->where('task_id', $id)->delete();


                $checklist = $input['checklist'] ?? [];
            if (is_string($checklist)) {
                // If checklist is a string, convert it into an array
                $checklist = explode(',', $checklist);
            }
    
            foreach ($checklist as $item) {
                DB::table('task_checklists')->where('task_id', $id)->insert([
                    'task_id' => $id,
                    'checklist' => $item,
                ]);
            }

            $affected = DB::table('tasks')->where('id', $id)->update([
                'task_name' => $input['task_name'],
                'task_category_id' => $input['task_category_id'],
                'repeat_cycle' => $input['repeat_cycle'],
                'repeat_status' => $input['repeat_status'],
                'task_description' => $input['task_description'],

            ]);

            DB::commit();  
            return $this->sendResponse("updated_rows_count", $affected, '1', 'Record updated successfully.');    
            }          
        } catch (exception $e) {
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Task  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::find($id);

        if (is_null($tasks)) {
            return $this->sendError('Task not found.');
        }
        
        $CheckTaskChecklistExists = AssignTask::select('task_id') -> where('task_id', '=' , $id) -> get();

        if (count($CheckTaskChecklistExists ) > 0 ) {
            return $this->sendResponse("tasks", 'Exists' , '0', 'Task is  in Use');
        } else {

        $tasks->delete();
        return $this->sendResponse("tasks", new TaskResources($tasks), '1', 'Task Deleted successfully');
        
    }

  
}
}