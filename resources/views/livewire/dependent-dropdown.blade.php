@php
    use App\Models\Staff;
    use App\Models\Enquiry;
    use Illuminate\Pagination\LengthAwarePaginator;
    
@endphp

<div>
    <div>
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                <select wire:model="selectedLeadData" class="form-select leadDrop" id="leaddata"
                    name="leaddata">
                    <option value="LD">Lead Data</option>
                    <option value="ED">Enquiry Data</option>
                </select>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">

                <select id="branch" wire:model="selectedBranch" class="form-select branchDrop" name="Branch">
                    <option value="">Select a branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                    @endforeach
                </select>
                @if (session()->has('error'))
                    <div style="color:red">{{ session('error') }}</div>
                @endif
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                <select wire:model="selectedStaff" class="form-select assigndrop staffDrop " id="assign_to"
                    name="AssignTo">
                    <option hidden value="">Select Staff</option>
                    @if (!is_null($selectedBranch))
                        @foreach (Staff::where('branch_id', $selectedBranch)->get() as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                <select wire:model="selectedSource" class="form-select sourceDrop  " id="source"
                    name="source">
                    <option hidden value="">Select Source</option>
                   
                    @foreach ($enquirytype as $Enq_Type)
                    <option value="{{ $Enq_Type->id }}">{{ $Enq_Type->name }}</option>
                @endforeach
                   
                </select>
            </div>
            
            <div class="col-xl-2 col-lg-2 col-md-4 col-6 mt-2">
                <button id="search-button" type="button" class="btn serachBtn" wire:click="refreshPage">
                    <i class="bi bi-arrow-clockwise"></i> &nbsp;Reset
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-3 ms-1">
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
            <div class="assignenqry-card ">
                <div class="row p-2">
                    <div class="col-8 ">
                        <h6 class="mb-0 "><b>Total Enquiries</b></h6>
                        <p class="ms-2 assigncard mb-1">{{ $TotalEnquiries }}</p>
                    </div>
                    <div class="col-4 px-2">
                        <img class="assignimage" src="{{ url('assets/images/assignsenquiry.png') }}"
                            style="width:70px; height:60px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
            <div class="assigned-card">
                <div class="row p-2">
                    <div class="col-8 ">
                        <h6 class=" mb-0"><b>Assigned</b></h6>
                        <p class="ms-2 assigncard mb-1">{{ $Assigned }}</p>
                    </div>
                    <div class="col-4 px-2">
                        <img class="assignimage" src="{{ url('assets/images/assignstaffs.png') }}"
                            style="width:70px; height:60px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
            <div class="unassign-card">
                <div class="row p-2">
                    <div class="col-8 ">
                        <h6 class="mb-0 "><b>Un Assigned</b></h6>
                        <p class="ms-2 assigncard mb-1">{{ $unassigned }}</p>
                    </div>
                    <div class="col-4 px-2">
                        <img class="assignimage" src="{{ url('assets/images/unassignstaffs.png') }}"
                            style="width:70px; height:60px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div id="exportbtns" class="exportbtns col-lg-6 col-12 ">
        <div class="dt-buttons btn-group flex-wrap">
      <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0">Excel</button>
      <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0">PDF</button>
      <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0">Print</button>
    </div>
    </div> --}}
    <div class="table-responsive mt-3">
        <table class="table MasterTable table-hover stafasgntble " id="MasterTable" style="width: 100%;">
            <thead class=" tablehead">
                <tr>

                    <th class="text-start ps-4"><input type="checkbox" class="pe-3" id="select-all-checkbox"
                            wire:click="toggleSelectAll"> Select All</th>
                    <th class="text-center">Name</th>
                    <th class="text-center"> Mobile Number</th>
                    <th class="text-center"> Course</th>
                    <th class="text-center"> Branch</th>
                    <th class="text-center"> Data Type</th>
                    <th class="text-center">  Enquiry Source</th>


                </tr>
            </thead>
            <tbody>
                @if (Enquiry::count() == 0)
                    <p>No enquiries to display.</p>
                @else
                    @foreach ($enquiries as $enquiry)
                        <tr data-id="{{ $enquiry->id }}">
                            <td class="text-start ps-4"><input type="checkbox"
                                    wire:click="toggleEnquiry({{ $enquiry->id }})"
                                    {{ in_array($enquiry->id, $checkedEnquiries) ? 'checked' : '' }}></td>
                            <td>{{ $enquiry->name }}</td>
                            <td>{{ $enquiry->mob_no }}</td>
                            <td>{{ $enquiry->Course }}</td>
                       
                            <td>{{ $this->getBranchName($enquiry->branch_id) }}</td>
                            <td>
                                @if($enquiry->leaddata ==='LD') Lead Data
                                @else Enquiry Data
                                @endif
                            </td>
                            <td>{{ $this->getEnqName($enquiry->enq_source) }}</td>
                        </tr>
                    @endforeach

            </tbody>
        </table>
        {{ $enquiries->appends(['selectedLeadData' => $selectedLeadData])->links() }}
        <div class="my-3 text-center">

            <button id="assign-btn" class="btn AddBtn px-4" wire:click="assignEnquiries"
                {{ !isset($selectedStaff) || count($checkedEnquiries) == 0 ? 'disabled' : '' }}>
                Assign Enquiries
            </button>

            @endif
        </div>
    </div>

</div>
