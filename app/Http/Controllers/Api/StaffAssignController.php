<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class StaffAssignController extends BaseController
{
    /* *
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Search(Request $Request)
    {


        $TotalEnquiries = Enquiry::whereNotIn('feedback', [1,2])->count();
        $UnAssignedEnquiries = Enquiry::where('Assignedto', '=', '0')->whereNotIn('feedback', [1,2])->count();
        $AssignedEnquiries = Enquiry::where('Assignedto','<>', '0')->whereNotIn('feedback', [1,2])->count();


        $Page = $Request->input('Page', 1);
        $PerPage = $Request->input('PerPage', 10);
        $DataType = $Request->input('DataType');
        $DataSource = $Request->input('DataSource');
        $Branch = $Request->input('Branch');
        $Staff = $Request->input('Staff');


        $SearchQuery = "SELECT E.id,E.name,E.mob_no,C.course_name AS Course,E.leaddata,ET.name AS Source,B.branch_name AS Branch FROM enquiries E LEFT JOIN courses C ON E.course_id = C.id LEFT JOIN branches B ON E.branch_id = B.id LEFT JOIN enquiry_types ET ON E.enq_source = ET.id WHERE Assignedto = 0 AND feedback NOT IN (1,2)";

        $CountQuery = "SELECT COUNT(*) as total FROM enquiries E LEFT JOIN courses C ON E.course_id = C.id LEFT JOIN branches B ON E.branch_id = B.id LEFT JOIN enquiry_types ET ON E.enq_source = ET.id WHERE Assignedto = 0 AND feedback NOT IN (1,2)";


        // Apply the filters to the query
        if ($DataSource) {
            $SearchQuery .= " AND enq_source = $DataSource";
            $CountQuery .= " AND enq_source = $DataSource";
        }

        if ($DataType) {
            $SearchQuery .= " AND leaddata = '$DataType'";
            $CountQuery .= " AND leaddata = '$DataType'";
        }


        if ($DataType && $DataType !== 'LD') {
            $SearchQuery .= " AND leaddata = '$DataType'";
            $CountQuery .= " AND leaddata = '$DataType'";

            if ($Branch) {
                $SearchQuery .= " AND branch_id = $Branch";
                $CountQuery .= " AND branch_id = $Branch";
            }
        }

        $Offset = ($Page - 1) * $PerPage;

        $SearchQuery .= " LIMIT $PerPage OFFSET $Offset";



        //return $SearchQuery;

        $Results = DB::select($SearchQuery);
        $CountResult = DB::select($CountQuery);
        $TotalCount = $CountResult[0]->total;

        return response()->json([
            'totalCount' => $TotalCount,
            'results' => $Results,
            'totalEnquiries' => $TotalEnquiries,
            'unAssignedEnquiries' => $UnAssignedEnquiries,
            'assignedEnquiries' => $AssignedEnquiries,

        ]);
    }


    public function Assign(Request $Request)
    {

        try {

            $SelectedEnquiries = $Request->Enquiries;
            $SelectedEnquiriesArray = explode(",", $SelectedEnquiries);
            $SelectedStaff = $Request->Staff;

            if ($SelectedStaff == 0) {
                throw new Exception("Please select a staff", 2);
            }

            if ($SelectedEnquiries == '') {
                throw new Exception("Please select atleast one enquiry", 2);
            }

            $AssignStaff = Enquiry::whereIn('id', $SelectedEnquiriesArray)->update(['Assignedto' => $SelectedStaff]);


            if ($AssignStaff > 0) {
                return $this->sendResponse("AssignStaff", $AssignStaff, '1', 'Staff Assigned Successfully');
            } else {
                throw new Exception("Failed updating record", 2);
            }
        } catch (Exception $Error) {
            return $this->sendResponse("AssignStaff", '', '1', $Error->getMessage());
        }
    }
}
