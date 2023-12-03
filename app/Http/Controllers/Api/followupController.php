<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\Followup;
use App\Models\Enquiry;
use App\Models\Feedback;
use App\Http\Resources\submitFeedbackResource;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EnquiryTypeResource;

class FollowupController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchEnquiries(Request $request)
    {

        $SearchQuery = "SELECT E.id,E.name,E.mob_no, C.course_name, ET.name As EnqName,E.leaddata,F.feedback As FEED ,E.next_folow_up,E.feedback,S.name As StaffName FROM enquiries E LEFT JOIN courses C ON E.course_id = C.id LEFT JOIN staff S  ON E.Assignedto =S.id LEFT JOIN  enquiry_types ET ON E.enq_source = ET.id LEFT JOIN _feedback F ON E.feedback = F.id WHERE E.feedback NOT IN (1,2)";

        $selectedCourse = $request->input('selectedCourse');
        $selectedEnquiryType = $request->input('selectedEnquiryType');
        $selectedLead = $request->input('selectedLead');
        $selectedBranch = $request->input('selectedBranch');
        $selectedStaff = $request->input('selectedStaff');
        $selectedDate = $request->input('selectedDate');
        $searchTerm = $request->input('searchTerm');

        // $enquiries = Enquiry::query();


        // Apply the filters to the query
        if ($selectedCourse) {
            $SearchQuery .= " AND E.course_id = $selectedCourse";
            // $enquiries->where('course_id', $selectedCourse);
        }

        if ($selectedEnquiryType) {
            $SearchQuery .= " AND E.enq_source = $selectedEnquiryType";
            //$enquiries->where('enq_source', $selectedEnquiryType);
        }

        if ($selectedLead && $selectedLead) {
            $SearchQuery .= " AND E.leaddata = '$selectedLead'";
            //$enquiries->where('leaddata', $selectedLead);

            if ($selectedBranch) {
                $SearchQuery .= " AND E.branch_id = $selectedBranch";
                //$enquiries->where('branch_id', $selectedBranch);
            }
        }

        if ($selectedStaff) {
            $SearchQuery .= " AND E.Assignedto = $selectedStaff";
            //$enquiries->where('Assignedto', $selectedStaff);
        }

        if ($selectedDate) {
            $selectedDate = Carbon::parse($selectedDate)->format('Y-m-d');
        } else {
            $selectedDate = Carbon::today()->format('Y-m-d');
        }


        $SearchQuery .= " AND (E.next_folow_up = '$selectedDate' OR E.next_folow_up IS NULL) ";


        if ($searchTerm) {
            $SearchQuery .= " AND(E.name LIKE '%$searchTerm%' OR E.mob_no LIKE '%$searchTerm%')";
        }

        // $enquiries->where(function ($query) use ($selectedDate) {
        //     $query->where(function ($query) use ($selectedDate) {
        //         $query->whereDate('next_folow_up', $selectedDate);
        //     })->orWhereNull('next_folow_up');
        // });

        // if ($searchTerm) {
        //     $enquiries->where(function ($query) use ($searchTerm) {
        //         $query->where('name', 'LIKE', '%' . $searchTerm . '%')
        //             ->orWhereHas('staff', function ($query) use ($searchTerm) {
        //                 $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        //             })
        //             ->orWhere('mob_no', 'LIKE', '%' . $searchTerm . '%');
        //     });
        // }

        // $enquiries->orderByRaw('ISNULL(next_folow_up), next_folow_up')->whereNotIn('feedback', [1, 2]);

        // $searchResults = $enquiries->get();

        // // Return the search results as JSON response
        // return response()->json($searchResults);


        $SearchQuery .= " ORDER BY ISNULL(E.next_folow_up), E.next_folow_up DESC";


        //return $SearchQuery;

        return DB::select($SearchQuery);
    }

    public function submitFeedback(Request $request)
    {


        try {

            $validatedData = $request->validate([
                'FeedbackName' => 'required',
                'remarks' => 'nullable',
                'nextdate' => 'required|date',
            ]);

            $nextdate = Carbon::parse($request->nextdate)->format('Y-m-d');

            DB::beginTransaction();


            $enquiry = Enquiry::findOrFail($request->enquiry_id);



            // Create a new Feedback model instance and set its attributes
            $feedback = Followup::create([
                'enquiry_id' => $enquiry->id, // Store the enquiry id in the feedback table
                'feedback_id' => $request->FeedbackName,
                'remarks' => $request->Remarks,
                'followup' => $nextdate,
                'staff_id' => $enquiry->Assignedto,

                // Add other feedback fields here
            ]);

            // Update the next_folow_up column in the Enquiry table
            $enquiry->next_folow_up = $nextdate;
            $enquiry->feedback = $feedback->feedback_id;
            $enquiry->save();

            DB::commit();

            // Return a JSON response with success message
            return $this->sendResponse("feedback", new submitFeedbackResource($feedback), '1', 'Next followUp created successfully');
        } catch (\Exception $e) {
            DB::rollback();

            // Return a JSON response with error message
            return $this->sendResponse("feedback", null, '0', $e->getMessage());
        }
    }

    public function getDeletableStatus(Request $request)
    {
        $feedbackId = $request->input('feedbackId');

        // Retrieve the feedback record based on the feedback ID
        $feedback = Feedback::find($feedbackId);

        if ($feedback) {
            $isDeletable = $feedback->is_deletable;

            return response()->json(['isDeletable' => $isDeletable]);
        }

        return response()->json(['isDeletable' => null], 404);
    }

    public function getFollowUpDetails($enquiryId) //get the folowup details
    {
        // Retrieve follow-up details for the corresponding enquiry ID from the database
        $followUpDetails = FollowUp::select('followup.remarks', 'followup.followup', 'staff.name as staff_name', '_feedback.feedback as feedback_name')->join('staff', 'followup.staff_id', '=', 'staff.id')
            ->join('_feedback', 'followup.feedback_id', '=', '_feedback.id')
            ->where('followup.enquiry_id', $enquiryId)
            ->get();

        return response()->json($followUpDetails);
    }

    public function searchEnquiriesinOffcanvas(Request $request)
    {
        $searchTerm = $request->input('searchTermInOffcanvas');

        // Perform the search query based on the search term (name or phone number)
        $enquiries = Enquiry::where('name', 'LIKE', "%$searchTerm%")
            ->orWhere('mob_no', 'LIKE', "%$searchTerm%")
            ->get();

        return response()->json(['enquiries' => $enquiries]);
    }

    public function getEnquiriesNameAndPhone(Request $request)
    {

        $getNameAndPhone = Enquiry::select('name', 'mob_no')->get();

        return response()->json(['getNameAndPhone' => $getNameAndPhone]);
    }
    public function searchByNameAndPhone(Request $request)
    {
        $id = $request->input('searchTermInOffcanvas');

        $EnquiryDatas = Enquiry::find($id);

        return response()->json($EnquiryDatas);
    }


    public function show($id)
    {

        $enquiryid = Followup::where('enquiry_id', '=', $id)->latest()->first();
        
        if (is_null($enquiryid)) {
            return $this->sendError('followup not found.');
        }

        return $this->sendResponse("enquirytype", new EnquiryTypeResource($enquiryid), '1', 'followup retrieved successfully.');
    }
    public function update(Request $request, $id)
    {

        try {


            DB::beginTransaction();

            $enquiryfeedback = Enquiry::find($id);
            $nextdateInOffcanvas = Carbon::parse($request->NextFollowup)->format('Y-m-d');

            $feedback = new Followup();

        $feedback->enquiry_id = $enquiryfeedback->id;
        $feedback->feedback_id = $request->FeedbackName;
        $feedback->remarks = $request->UpdateRemarks;
        $feedback->followup = $nextdateInOffcanvas;
        $feedback->staff_id = $request->Staff_id;
        
        // Update other feedback fields if needed
        $feedback->save();


            $enquiryfeedback->next_folow_up = $nextdateInOffcanvas;
            $enquiryfeedback->feedback = $feedback->feedback_id;
            $enquiryfeedback->save();

            DB::commit();

            // Return a JSON response with success message
            return $this->sendResponse("enquirytype", new EnquiryTypeResource($enquiryfeedback), '1', 'FollowUp Updated successfully');
        } catch (\Exception $e) {
            //DB::rollback();

            // Return a JSON response with error message
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ]);
        }
    }
}
