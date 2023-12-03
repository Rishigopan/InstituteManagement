<?php

namespace App\Http\Livewire;

use App\Models\Branch;
use App\Models\Enquiry;
use App\Models\EnquiryType;
use App\Models\Staff;

use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class DependentDropdown extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $selectedBranch = null;
    public $selectedStaff = null;
    public $selectedSource = null;
    public $selectedStaffMemberId;

    public $successMessage;
    public $staff;

    public $Enquiry;

    public $selectAll = false;

    public $checkedEnquiries = [];
    public $currentPageEnquiryIds = [];
    public $selectedLeadData ='LD';

    public function toggleSelectAll()
    {
        $this->selectAll = !$this->selectAll;
    
        if ($this->selectAll) {
            $enquiriesQuery = Enquiry::where('Assignedto', 0);
    
            if ($this->selectedLeadData !== 'LD') {
                $enquiriesQuery->where('leaddata', $this->selectedLeadData);
            }
    
            $this->currentPageEnquiryIds = $enquiriesQuery->paginate(10)->pluck('id')->toArray();
            $this->checkedEnquiries = $this->currentPageEnquiryIds;
        } else {
            $this->currentPageEnquiryIds = [];
            $this->checkedEnquiries = [];
        }
    }
    
    
    

    public function toggleEnquiry($id)
    {
        if ($this->selectAll) {
            $key = array_search($id, $this->checkedEnquiries);
            if ($key !== false) {
                unset($this->checkedEnquiries[$key]);
            }
        } else {
            $key = array_search($id, $this->checkedEnquiries);
            if ($key === false) {
                $this->checkedEnquiries[] = $id;
            } else {
                unset($this->checkedEnquiries[$key]);
            }
        }
    }

    protected function rules()
    {
        return [
            'selectedBranch' => 'required',
            'selectedStaff' => 'required',
        ];
    }
    public function render()
    {
        $branches = Branch::all();
        $enquirytype = EnquiryType::all();
        $TotalEnquiries = Enquiry::count();
        $unassigned = Enquiry::where('Assignedto', 0)->count();
        $Assigned = $TotalEnquiries - $unassigned; // calculate the count of assigned records

if($this->selectedLeadData == 'LD'){
    $enquiriesQuery = Enquiry::select('id', 'name', 'Course', 'mob_no', 'branch_id', 'leaddata','enq_source')
    ->where('Assignedto', '=', 0)
    // ->when($this->selectedBranch, function ($query) {
    //     $query->where('branch_id', $this->selectedBranch);
    // })
    ->when($this->selectedLeadData, function ($query) {
        $query->where('leaddata', $this->selectedLeadData);
    });
}else{
    $enquiriesQuery = Enquiry::select('id', 'name', 'Course', 'mob_no', 'branch_id', 'leaddata','enq_source')
    ->where('Assignedto', '=', 0)
    ->when($this->selectedBranch, function ($query) {
        $query->where('branch_id', $this->selectedBranch);
    })
    ->when($this->selectedLeadData, function ($query) {
        $query->where('leaddata', $this->selectedLeadData);
    })
    ->when($this->selectedSource, function ($query) {
        $query->where('enq_source', $this->selectedSource);
    });
}
        

    $enquiries = $enquiriesQuery->paginate(10);

        $enquiries = $enquiriesQuery->paginate(10);

        // Append the selected lead data type to the pagination links
        $enquiries->appends(['selectedLeadData' => $this->selectedLeadData]);

        // Append the selected lead data type to the pagination links
        $enquiries->appends(['selectedLeadData' => $this->selectedLeadData]);


        return view('livewire.dependent-dropdown', [
            'branches' => $branches,
            'enquiries' => $enquiries,
            'enquirytype'=>$enquirytype,
        ], compact('TotalEnquiries', 'Assigned', 'unassigned'));
    }
    public function updatedSelectedBranch($branch_id)
    {
        if (!is_null($branch_id)) {
            $this->staff = Staff::where('branch_id', $branch_id)->get();
        } else {
            $this->staff = [];
        }

        $this->selectedStaff = null;
    }
    //Get Branch name in card
    public function getBranchName($branch_id)
    {
        $branch = Branch::find($branch_id);
        return $branch->branch_name ?? '';
    }
    public function getEnqName($enq_source)
{
    $enquiryType = EnquiryType::find($enq_source);
    return $enquiryType->name ?? '';
}

    public function selectStaffMember($id)
    {
        $this->selectedStaff = $id;
        $this->checkedEnquiries = [];
    }

    public function assignEnquiries()
    {
        try {
            $staff = Staff::find($this->selectedStaff);
            Enquiry::whereIn('id', $this->checkedEnquiries)->update(['Assignedto' => $this->selectedStaff]);
            $this->checkedEnquiries = [];


            session()->flash('success', 'Selected enquiries assigned to ' . $staff->name);
            $this->successMessage = 'The action was successful!';
            $this->reset(['checkedEnquiries']);
            $this->emit('enquiriesAssigned');
        } catch (\Exception $e) {
            // Set Flash Message
            $this->dispatchBrowserEvent('alert', [
                'type' => 'error',
                'message' => "Something goes wrong while creating category!!"
            ]);


            // Dispatch the browser event
            $this->dispatchBrowserEvent('showSuccessMessage');
        }
    }
    protected $listeners = ['show-toast' => 'setToast'];
    public $alertTypeClasses = [
        'success' => ' bg-green-500 text-white',
        'warning' => ' bg-orange-500 text-white',
        'danger' => ' bg-red-500 text-white',
    ];

    public $message = 'Notification Message';
    public $alertType = 'success';

    public function setToast($message, $alertType)
    {
        $this->message = $message;
        $this->alertType = $alertType;


        $this->dispatchBrowserEvent('toast-message-show');
    }
    public function refreshPage()
    {
        return redirect()->route('staffassign.StaffAssign');
    }
}
