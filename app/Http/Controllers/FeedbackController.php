<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\EnquiryType;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function Feedback(Request $request) {

        if ($request->ajax()) {
            $data= Feedback::select( 'id','feedback')->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<div class="text-center actions text-nowrap"> <button class="view btn btn_view me-2" value="'.$row["id"].'"><i class="ri-eye-line"></i></button><button class="edit btn btn_edit me-2" value="'.$row["id"].'"><i class="ri-pencil-line"></i></button> <button class="delete btn btn_delete"value="'.$row["id"].'"><i class="ri-delete-bin-6-line"></i></button></div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $ListEnquiry['enquiry'] = EnquiryType::select('id','name')->get();


        return view('Feedback',$ListEnquiry);
    }

}
?>