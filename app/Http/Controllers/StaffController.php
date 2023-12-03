<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Department;
use Yajra\DataTables\DataTables;
class StaffController extends Controller
{
    public function Staff(Request $request) {

        if ($request->ajax()) {
            $data = Staff::select( 'staff.id','staff.name','staff.remarks','staff.email','staff.mobile_no')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
            $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="'.$row["id"].'"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="'.$row["id"].'"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete"value="'.$row["id"].'"><i class="ri-delete-bin-6-line"></i></button></div>';
            return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $ListDepartment['department'] = Department::select('id','name')->get();
        $ListBranch['branch'] = Branch::select('id','branch_name')->get();
        return view('StaffMaster',$ListDepartment,$ListBranch);      
        
    }
    }
    ?>