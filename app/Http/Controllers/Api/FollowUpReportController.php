<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FollowUpReportResources;
use App\Models\Enquiry;
use App\Models\Course;
use App\Models\Feedback;
use App\Models\Branch;
use App\Models\EnquiryType;

use Illuminate\Http\Request;

class FollowUpReportController extends BaseController
{

    public function followupreport(Request $request) {
        // Retrieve the selected branch, from date, and to date from the request
        $branchId = $request['branch'];
        $fromDate = $request['FromDate'];
        $toDate = $request['ToDate'];
        $Leaddata = $request['Datatype'];
        $EnquirySources = $request['EnquirySource'];

    
        $enquiriesQuery = Enquiry::select('enquiries.id', 'enquiries.name','enquiry_types.name AS EnqSource','enquiries.enq_source', '_feedback.feedback', 'courses.printable_name',
                                    'enquiries.remarks','branches.branch_name','enquiries.next_folow_up','enquiries.leaddata',
                                    'enquiries.branch_id', 'enquiries.leaddata', 'enquiries.created_at',
                                    'followup.created_at AS followup_created_at')
                                    ->leftJoin('enquiry_types', 'enquiries.enq_source', '=', 'enquiry_types.id')
                                    ->leftJoin('branches', 'enquiries.branch_id', '=', 'branches.id')
                                    ->leftJoin('_feedback', 'enquiries.feedback', '=', '_feedback.id')
                                    ->leftJoin('courses', 'enquiries.course_id', '=', 'courses.id')
                                    ->leftJoin('followup', 'enquiries.id', '=', 'followup.enquiry_id');
    
        // Apply filters if they are provided
        if ($branchId) {
            $enquiriesQuery->where('enquiries.branch_id', $branchId);
        }
        if ($Leaddata) {
            $enquiriesQuery->where('enquiries.leaddata', $Leaddata);
        }
        if ($fromDate) {
            $enquiriesQuery->whereDate('followup.created_at', '>=', $fromDate);
        }
        if ($toDate) {
            $enquiriesQuery->whereDate('followup.created_at', '<=', $toDate);
        }
        if ($EnquirySources) {
            $enquiriesQuery->where('enquiries.enq_source', $EnquirySources);
        }
    
        $enquiries = $enquiriesQuery->get();
        
        $response = [
            'enquiries' => $enquiries
        ];
        return $this->sendResponse("enquiries", $response,'1', 'Followup Records retrieved successfully.');

        // return response()->json($response);
    }
}
