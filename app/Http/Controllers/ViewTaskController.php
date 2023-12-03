<?php

namespace App\Http\Controllers;
use App\Models\AssignTask;
use App\Models\Branch;
use App\Models\ObserverOrParticipate;
use App\Models\TaskChecklist;
use App\Models\Task;
use App\Models\Staff;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewTaskController extends Controller
{
    public function taskview(Request $request)
{
    // Retrieve all assigned tasks without any filters
    $assignedTasks = AssignTask::with(['observers', 'participants'])
        ->join('tasks', 'assigntask.task_id', '=', 'tasks.id')
        ->join('staff', 'assigntask.staff_id', '=', 'staff.id')
        ->join('taskstatus', 'assigntask.completed_status', '=', 'taskstatus.id')
        ->get(['assigntask.id', 'assigntask.task_id', 'assigntask.remarks', 'tasks.task_name', 'taskstatus.taskstatus AS STATUS', 'staff.name AS StaffName', 'assigntask.link']);

    // Fetch checklist details for all task IDs in the loop
    $taskIds = $assignedTasks->pluck('task_id')->toArray();
    $checklistDetails = TaskChecklist::whereIn('task_id', $taskIds)->get();

    // Store the checklist details in an associative array with task ID as the key
    $checklistDetailsMap = [];
    foreach ($checklistDetails as $detail) {
        $checklistDetailsMap[$detail->task_id][] = $detail;
    }

    // Fetch the staff collection
    $staffCollection = Staff::all();

    // Fetch the Task Status Collection
    $taskStatuses = TaskStatus::all();

   

    // Merge the staff, task status, and branch data into a single array
    $data = [
        'branch' => Branch::select('id', 'branch_name')->get(),
        'staffs' => Staff::select('id', 'name')->get(),
        'status' => TaskStatus::select('id', 'taskstatus')->get(),
    ];

    // Pass the filtered tasks and additional data to the view
    return view('ViewTask', [
        'assignedTasks' => $assignedTasks,
        'checklistDetailsMap' => $checklistDetailsMap,
        'staffCollection' => $staffCollection,
        'Taskstatus' => $taskStatuses,
    ], $data);
}

    }