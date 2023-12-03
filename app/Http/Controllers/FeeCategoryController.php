<?php

namespace App\Http\Controllers;
use App\Models\Fee;
use Yajra\DataTables\DataTables;

use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function FeeCategory(Request $request)
{
    if ($request->ajax()) {
        $data = Fee::select('id', 'category_name', 'remark', 'isActive', 'isDefault')->get();
        
        return Datatables::of($data)
            ->addIndexColumn()
      
            
            ->addColumn('isActive', function ($row) {
                $isActiveBtn = '<label class="toggle-btn">';
                $isActiveBtn .= '<input type="checkbox" class="toggle-checkbox" data-id="' . $row["id"] . '" onclick="changestatus(this)" ' . ($row["isActive"] ? 'checked' : '') . '>';
                $isActiveBtn .= '<span class="toggle-slider"></span>';
                $isActiveBtn .= '</label>';
                return $isActiveBtn;
            })
                      
            ->addColumn('isDefault', function ($row) {
                $isDefaultBtn = '<label class="toggle-btn">';
                $isDefaultBtn .= '<input type="checkbox" class="toggle-checkbox" data-id="' . $row["id"] . '" onclick="changeDefaultStatus(this, ' . $row["id"] . ')" ' . ($row["isDefault"] ? 'checked' : '') . '>';
                $isDefaultBtn .= '<span class="toggle-slider"></span>';
                $isDefaultBtn .= '</label>';
                return $isDefaultBtn;
            })
            
         
            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="' . $row["id"] . '"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="' . $row["id"] . '"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete" value="' . $row["id"] . '"><i class="ri-delete-bin-6-line"></i></button></div>';
                return $actionBtn;
            })
            ->rawColumns(['isActive', 'isDefault', 'action'])
            ->make(true);
    }
    
    return view('fee_category');
}

   
    
}
