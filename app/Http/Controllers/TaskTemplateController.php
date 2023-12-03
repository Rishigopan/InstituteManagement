<?php

namespace App\Http\Controllers;

use App\Models\AssignTask;
use App\Models\Task;
use App\Models\TaskCategory;
use Yajra\DataTables\DataTables;
use App\Models\TaskChecklist;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class TaskTemplateController extends Controller
{
   



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Task::join('task_categories', 'tasks.task_category_id', '=', 'task_categories.id')
                ->select('tasks.id', 'tasks.task_name', 'task_categories.name as task_category', 'tasks.task_description')
                ->get();
    
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="'.$row["id"].'"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="'.$row["id"].'"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete"value="'.$row["id"].'"><i class="ri-delete-bin-6-line"></i></button></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        $ListTaskCategory['task_categories'] = TaskCategory::select('id','name')->get();
       
        $data=array_merge($ListTaskCategory);

        return view('task_template',$data);
    }


}
