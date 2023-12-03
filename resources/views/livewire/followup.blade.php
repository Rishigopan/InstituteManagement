@php
    use App\Models\Staff;
    use App\Models\Enquiry;
    use Carbon\Carbon;
    use App\Models\FollowUp;
@endphp


<div>
    @push('styles')
        <link href="{{ asset('css/livewire-loading.css') }}" rel="stylesheet">
    @endpush
    <form wire:submit.prevent="submitFeedback">
        <div wire:ignore.self class="modal fade addUpdateModal" id="FeedbackModel" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Feedback</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="submitFeedback" class="Enquiry AddForm" id="Feed_back" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Feedback Type<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <select class="form-select inputfield " aria-label="Default select example name"
                                        id="feedback_name" name="FeedbackName" wire:model="feedback_id" required
                                        wire:change="updateSelectedFeedbackId">
                                        <option hidden class="inputlabel" value=""> Choose Feedback Type</option>
                                        @foreach ($feedback as $feedbackdata)
                                            <option class="inputlabel" value="{{ $feedbackdata->id }}">
                                                {{ $feedbackdata->feedback }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                @if (!$hideNextFollowUp)
                                    <div class="col-12">
                                        <label class="mt-3 mb-1 inputlabel">Next FollowUp - IN</label><br>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="radio" wire:model="daysLater"
                                                    value="1"@if ($daysLater == '1') checked @endif>Tomorrow
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" wire:model="daysLater" value="2"
                                                    @if ($daysLater == '2') checked @endif>After 2 days
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" wire:model="daysLater"
                                                    value="3"@if ($daysLater == '3') checked @endif>After
                                                5
                                                days
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="radio" wire:model="daysLater" value="4"
                                                    @if ($daysLater == '4') checked @endif>Next Week
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" wire:model="daysLater"
                                                    value="5"@if ($daysLater == '5') checked @endif>Next
                                                Month
                                            </div>
                                            {{-- <div class="col-4">
                                            <input type="radio" wire:model="daysLater" value="6"
                                                @if ($daysLater == '6') checked @endif
                                                wire:click="toggleAfterDays"
                                                @if (is_array($daysLater) && in_array('6', $daysLater)) checked @endif>
                                            After

                                        </div> --}}
                                        </div>
                                        {{-- <div class="col-12">
                                        @if (is_array($daysLater) && in_array('6', $daysLater))
                                            <select class="form-control mt-1 inputfield" wire:model="afterDays"
                                                @if ($afterDays) wire:change="updateNextDate()" @endif>
                                                <option value="">Select days</option>
                                                @for ($i = 1; $i <= 9; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        @endif
                                    </div> --}}
                                    </div>


                                    <div class="col-12">
                                        <label class="mt-3 mb-1 inputlabel">Next FollowUp</label><br>

                                        <input type="date" class="form-control mt-1 inputfield" id="nextdate"
                                            name="nextdate" wire:model="nextdate" wire:change="updateNextDate()"
                                            autofocus>

                                    </div>
                                @endif

                                <div class=" col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks</label><br>
                                    <textarea class="form-control mt-1 inputfield" id="remarks" name="remarks" placeholder="Enter Remark"
                                        wire:model="remarks" autofocus></textarea>
                                </div>
                            </div>
                            <div class="mb-0">

                            </div>

                            <div class=" text-end mt-3">
                                <button type="button" class="btn  fa fa-refresh" wire:click="resetForm"
                                    style="color: lightblue;"></button>
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </form>


    <form wire:submit.prevent="updateFeedback">
        <div wire:ignore.self class="modal fade addUpdateModal" id="HistoryModal" tabindex="-1"
            data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Follow-Up History</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="Feedbackfollowup" class="Enquiry AddForm" id="Feed_back_followup"
                            novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <table>
                                    <thead>
                                        <th>Follow-up Date</th>
                                        <th>Feedback</th>
                                        <th>Remark</th>
                                        <th>Staff</th>


                                    </thead>
                                    <tbody>

                                        @if ($checklistItems && count($checklistItems) > 0)
                                            @foreach ($checklistItems as $history)
                                                @php
                                                    
                                                    $staffName = $this->getStaffName($history['staff_id']);
                                                    
                                                @endphp
                                                <tr>
                                                    <td>{{ $history->followup }}</td>
                                                    <td>{{ $history->feedback->feedback }}</td>
                                                    <td>{{ $history->remarks }}</td>
                                                    <td>{{ $staffName }}</td>
                                                    {{-- <td><a wire:click="editData({{ $history['id'] }})" data-bs-toggle="modal" data-bs-target="#UpdateFeedbackModel">
                                                        <i class="ri-pencil-line" aria-hidden="true"></i></a></td>
                                                </tr> --}}
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">No feedback history available.</td>
                                            </tr>
                                        @endif


                                    </tbody>
                                </table>

                            </div>
                            <div class=" text-end mt-3">
                                <button type="button" class="btn savebtn  px-5 "data-bs-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </form>



    <div class="row">


        <div class="col-lg-2 col-6 mt-3">
            <select class="form-select CourseDrop" wire:model="selectedCourse"
                aria-label="Default select example name" id="course" name="course">



                <option class="inputlabel" value="0"> Select Course</option>
                @foreach ($course as $key)
                    <option class="inputlabel" value="{{ $key->id }}">{{ $key->course_name }}
                    </option>
                @endforeach
            </select>



        </div>
        <div class="col-lg-2 col-6 mt-3">
            <select wire:model="selectedLead" class="form-select">
                <option value="0">Select Datatype</option>
                <option value="LD">LEAD DATA</option>
                <option value="ED">ENQUIRY DATA</option>
            </select>
        </div>

        <div class="col-lg-2 col-6 mt-3">
            <select id="branch" wire:model="selectedBranch" class="form-select branchDrop" name="Branch">
                <option value="0">Select Branch</option>
                @foreach ($branch as $item)
                    <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-lg-2 col-6 mt-3">

            <select wire:model="selectedStaff" class="form-select assigndrop staffDrop " id="assign_to"
                name="AssignTo">
                <option value="">Select Staff</option>
                @foreach (Staff::where('branch_id', $selectedBranch)->get() as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                @endforeach
            </select>


        </div>

        <div class="col-lg-2 col-6 mt-3">
            <input type="date" class="form-control" value="{{ $selectedDate }}" wire:model="selectedDate">
        </div>
        <div class="col-lg-2 col-6 mt-3">
            <select class="form-select  branchDrop" wire:model="selectedEnquiryType"
                aria-label="Default select example name" id="enquirytype" name="enquirytype">
                <option class="inputlabel" value="0">Select Source</option>
                @foreach ($EnquiryType as $key)
                    <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                    </option>
                @endforeach
            </select>


        </div>
    </div>



    <div class="row">

        <div class="col-lg-4 col-12 mt-3 ">

        </div>


        <div class="col-lg-2 col-6 mt-3">


            <button type="submit" class="btn AddBtn w-100" wire:click="search">Search</button>


        </div>
        <div class="col-lg-2 col-6 mt-3 ">
            <button id="search-button" type="button" class="btn serachBtn" wire:click="refreshPage">
                <i class="bi bi-arrow-clockwise"></i> &nbsp;Reset
            </button>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-link" wire:click="changeViewMode('grid')">
                <i class="bi-grid-3x3"></i>

            </button>
            <button class="btn btn-link" wire:click="changeViewMode('card')">
                <i class="ri-file-list-2-line ms-2 fs-4"></i>
            </button>
        </div>


    </div>







    <div class="container-fluid mainContents">
        <div class="row">
            {{-- <div class="col-lg-6 col-6 "> Total Records: {{ $enquiryCount }}</div> --}}
        </div>


        <div>

            <!-- Show loading image if loading is true -->
            @if ($loading)
                <div class="loading-container">
                    <img src="{{ asset('assets/images/loadingg.gif') }}" alt="Loading..." class="loading-image">
                </div>
            @endif
            @if ($searchResults)
                @php
                    // Sort the search results by name
                    $sortedResults = $searchResults->sortBy('id');
                @endphp



                <div class="row m-integrations__results">

                    @foreach ($sortedResults as $Enquiry)
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="card followup"
                                style="{{ $Enquiry->next_folow_up == null ? 'background-color:  #f8f2e1 ;' : '' }}">
                                <div class="card-text d-flex justify-content-end ">
                                    <a href="tel:{{ $Enquiry->mob_no }}"><i> <img
                                                src="{{ asset('assets/img/phonecall.png') }}"
                                                style="width:30px; height:30px;"> </i></a>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"> Name:{{ $Enquiry->name }}</p>
                                    <p class="card-text">
                                        Mobile:{{ $Enquiry->mob_no }}

                                    </p>
                                    <p class="card-text">
                                        Course:{{$this->getCourseName($Enquiry['course_id'])}}

                                    </p>

                                    <p>Feedback:
                                        {{ $this->getFeedback($Enquiry['feedback']) ?: 'No feedback available' }}</p>



                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <a data-bs-toggle="modal" data-bs-target="#FeedbackModel"
                                                wire:click="selectEnquiry({{ $Enquiry->id }})"><i> <img
                                                        src="{{ asset('assets/img/feedback (1).png') }}"
                                                        style="width:20px; height:20px;"> </i></a>
                                        </div>

                                        <div>
                                            <i> <img src="{{ asset('assets/img/clock.png') }}"
                                                    style="width:20px; height:20px;" data-bs-toggle="modal"
                                                    wire:click="showChecklist('{{ $Enquiry['id'] }}')"
                                                    data-bs-target="#HistoryModal"> </i>

                                        </div>
                                        <div>
                                            @if ($Enquiry->leaddata === 'LD')
                                                <a href="{{ url('/enquiryedit/' . $Enquiry->id) }}"><i> <img
                                                            src="{{ asset('assets/img/data-transfer (1).png') }}"
                                                            style="width:20px; height:20px;"> </i></a>
                                            @endif
                                        </div>


                    @if ($viewMode === 'grid')
                        <div class="card followup">
                            <div class="table-responsive">
                                <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                    <thead class=" tablehead">
                                        <tr>
                                            <th class="text-center">Si No</th>
                                            <th class="text-center">Enquiry Date</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Mobile</th>
                                            <th class="text-center">Course</th>
                                            <th class="text-center">Enquiry Source</th>
                                            <th class="text-center">feedback History</th>
                                            <th class="text-center">feedback</th>

                                            <th class="text-center">Call</th>
                                            <th class="text-center">SMS</th>
                                            <th class="text-center">Whatsapp</th>
                                            <th class="text-center">Data convert</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sortedResults as $Enquiry)
                                            <tr
                                                style="{{ $Enquiry->next_folow_up == null ? 'background-color:  #faf3dd ;' : '' }}">
                                                <td>{{ $Enquiry->id }}</td>
                                                <td></td>
                                                <td>{{ $Enquiry->name }}</td>
                                                <td>{{ $Enquiry->mob_no }}</td>
                                                <td>{{ $this->getCourseName($Enquiry['course_id']) }}</td>
                                                <td>{{ $this->getEnquirySourceName($Enquiry['enq_source']) ?: 'Not Available' }}
                                                </td>
                                                <td>{{ $this->getFeedback($Enquiry['feedback']) ?: 'No Follow Up Yet' }}
                                                </td>
                                                <td> <a data-bs-toggle="modal" data-bs-target="#FeedbackModel"
                                                        wire:click="selectEnquiry({{ $Enquiry->id }})">
                                                        <img class="followupfooterimg"
                                                            src="{{ asset('assets/img/feedback (1).png') }}"
                                                            style="width:20px; height:20px;" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="Feedback">
                                                    </a></td>
                                                <td><a href="tel:{{ $Enquiry->mob_no }}" class="tooltip-custom"><i
                                                            class="bi bi-telephone-plus-fill"></i></a></td>
                                                <td><a href="tel:{{ $Enquiry->mob_no }}" class="tooltip-custom"><i
                                                            class="bi bi-chat-quote-fill"></i></a></td>
                                                <td><a href="https://wa.me/91{{ $Enquiry->mob_no }}"
                                                        class="tooltip-custom" style="color:green;"><i
                                                            class="bi bi-whatsapp"></i></a></td>
                                                @if ($Enquiry->leaddata === 'LD')
                                                    <td><a href="{{ url('/enquiryedit/' . $Enquiry->id) }}">
                                                            <img class="followupfooterimg"
                                                                src="{{ asset('assets/img/data-transfer (1).png') }}"
                                                                style="width:20px; height:20px;"
                                                                data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                title="Data Convert">
                                                        </a></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    @elseif ($viewMode === 'card')
                        @foreach ($sortedResults as $Enquiry)
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="card followup"
                                    style="{{ $Enquiry->next_folow_up == null ? 'background-color:  #f8f2e1 ;' : '' }}">
                                    <div class="card-text d-flex justify-content-end">
                                        <a href="tel:{{ $Enquiry->mob_no }}" class="tooltip-custom"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Call"
                                            wire:click="openFeedbackModal({{ $Enquiry->id }})">
                                            <img class="followupfooterimg"
                                                src="{{ asset('assets/img/phonecall.png') }}"
                                                style="width:30px; height:30px;">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"> Name:{{ $Enquiry->name }}</p>
                                        <p class="card-text">
                                            Mobile:{{ $Enquiry->mob_no }}
                                        </p>
                                        <p class="card-text">
                                            Course:{{ $this->getCourseName($Enquiry['course_id']) }}
                                        </p>
                                        <p class="card-text">
                                            Enquiry
                                            Source:{{ $this->getEnquirySourceName($Enquiry['enq_source']) ?: 'Not Available' }}
                                        </p>

                                        <p>Feedback:
                                            {{ $this->getFeedback($Enquiry['feedback']) ?: 'No Follow Up Yet' }}
                                        </p>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <a data-bs-toggle="modal" data-bs-target="#FeedbackModel"
                                                    wire:click="selectEnquiry({{ $Enquiry->id }})">
                                                    <img class="followupfooterimg"
                                                        src="{{ asset('assets/img/feedback (1).png') }}"
                                                        style="width:20px; height:20px;" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Feedback">
                                                </a>
                                            </div>

                                            <div>
                                                <a data-bs-toggle="modal" data-bs-target="#HistoryModal">
                                                    <img class="followupfooterimg"
                                                        src="{{ asset('assets/img/clock.png') }}"
                                                        wire:click="showChecklist('{{ $Enquiry['id'] }}')"
                                                        style="width:20px; height:20px;" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" title="Feedback History"></a>
                                            </div>
                                            <div>
                                                <a href="tel:{{ $Enquiry->mob_no }}" class="tooltip-custom"><i
                                                        class="bi bi-chat-quote-fill"></i></a>
                                            </div>

                                            <div><a href="https://wa.me/91{{ $Enquiry->mob_no }}"
                                                    class="tooltip-custom" style="color:green"><i
                                                        class="bi bi-whatsapp"></i></a></div>
                                            <div>

                                                @if ($Enquiry->leaddata === 'LD')
                                                    <a href="{{ url('/enquiryedit/' . $Enquiry->id) }}">
                                                        <img class="followupfooterimg"
                                                            src="{{ asset('assets/img/data-transfer (1).png') }}"
                                                            style="width:20px; height:20px;" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" title="Data Convert">
                                                    </a>
                                                @endif
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif




                </div>
                <!-- Display pagination links -->


            @endif


        </div>
    </div>
    @if ($loading)
        <div class="loading-container">
            <img src="{{ asset('assets/images/loadingg.gif') }}" alt="Loading..." class="loading-image">
        </div>
    @endif


</div>
