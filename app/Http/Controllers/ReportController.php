<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\EnquiryType;
use App\Models\Staff;
use App\Models\Task;
use App\Models\TaskStatus;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function followupreport(Request $request) {

        $ListBranch['branches'] = Branch::select('id', 'branch_name')->get();
        $ListBranch['enquirySource'] = EnquiryType::select('id', 'name')->get();

        return view('FollowUpReport', $ListBranch,$ListBranch);
    }

    public function taskreports(Request $request) {

        $ListBranch['branch']=Branch::select('id','branch_name')->get();
        $ListStaff['staffs']=Staff::select('id','name')->get();
        $ListTask['Task']=Task::select('id','task_name')->get();
        $ListTaskStatus['Taskstatus']=TaskStatus::select('id','taskstatus')->get();

        $data = array_merge($ListBranch,$ListStaff,$ListTask,$ListTaskStatus);

        return view('TaskReport', $data);
    }
}
