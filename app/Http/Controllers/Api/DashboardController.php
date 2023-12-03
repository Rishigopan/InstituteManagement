<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;

use App\Http\Resources\DashboardResource;
use App\Models\Branch;
use App\Models\Enquiry;
use App\Models\Admission;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branches = Branch::count();
        $enquiries = Enquiry::count();
        $admissions = Admission::count();
        $lead_data = Enquiry::sum('leaddata');
        $feedbacks = Feedback::count();
        $branch_list = Branch::all();

        $response = ['BranchCount' => $branches,
                    'EnquiryCount' => $enquiries,
                    'AdmissionCount' => $enquiries,
                    'LeadDataCount' => $lead_data,
                    'FeedbackCount' => $feedbacks,

                ];

        return $this->sendResponse("dashboard", $response , '1', 'Data Retrieved successfully');
    }

    public function admission(Request $request)
    {
        $percentage = DB::table('branches as B')
            ->leftJoin('enquiries as E', function ($join) {
                $join->on('E.branch_id', '=', 'B.id')
                    ->where('E.leaddata', '=', 1);
            })
            ->leftJoin('admissions as A', 'A.student_id', '=', 'E.id')
            ->select(
               DB::raw('COUNT(E.leaddata) as LeadData'),
                'B.id',
                'B.branch_name',
                DB::raw('COUNT(A.id) as Admission'),
                DB::raw('(SELECT COUNT(leaddata) FROM enquiries EN INNER JOIN branches BN ON EN.branch_id = BN.id WHERE EN.leaddata = 0 AND EN.branch_id = E.branch_id) AS EnquiryData'),
                DB::raw('IFNULL(ROUND(COUNT(A.id) / NULLIF(COUNT(E.id), 0) * 100, 2), 0) AS Percent')
            )
            ->groupBy('B.id')
            ->orderBy('Percent', 'desc')
            ->get();

        return $this->sendResponse("dashboard_admission", $percentage , '1', 'Data Retrieved successfully');
    }

    public function feedback(Request $request){
              
        $branchId = $request->input('branchId');


        $fieldCounts = DB::table('enquiries AS E')
            ->join('_feedback as F', 'E.feedback', '=', 'F.id')
            ->join('branches as B', 'E.branch_id', '=', 'B.id')
            ->select(DB::raw('count(*) as FeedbackCount'), 'F.feedback')
            ->where('B.id', $branchId)
            ->groupBy('E.feedback')
            ->get();
            $response = ['FeedbackCount' => $fieldCounts,
        ];

        return $this->sendResponse("dashboard_feedback", $fieldCounts , '1', 'Data Retrieved successfully');


    }
    
        



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
