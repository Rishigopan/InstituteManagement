<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\EnquiryType;
use App\Models\Feedback;
use App\Models\followup as followModel;
use App\Models\Staff;
use App\Models\Stream;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Followup extends Component
{
    use WithPagination;

    public $course;
    public $EnquiryType;
    public $branch;
    public $staff;
    public $selectedCourse;
    public $selectedEnquiryType;
    public $selectedBranch;
    public $selectedStaff;
    public $selectedLead;
    public $selectedDate;
    public $searchResults;
    public $loading = false; // Added loading state variable
    public $enquiry;
    public $enquiryCount;
    public $feedback;
    public $checkdata;
    // Define public properties for feedbackform inputs
    public $feedback_id;
    public $remarks;
    public $nextdate;
    public $selectedEnquiryId;
    public $feedbackhistory;
    public $showFeedbackModal = false;
    public $checklistItems;
    public $searchTerm;

    public $daysLater=[];
    public $nextdateReadonly ; 
       public $editFeedbackId;
       public $afterDays;
       public $viewMode = 'card';
       public $selectedFeedbackId;
       public $isFeedbackDeletable;
       public $hideNextFollowUp = false;
   
 
    public function __construct()
    {
        $this->selectedDate = Carbon::today()->format('Y-m-d');
       
    }
    public function changeViewMode($mode)
{
    $this->viewMode = $mode;
}
    public function editData($feedbackId)
    {
        $feedback = Feedback::findOrFail($feedbackId);

        $this->editFeedbackId = $feedback->id;
        $this->feedback_id = $feedback->feedback_id;
        $this->daysLater = $feedback->days_later;
        $this->nextdate = $feedback->next_followup_date;
        $this->remarks = $feedback->remarks;
    }
    public function updateFeedback()
    {
        // Perform validation for the edited feedback fields
        $this->validate([
            'feedback_id' => 'required',
            'daysLater' => 'required',
            'nextdate' => 'required_if:daysLater,Custom',
            'remarks' => 'nullable',
        ]);
        
 
        // Find the feedback record and update its values
        $feedback = Feedback::findOrFail($this->editFeedbackId);
        $feedback->feedback_id = $this->feedback_id;
        $feedback->days_later = $this->daysLater;
        $feedback->next_followup_date = $this->nextdate;
        $feedback->remarks = $this->remarks;
        $feedback->save();

        // Clear form fields and emit an event to update the feedback list
        $this->reset(['feedback_id', 'daysLater', 'nextdate', 'remarks', 'editFeedbackId']);
        $this->emit('feedbackUpdated');

        // Close the modal or perform any other necessary actions
        // ...
    }
    public function updateSelectedFeedbackId()
    {
        // Retrieve the selected feedback's is_deletable value
        $selectedFeedback = Feedback::find($this->feedback_id);
        if ($selectedFeedback) {
            $this->isFeedbackDeletable = $selectedFeedback->is_deletable;
    
            // Check if the feedback is deletable
            if ($this->isFeedbackDeletable === 'NO') {
                // Hide the next follow-up section
                $this->hideNextFollowUp = true;
            } else {
                $this->hideNextFollowUp = false;
            }
        } else {
            $this->isFeedbackDeletable = null;
            $this->hideNextFollowUp = false;
        }
    }
    

    public function updateNextDate($date)
{
    $this->nextdate = $date;
}

    public function mount()
    {
        $this->selectedDate = now()->toDateString();
        $this->course = Course::all();
        $this->EnquiryType = EnquiryType::all();
        $this->branch = Branch::all();
        $this->staff = Staff::all();
        $this->enquiry = Enquiry::all();
        $this->feedback = Feedback::all();
        $this->feedbackhistory = followModel::all();
        $this->search();
        $this->nextdate = Carbon::today()->format('Y-m-d');
    }
    public function toggleAfterDays()
    {
        if ($this->daysLater == '6') {
            $this->daysLater = [];
            $this->afterDays = null;
        } else {
            $this->daysLater = ['6'];
        }
    }

    public function updatedDaysLater()
    {
        $daysLater = collect($this->daysLater);

        if ($daysLater->contains('1')) {
            $this->nextdate = Carbon::today()->addDay()->format('Y-m-d');
        } elseif ($daysLater->contains('2')) {
            $this->nextdate = Carbon::today()->addDays(2)->format('Y-m-d');
        } elseif ($daysLater->contains('3')) {
            $this->nextdate = Carbon::today()->addDays(5)->format('Y-m-d');
        } elseif ($daysLater->contains('4')) {
            $this->nextdate = Carbon::today()->addWeek()->format('Y-m-d');
        } elseif ($daysLater->contains('5')) {
            $this->nextdate = Carbon::today()->addMonth()->format('Y-m-d');
        } elseif ($daysLater->contains('6')) {
            
        } else {
            // Handle other cases if necessary
            $this->nextdate = null;
        }
    }

    // Other methods...

    
    protected $rules = [
        'selectedStaff' => 'nullable|array',  
    ];
    public function updateNextFollowUpField()
{
    if ($this->daysLater == 'Custom') {
        $this->enableNextFollowUpField();
    } else {
        $this->disableNextFollowUpField();
    }
}
public function resetForm()
{
    $this->feedback_id = null;
    $this->daysLater = null;
    $this->afterDays = null;
    $this->nextdate = null;
    $this->remarks = null;
}

public function enableNextFollowUpField()
{
    $this->resetErrorBag(); // Reset any previous validation errors
    $this->nextdateReadonly = false;
}

public function disableNextFollowUpField()
{
    $this->nextdate = null; // Clear the value when disabling the field
    $this->nextdateReadonly = true;
}
    public function getFollowUpHistory($enquiryId)
    {
        $enquiry = Enquiry::findOrFail($enquiryId);
        $this->feedbackhistory = $enquiry->followups;
    }
    public function selectEnquiry($enquiryId)
    {
        $this->selectedEnquiryId = $enquiryId;
    }
    public function getEnquiryId($EnqId)
    {
        // Retrieve the task name from your data source based on the task ID
        $Enq = Task::find($EnqId);
    }
    //Show checklist in modal public function showChecklist($enquiryId)
    public function showChecklist($enquiryId)
    {
        // Fetch the checklist items based on the selected enquiry ID
        $checklist = followModel::where('enquiry_id', $enquiryId)->get();

        // If the checklist exists, set the modal checklist items
        if ($checklist) {
            $this->checklistItems = $checklist;
        } else {
            $this->checklistItems = [];
        }

        $this->showFeedbackModal = true;
    }
    public function updateNextDates($days)
    {
        $this->nextdate = Carbon::today()->addDays($days)->format('Y-m-d');
    }
    


    public function search()
    {
        $enquiries = Enquiry::query();
        //dd($this->selectedBranch);

        if ($this->selectedCourse) {
            $enquiries->where('course_id', $this->selectedCourse);
        }

        if ($this->selectedEnquiryType) {
            $enquiries->where('enq_source', $this->selectedEnquiryType);
        }

        if ($this->selectedLead && $this->selectedLead !== 'LD') {
            $enquiries->where('leaddata', $this->selectedLead);
            
            if ($this->selectedBranch) {
                $enquiries->where('branch_id', $this->selectedBranch);
            }
        }

        if ($this->selectedStaff) {
            $enquiries->where('Assignedto', $this->selectedStaff);
        }

        if ($this->selectedLead) {
            $enquiries->where('leaddata', $this->selectedLead);
        }

        if ($this->selectedDate) {
            $selectedDate = Carbon::parse($this->selectedDate)->format('Y-m-d');
        } else {
            $selectedDate = Carbon::today()->format('Y-m-d');
        }

    
        $enquiries->where(function ($query) use ($selectedDate) {
            $query->where(function ($query) use ($selectedDate) {
                $query->whereDate('next_folow_up', $selectedDate);
            })->orWhereNull('next_folow_up');
        });
        


       

        // $enquiries->where(function ($query) {
        //     $query->WhereDate('next_folow_up', $this->selectedDate)->orwhereNull('next_folow_up');
        // });

        $enquiries->where(function ($query) {
            $searchTerm = $this->searchTerm;
            $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhereHas('staff', function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', '%' . $searchTerm . '%');
                })
                ->orWhere('mob_no', 'LIKE', '%' . $searchTerm . '%');
        });


        $enquiries->orderByRaw('ISNULL(next_folow_up), next_folow_up')->whereNotIn('feedback', [1, 2]);
 

        // Filter by today's date
        $enquiries->orderBy('name'); // Sort the results by name


        $this->searchResults = $enquiries->get();
    }
    public function openFeedbackModal($enquiryId)
{
    $this->selectEnquiry($enquiryId);
    $this->dispatchBrowserEvent('openFeedbackModal');
}

    public function submitFeedback()
    {
        $validatedData = $this->validate([
            'feedback_id' => 'required',
            'remarks' => 'nullable',
            'nextdate' => 'required|date',
        ]);

        $nextdate = Carbon::parse($this->nextdate)->format('Y-m-d');

        try {
            DB::beginTransaction();

            // Get the corresponding enquiry record based on the selected feedback_id
            $enquiry = Enquiry::findOrFail($this->selectedEnquiryId);
            
            $is_deletable = 'NO'; // Define the variable with NO
            if ($is_deletable === 'NO') {
                $feedbackId = $this->selectedFeedbackId;
                $enquiry->feedback = $feedbackId; // Store the feedback ID in the enquiry table
                $enquiry->save();
            }

    
            // Create a new Feedback model instance and set its attributes
            $feedback = followModel::create([
                'enquiry_id' => $enquiry->id, // Store the enquiry id in feedback table
                'feedback_id' => $this->feedback_id,
                'remarks' => $this->remarks,
                'followup' => $nextdate,
                'staff_id' => $enquiry->Assignedto,

                // Add other feedback fields here
            ]);


            // Update the next_folow_up column in the Enquiry table
            $enquiry->next_folow_up = $nextdate;
            $enquiry->feedback = $feedback->feedback_id;
            $enquiry->save();
            // Refresh the follow-up history after creating the feedback
            $this->getFollowUpHistory($this->selectedEnquiryId);
            DB::commit();

            // Redirect the user to a success page or display a success message
            return redirect()->route('followUp.Followup');
        } catch (\Exception $e) {
            DB::rollback();

            // Handle the error, redirect to an error page, or display an error message
            // For example:
            session()->flash('error', 'An error occurred while submitting the feedback.');

            return redirect()->back();
        }
    }
    //Get feedback name in card
    public function getFeedback($enquiryId)
    {
        // Retrieve the task name from your data source based on the task ID
        $feedback = Feedback::find($enquiryId);
        return $feedback->feedback ?? '';
    }
    public function getStaffName($enquiryId)
    {

        $staff = Staff::find($enquiryId);
        return $staff->name ?? '';
    }
    public function getCourseName($enquiryId)
    {


        $course = Course::find($enquiryId);
        return $course->course_name ?? '';
    }

    public function getEnquirySourceName($enquiryId)
    {

        $EnquirySource = EnquiryType::find($enquiryId);
        return $EnquirySource->name ?? '';
    }
    

     
    public function render()
    {
        $enquiryCount = Enquiry::count();



        return view('livewire.followup', [
            'course' => $this->course,
            'EnquiryType' => $this->EnquiryType,
            'branch' => $this->branch,
            'staff' => $this->staff,
            'enquiry' => $this->enquiry,
            'enquiryCount' => $enquiryCount, // Pass the count to the view
            'searchResults' => $this->searchResults,
            'feedback' => $this->feedback,
            'checklistItems' => $this->checklistItems,
        ])->with('loading', $this->loading);
    }


    public function refreshPage()
    {
        return redirect()->route('followUp.Followup');
    }
}
