<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Staff;
use Yajra\DataTables\DataTables;
class GroupController extends Controller
{
    public function groups(Request $request) {
        if ($request->ajax()) {
          
            $FinalDataArray = array();
            $FindData = Group::select('groups.id', 'groups.name', 'groups.members', 'branches.branch_name as branchName')
            ->join('branches','groups.branch_id','branches.id')->get();
            foreach($FindData as $FindDatas){
    
                $StaffName = '';
                $StaffId = explode(',', $FindDatas['members']);
                foreach($StaffId as $StaffIds){
                    $FindStaff = Staff::select('name')->where('id', '=', $StaffIds)->first();
                    if ($FindStaff) {
                        $StaffName .= $FindStaff->name;
                        $StaffName .= ' , ';
                    }
                }
    
                $StaffName = rtrim($StaffName, ' + ');
    
                $DataArray = [
                    'id' => $FindDatas['id'],
                    'name' => $FindDatas['name'],
                    'members' => $StaffName,
                    'branchName' => $FindDatas['branchName'], 
                ];
                array_push($FinalDataArray, $DataArray);
            }

            return Datatables::of($FinalDataArray)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="'.$row["id"].'"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="'.$row["id"].'"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete"value="'.$row["id"].'"><i class="ri-delete-bin-6-line"></i></button></div>';
                return $actionBtn; 
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $ListStaff['staffs'] = Staff::select('id','name')->get();
        $ListBranch['branch'] = Branch::select('id','branch_name')->get();
        
        return view('GroupMaster', $ListStaff, $ListBranch);    
    }

}
