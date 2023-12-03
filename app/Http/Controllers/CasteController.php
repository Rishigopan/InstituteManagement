<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caste;
use App\Models\Religion;
use App\Models\CasteCategory;

use Yajra\DataTables\DataTables;
class CasteController extends Controller
{
    public function Caste(Request $request) {
        
        if ($request->ajax()) {
            $data= Caste::select( 'castes.id','castes.name','religions.name AS relname','caste_categories.name AS castname','castes.remarks' )->join('religions', 'castes.religion_id', '=', 'religions.id')->join('caste_categories','castes.caste_category_id','=','caste_categories.id')->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="'.$row["id"].'"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="'.$row["id"].'"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete"value="'.$row["id"].'"><i class="ri-delete-bin-6-line"></i></button></div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $ListReligions['religion'] = Religion::select('id','name')->get();
        $ListCasteCat['caste'] = CasteCategory::select('id','name')->get();


        return view('CasteMaster',$ListReligions,$ListCasteCat );
    }
   
}
?>