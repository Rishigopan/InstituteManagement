<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Task;
use App\Http\Resources\TaskCategoryResources;
use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskCategoryController extends BaseController
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

        $taskcategories = TaskCategory::all()->sortDesc();
        return $this->sendResponse("taskcategories", TaskCategoryResources::collection($taskcategories), '1', 'Task Category retrieved successfully.');

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
        $CheckExists = TaskCategory::select('name')->where(['name' => $input['name']])->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("taskcategories", 'Exists' , '0', 'Task Category  Already Exists');
        } else {
            $taskcategories = TaskCategory::create($input);
            return $this->sendResponse("taskcategories", new TaskCategoryResources($taskcategories), '1', 'Task Category  created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\TaskCategory  $taskcategories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $taskcategories = TaskCategory::find($id);

        if (is_null($taskcategories)) {
            return $this->sendError('Task Category  not found.');
        }

        return $this->sendResponse("taskcategories", new TaskCategoryResources($taskcategories), '1', 'Task Category  retrieved successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\TaskCategory  $taskcategories
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskCategory $taskcategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\TaskCategory  $taskcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $taskcategories = TaskCategory::find($id);

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'max:25'],
            'remarks' => ['max:250'],
            'updated_by' => ['max:10'],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
 
        }
        $CheckExists = TaskCategory::select('name')->where(['name' => $input['name']])->where('id','<>',$id)->get();
        if (count($CheckExists) > 0) {
            return $this->sendResponse("taskcategories", 'Exists' , '0', 'Task Category  Already Exists');
        } else {
            $taskcategories->name = $input['name'];
            $taskcategories->remarks = $input['remarks'];
            $taskcategories->updated_by = $input['updated_by'];
            $taskcategories->save();           
            return $this->sendResponse("taskcategories", new TaskCategoryResources($taskcategories), '1', 'Task Category  Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\TaskCategory  $taskcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taskcategories = TaskCategory::find($id);

        if (is_null($taskcategories)) {
            return $this->sendError('Task Category  not found.');
        }
        $CheckTaskcategoryExists = Task::select('task_category_id') -> where( 'task_category_id', '=' , $id) -> get();
       
        if (count($CheckTaskcategoryExists) > 0) {
            return $this->sendResponse("taskcategories", 'Exists' , '0', 'Task Category is  in Use');
        } else {

            $taskcategories->delete();
            return $this->sendResponse("taskcategories", new TaskCategoryResources($taskcategories), '1', 'Task Category  Deleted successfully');
        
        }
    }

}