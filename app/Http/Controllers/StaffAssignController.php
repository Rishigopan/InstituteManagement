<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\Branch;
use Yajra\DataTables\DataTables;

class StaffAssignController extends Controller
{
    
    public function StaffAssign(Request $request) {

        if ($request->ajax()) {
            $data= Enquiry::select('enquiries.id','enquiries.name','enquiries.mob_no','enquiries.Course','enquiries.remarks' )
                            
                            ->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="'.$row["id"].'"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="'.$row["id"].'"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete"value="'.$row["id"].'"><i class="ri-delete-bin-6-line"></i></button></div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        $ListStaff['staffs'] = Staff::select('id','name')->get();
        $ListBranch['branch'] = Branch::select('id','branch_name')->get();
        $data=array_merge($ListStaff,$ListBranch);
        $TotalEnquiries=Enquiry::count();
       
        $branches = Branch::all();
     return view('StaffAssign',$data,compact('TotalEnquiries'));
    }
    public function getstaffs($branches)
{
    $staff = Staff::where('branch_id', $branches)->get();
    return response()->json($staff);
}
}
