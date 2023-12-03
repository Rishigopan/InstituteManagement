<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\AssignTask;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Task;
use App\Models\TaskChecklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\AssignTaskResource;
use Illuminate\Support\Facades\DB;

class AddTaskController extends BaseController
{

    public function getGroupMembers($groupId)
    {
        $group = Group::findOrFail($groupId);
        $memberIds = explode(',', $group->members); // Convert comma-separated string to an array of member IDs
        $members = Staff::whereIn('id', $memberIds)->get();
        return response()->json(['members' => $members]);
    }

    public function getChecklist($taskId)
    {
        $checklist = TaskChecklist::where('task_id', $taskId)->get();

        return response()->json(['checklist' => $checklist]);
    }


    public function submitForm(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'branch_id' => 'required',
            'staff_id' => 'required',
            'date' => 'required',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }


        $participantsArray = explode(',', $request->participants);
            $ObserversArray = explode(',', $request->observers); 

        $Tasks = $request->task;
        $TaskArray = json_decode($Tasks);

        foreach ($TaskArray as $TaskArrayItems) {
            $IndividualTasks = $TaskArrayItems;

            

            $task = DB::table('assigntask')->insertGetId([
                'task_id' => $IndividualTasks->taskId,
                'branch_id' => $request->branch_id,
                'staff_id' => $request->staff_id,
                'date' => $request->date,
                'starttime' => $IndividualTasks->startTime,
                'endtime' => $IndividualTasks->endTime,
                'link' => $request->link,
                'remarks' =>$IndividualTasks->Remarks
            ]);

            
    
    
            foreach ($ObserversArray as $observer) {
                $observerId = $observer;
                DB::table('observerorparticipate')->insert([
                    'assigntask_id' => $task,
                    'type' => 'observer',
                    'observer_id' => $observerId,
                    'participate_id' => null,
                ]);
            }
    
    
            foreach ($participantsArray as $participant) {
                $participantId = $participant;
                DB::table('observerorparticipate')->insert([
                    'assigntask_id' => $task,
                    'type' => 'participant',
                    'observer_id' => null,
                    'participate_id' => $participantId,
                ]);
            }
    
        }


       

        return $this->sendResponse("assignTask", $task, '1', 'Task Assigned successfully');
    }
    public function getPendingWorkDetails($id)
    {
        // Retrieve the staff's pending work details where completed_status is 1
        $pendingTasks = AssignTask::join('tasks', 'assigntask.task_id', '=', 'tasks.id')->where('staff_id', $id)
            ->where('completed_status', 1)
            ->get();
    
        // Return the pending work details as a JSON response
        return response()->json($pendingTasks);
    }

}
