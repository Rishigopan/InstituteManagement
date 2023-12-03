<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\StaffResource;
use App\Models\AssignTask;
use App\Models\ObserverOrParticipate;
use App\Models\TaskChecklist;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StartTaskController extends BaseController
{
    public function storeStartTime(Request $request)
    {
        $taskId = $request->id;
        $startTime = $request->input('task_start_time');

        $CompletedStatus = 3;
        $assignedTask = AssignTask::where('id', $taskId)->first();

        if ($assignedTask) {
            $assignedTask->task_start_time = $startTime;
            $assignedTask->completed_status = $CompletedStatus;
            $assignedTask->save();

            return response()->json(['message' => 'Start time stored successfully'], 200);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    public function storeEndTime(Request $request)
    {
        $taskId = $request->id;

        $endTime = $request->input('task_end_time');
        $CompletedStatus = 1;
        $assignedTask = AssignTask::where('id', $taskId)->first();

        if ($assignedTask) {

            $assignedTask->task_end_time = $endTime;
            $assignedTask->completed_status = $CompletedStatus;
            $assignedTask->save();

            return response()->json(['message' => 'End time stored successfully'], 200);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }
    public function storeStatus(Request $request)
    {
        $taskId = $request->id;
        $status = $request->completed_status;
        $assignedTask = AssignTask::where('id', $taskId)->first();

        if ($assignedTask) {
            $assignedTask->completed_status = $status;
            $assignedTask->save();

            return response()->json(['message' => 'Status stored successfully'], 200);
        } else {
            return response()->json(['message' => 'Task not found'], 404);
        }
    }

    // public function filterTasks(Request $request)
    // {

    //     // Retrieve all assigned tasks without any filters
    //     $assignedTasks = AssignTask::select('assigntask.id', 'assigntask.task_id', 'assigntask.remarks', 'tasks.task_name', 'taskstatus.taskstatus AS STATUS', 'staff.name AS StaffName', 'assigntask.link')->with(['observers', 'participants'])
    //         ->join('tasks', 'assigntask.task_id', '=', 'tasks.id')
    //         ->join('staff', 'assigntask.staff_id', '=', 'staff.id')
    //         ->join('taskstatus', 'assigntask.completed_status', '=', 'taskstatus.id');


    //     // Fetch checklist details for all task IDs in the loop
    //     $taskIds = $assignedTasks->pluck('task_id')->toArray();
    //     $checklistDetails = TaskChecklist::whereIn('task_id', $taskIds)->get();

    //     // Store the checklist details in an associative array with task ID as the key
    //     $checklistDetailsMap = [];
    //     foreach ($checklistDetails as $detail) {
    //         $checklistDetailsMap[$detail->task_id][] = $detail;
    //     }
    //     // Retrieve the selected branch and staff from the request

    //     // Apply filters
    //     if ($request->has('Status')) {
    //         $CompletedStatus = $request->input('Status');
    //         $assignedTasks->where('assigntask.completed_status', '=', $CompletedStatus);
    //     }

    //     if ($request->has('staff')) {
    //         $staffId = $request->input('staff');
    //         $assignedTasks->where('assigntask.staff_id', '=', $staffId);
    //     }


    //     // Retrieve the filtered assigned tasks
    //     $filteredTasks = $assignedTasks->get();

    //     // Prepare the data array to be sent as the JSON response
    //     $data = [
    //         'assignedTasks' => $filteredTasks,
    //         'checklistDetailsMap' => $checklistDetailsMap,
    //     ];

    //     return response()->json($data);
    // }


    public function filterTasks(Request $request)
    {

        $selectedStaff = $request->input('staffId');
        $selectedStatus = $request->input('statusId');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $assignedTasks = AssignTask::select(
            'assigntask.id',
            'assigntask.task_id',
            'assigntask.remarks',
            'staff.name AS StaffName',
            'tasks.task_name',
            'taskstatus.taskstatus AS STATUS',
            'assigntask.link',
            'assigntask.task_start_time',
            'assigntask.task_end_time',
            'assigntask.endtime',
            'assigntask.starttime',
            'assigntask.completed_status'
        )

        ->with(['observerStaff', 'participantStaff', 'task.checklists'])
        ->join('tasks', 'assigntask.task_id', '=', 'tasks.id')
        ->join('staff', 'assigntask.staff_id', '=', 'staff.id')
        ->join('taskstatus', 'assigntask.completed_status', '=', 'taskstatus.id');
       

        if ($selectedStaff != 0) {
            $assignedTasks->where('assigntask.staff_id', '=', $selectedStaff);
        }
        
        if ($selectedStatus != 0) {
            $assignedTasks->where('assigntask.completed_status', '=', $selectedStatus);
        }
        
        if ($request->has('from_date')) { 
            $assignedTasks->where('assigntask.starttime', '>=', Carbon::parse($fromDate)->toDateTimeString());
        }
        
        if ($request->has('to_date')) { 
            $assignedTasks->where('assigntask.endtime', '<=', Carbon::parse($toDate)->toDateTimeString());
        }
        

        $filteredTasks = $assignedTasks->get();
        return response()->json($filteredTasks);
    }
}
