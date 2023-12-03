<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Group;
use App\Models\Staff;
use App\Models\Task;
use Illuminate\Http\Request;

class AddTaskController extends Controller
{
    
    public function AddTask(Request $request) {

        $ListBranch['branch']=Branch::select('id','branch_name')->get();
        $ListStaff['staffs']=Staff::select('id','name')->get();
        $ListObserverandParicipants['ObserverParticipant']=Group::select('id','name','branch_id','members')->get();
        $ListTask['Task']=Task::select('id','task_name')->get();
        $data=array_merge($ListBranch,$ListStaff,$ListObserverandParicipants,$ListTask);
        return view('AssignTask',$data);

    }
}
