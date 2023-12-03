<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\BaseController;
use App\Models\Branch;
use App\Models\EnquiryType;
use App\Models\Staff;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\AssignTask;
use App\Models\TaskCategory;
use App\Models\TaskChecklist;

use App\Models\ObserverOrParticipate;

use Illuminate\Http\Request;

class ReportController extends BaseController
{

    public function gettaskreport(Request $request)
    {
        $Branch = $request['Branch'];
        $Staff = $request['Staff'];
        $Date = $request['Date'];
        $Task = $request['Task'];
        $Status = $request['Status'];

        $TaskReportQuery = AssignTask::select(
            'assigntask.id',
            'tasks.task_name As TaskName',
            'task_categories.name AS TaskCategoryName',
            'assigned_staff.name AS StaffName',
            'assigntask.date',
            'observer.name AS ObserversName',
            'participant.name AS ParticipantName',
            'Status.taskstatus'
        )
            ->leftJoin('tasks', 'assigntask.task_id', '=', 'tasks.id')
            ->leftJoin('task_categories', 'tasks.task_category_id', '=', 'task_categories.id')
            ->leftJoin('taskstatus As Status', 'assigntask.completed_status', '=', 'Status.id')
            ->leftJoin('staff AS assigned_staff', 'assigntask.staff_id', '=', 'assigned_staff.id')
            ->leftJoin('observerorparticipate', 'assigntask.id', '=', 'observerorparticipate.assigntask_id')
            ->leftJoin('staff AS observer', 'observerorparticipate.observer_id', '=', 'observer.id')
            ->leftJoin('staff AS participant', 'observerorparticipate.participate_id', '=', 'participant.id');

        if ($Branch) {
            $TaskReportQuery->where('assigntask.branch_id', $Branch);
        }
        if ($Staff) {
            $TaskReportQuery->where('assigntask.staff_id', $Staff);
        }
        if ($Date) {
            $TaskReportQuery->where('assigntask.date', '=', $Date);
        }
        if ($Task) {
            $TaskReportQuery->where('assigntask.task_id', '=', $Task);
        }
        if ($Status) {
            $TaskReportQuery->where('assigntask.completed_status', '=', $Status);
        }

        $TaskReports = $TaskReportQuery->get();

        $taskReportsFormatted = [];
        
        foreach ($TaskReports as $taskReport) {
            $taskId = $taskReport->id;
        
            // Check if the task ID is already present in the formatted array
            if (!isset($taskReportsFormatted[$taskId])) {
                $taskReportsFormatted[$taskId] = [
                    'id' => $taskId,
                    'TaskName' => $taskReport->TaskName,
                    'TaskCategoryName' => $taskReport->TaskCategoryName,
                    'StaffName' => $taskReport->StaffName,
                    'date' => $taskReport->date,
                    'taskstatus' => $taskReport->taskstatus,

                    'ObserversName' => '',
                    'ParticipantName' => '',
                ];
            }
        
            // Concatenate the observer and participant names
            if ($taskReport->ObserversName) {
                $taskReportsFormatted[$taskId]['ObserversName'] .= ($taskReportsFormatted[$taskId]['ObserversName'] ? ', ' : '') . $taskReport->ObserversName;
            }
        
            if ($taskReport->ParticipantName) {
                $taskReportsFormatted[$taskId]['ParticipantName'] .= ($taskReportsFormatted[$taskId]['ParticipantName'] ? ', ' : '') . $taskReport->ParticipantName;
            }
        }
        
        $response = [
            'TaskReports' => array_values($taskReportsFormatted) // Get only the values of the formatted array
        ];
        
        return $this->sendResponse("TaskReports", $response, '1', 'Task Reports retrieved successfully.');
    }        

     //Op Wise Consultation
     public function getchecklist($id)
     {
         $Checklists = TaskChecklist::where('task_id', $id)->
                                         select('id', 'checklist') 
                                         ->get();
         return response()->json($Checklists);
     }
}
