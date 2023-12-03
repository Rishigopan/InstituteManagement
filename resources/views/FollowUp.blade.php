<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')


</head>

<body>

    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('layouts.navbar')

        <style>
            .adminActions {
                position: fixed;
                bottom: 35px;
                right: 35px;
            }

            .adminButton {
                height: 60px;
                width: 60px;
                background-color: rgba(227, 98, 98, 0.8);
                border-radius: 50%;
                display: block;
                color: #fff;
                text-align: center;
                position: relative;
                z-index: 1;
            }

            .adminButton i {
                font-size: 22px;
            }

            .adminButtons {
                position: absolute;
                width: 100%;
                bottom: 120%;
                text-align: center;
            }

            .adminButtons a {
                display: block;
                width: 45px;
                height: 45px;
                border-radius: 50%;
                text-decoration: none;
                margin: 10px auto 0;
                line-height: 1.15;
                color: #fff;
                opacity: 0;
                visibility: hidden;
                position: relative;
                box-shadow: 0 0 5px 1px rgba(51, 51, 51, .3);
            }

            .adminActions a i {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            .adminToggle {
                -webkit-appearance: none;
                position: absolute;
                border-radius: 50%;
                top: 0;
                left: 0;
                margin: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
                background-color: transparent;
                border: none;
                outline: none;
                z-index: 2;
                transition: box-shadow .2s ease-in-out;
                box-shadow: 0 3px 5px 1px rgba(51, 51, 51, .3);
            }
        </style>
    </header>

    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <aside id="sidebar" class="sidebar ps-0">
        @include('layouts.sidebar')
    </aside>

    <!-- End Sidebar-->

    <main id="main" class="main">

        {{-- --------------------------------------Offcanvas--------------------------------------------------- --}}
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Search Result </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">

                <div class="container">

                    <div class="row px-3 mb-3">
                        <div class="col-xl-10 col-lg-9 col-9">
                            <select class="SearchAndSelect inputfield" id="searchTermInOffcanvas"
                                name="searchTermInOffcanvas">
                                <option selected value=""> Choose </option>
                                @foreach ($NameAndPhone as $NameAndPhonekey)
                                    <option class="inputlabel" value="{{ $NameAndPhonekey->id }}">
                                        {{ $NameAndPhonekey->name }} -
                                        {{ $NameAndPhonekey->mob_no }} </option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>

                    <div id="formContainer" style="display: none;">
                        <div class="card card-body main_card mt-2 shadow-lg mb-2">
                            <form class="Enquiry AddForm" id="UpdateFeed_back" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <input type="hidden" id="update_feedback_id" name="enquiry_id">
                                        <input type="hidden" id="Update_enquiry_id" name="enquiry_id">
                                        <input type="hidden" id="Update_assigned_staff_id" name="assigned_staff_id">
                                        <label class="mt-2 mb-1 inputlabel">Feedback Type<span
                                                style="color:red; font-size:15px"> *</span></label><br>
                                        <select class="form-select inputfield " aria-label="Default select example name"
                                            id="update_feedback_name" name="Update_FeedbackName" required>
                                            <option hidden class="inputlabel" value=""> Choose Feedback Type
                                            </option>
                                            @foreach ($feedback as $feedbackdata)
                                                <option class="inputlabel" value="{{ $feedbackdata->id }}">
                                                    {{ $feedbackdata->feedback }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12" id="next_followup_inOffcanvas">
                                        <label class="mt-3 mb-1 inputlabel">Next FollowUp - IN</label><br>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="radio" name="followup_optionInOffcanvas"
                                                    value="1">Tomorrow
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" name="followup_optionInOffcanvas"
                                                    value="2">After
                                                2 days
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" name="followup_optionInOffcanvas"
                                                    value="3">After
                                                5 days
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <input type="radio" name="followup_optionInOffcanvas"
                                                    value="4">Next
                                                Week
                                            </div>
                                            <div class="col-4">
                                                <input type="radio" name="followup_optionInOffcanvas"
                                                    value="5">Next
                                                Month
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" id="next_followup_dateInOffcanvas">
                                        <label class="mt-3 mb-1 inputlabel">Next FollowUp</label><br>
                                        <input type="date" class="form-control mt-1 inputfield" id="update_nextdate"
                                            name="nextdate" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d"); ?>" autofocus required >
                                    </div>


                                    <div class=" col-12">
                                        <label class="mt-3 mb-1 inputlabel">Remarks</label><br>
                                        <textarea class="form-control mt-1 inputfield" id="update_remarks" name="remarks" placeholder="Enter Remark" autofocus></textarea>
                                    </div>
                                </div>
                                <div class="mb-0">

                                </div>

                                <div class=" text-end mt-3">
                                    <button type="submit" class="btn savebtn px-5">Update</button>
                                </div>
                            </form>
                        </div>



                    </div>

                </div>


            </div>
        </div>

        {{-- ----------------------------------show the followup modal------------------------------ --}}

        <div class="modal fade addUpdateModal" id="FeedbackModel" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Feedback</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Enquiry AddForm" id="Feed_back" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <input type="hidden" id="enquiry_id" name="enquiry_id">
                                    <input type="hidden" id="assigned_staff_id" name="assigned_staff_id">
                                    <label class="mt-2 mb-1 inputlabel">Feedback Type<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <select class="form-select inputfield " aria-label="Default select example name"
                                        id="feedback_name" name="FeedbackName" required>
                                        <option hidden class="inputlabel" value=""> Choose Feedback Type
                                        </option>
                                        @foreach ($feedback as $feedbackdata)
                                            <option class="inputlabel" value="{{ $feedbackdata->id }}">
                                                {{ $feedbackdata->feedback }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12" id="next_followup_in">
                                    <label class="mt-3 mb-1 inputlabel">Next FollowUp - IN</label><br>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="radio" name="followup_option" value="1">Tomorrow
                                        </div>
                                        <div class="col-4">
                                            <input type="radio" name="followup_option" value="2">After 2 days
                                        </div>
                                        <div class="col-4">
                                            <input type="radio" name="followup_option" value="3">After 5 days
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="radio" name="followup_option" value="4">Next Week
                                        </div>
                                        <div class="col-4">
                                            <input type="radio" name="followup_option" value="5">Next Month
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="next_followup_date">
                                    <label class="mt-3 mb-1 inputlabel">Next FollowUp</label><br>
                                    <input type="date" class="form-control mt-1 inputfield" id="nextdate"
                                    value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d"); ?>"
                                        name="nextdate" autofocus required>
                                </div>


                                <div class=" col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks</label><br>
                                    <textarea class="form-control mt-1 inputfield" id="Followupremarks" name="remarks" placeholder="Enter Remark"
                                        autofocus></textarea>
                                </div>
                            </div>
                            <div class="mb-0">

                            </div>

                            <div class=" text-end mt-3">
                                <button type="button" class="btn  fa fa-refresh" onclick=resetFollowupForm()
                                    style="color: lightblue;"></button>
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        {{-- --------------------------Show the Followuphistory---------------------------- --}}

        <div class="modal fade addUpdateModal" id="HistoryModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Follow-Up History</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Enquiry AddForm" id="Feed_back_followup" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" id="enquiry_id" name="enquiry_id">
                                <input type="hidden" id="assigned_staff_id" name="assigned_staff_id">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Follow-up Date</th>
                                            <th>Feedback</th>
                                            <th>Remark</th>
                                            <th>Staff</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="text-end mt-3">
                                <button type="button" class="btn savebtn px-5" data-bs-dismiss="modal"
                                    aria-label="Close">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="container-fluid px-4 ">
                    <h4 class="mt-0 d-flex justify-content-center py-1 contitle">Follow Up</h4>
                </div>

                <div class="admintoolbar">
                    <div class="card1 card-body">

                        <div class="row">


                            <div class="col-lg-2 col-6 mt-3">
                                <select class="form-select CourseDrop" onchange="searchEnquiries()"
                                    aria-label="Default select example name" id="course" name="course">



                                    <option class="inputlabel" value="0"> Select Course</option>
                                    @foreach ($course as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">
                                            {{ $key->course_name }}
                                        </option>
                                    @endforeach
                                </select>



                            </div>
                            <div class="col-lg-2 col-6 mt-3">
                                <select class="form-select" id="lead">
                                    <option value="0">Select Datatype</option>
                                    <option value="LD">LEAD DATA</option>
                                    <option value="ED">ENQUIRY DATA</option>
                                </select>
                            </div>

                            <div class="col-lg-2 col-6 mt-3">
                                <select id="branch" class="form-select branchDrop" name="Branch"
                                    onchange="searchEnquiries()">
                                    <option value="0">Select Branch</option>
                                    @foreach ($branch as $item)
                                        <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-lg-2 col-6 mt-3">

                                <select class="form-select assigndrop staffDrop " id="assign_to" name="AssignTo"
                                    onchange="searchEnquiries()">
                                    <option value="">Select Staff</option>
                                    @foreach ($staffs as $staff)
                                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="col-lg-2 col-6 mt-3">
                                <input type="date" class="form-control" id="currentDate"
                                    onchange="searchEnquiries()">
                            </div>
                            <div class="col-lg-2 col-6 mt-3">
                                <select class="form-select  branchDrop" aria-label="Default select example name"
                                    id="enquirytype" name="enquirytype" onchange="searchEnquiries()">
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
                                <input type="text" class="form-control text-center" id="SearchBar"
                                    placeholder="Search" onchange="searchEnquiries()">
                            </div>


                            <div class="col-lg-2 col-6 mt-3">


                                <button type="button" class="btn AddBtn w-100"
                                    onclick="searchEnquiries()">Search</button>


                            </div>
                            <div class="col-lg-2 col-6 mt-3 ">
                                <button id="search-button" type="button" class="btn serachBtn search-button"
                                    onclick="resetSearch()">
                                    <i class="bi bi-arrow-clockwise"></i> &nbsp;Reset
                                </button>
                            </div>

                            <div class="d-flex justify-content-end">

                                <button class="btn btn-link" id="search-results-card">
                                    <i class="ri-file-list-2-line ms-2 fs-4"></i>
                                </button>

                                <button class="btn btn-link" id="search-results-table">
                                    <i class="bi-grid-3x3"></i>

                                </button>

                            </div>


                        </div>


                    </div>
                </div>

                <div class="row m-integrations__results">
                    <div id="search-results-table-container" style="display: none;">

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
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div id="search-results-card-container">
                        <div class="row m-integrations__results">


                        </div>
                    </div>



                </div>
            </div>

            <div class="adminActions">
                <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    <a class="adminButton"><i class="bi bi-search"></i></a></button>

            </div>
        </div>








    </main><!-- End #main -->

    @include('layouts.footer')
    <script>

const myOffcanvas = document.getElementById('searchTermInOffcanvas')
myOffcanvas.addEventListener('hidden.bs.offcanvas', event => {
  
})
        $('.SearchAndSelect').selectize();
        

        $('#branch').on('change', function() {
            var branchId = $(this).val();
            console.log(branchId);
            loadStaff(branchId);
            loadGroup(branchId);
        });

        $(document).on('change', '#searchTermInOffcanvas', function() {
            var selectedId = $(this).val();
            console.log(selectedId);
            var settings = {
                "url": "/api/followupedit/" + selectedId + "",
                "method": "GET",
                "timeout": 0,
            };
            $.ajax(settings).done(function(response) {
                console.log(response);
                $('#UpdateFeed_back')[0].reset();
                if (response.success == true) {
                    FollowUpDetails = response.enquirytype;
                    $("#Update_enquiry_id").val(FollowUpDetails.enquiry_id);
                    $("#Update_assigned_staff_id").val(FollowUpDetails.staff_id);
                    $("#update_feedback_id").val(FollowUpDetails.id);
                    $("#update_feedback_name").val(FollowUpDetails.feedback_id);
                    $("#update_nextdate").val(FollowUpDetails.followup);
                    $("#update_remarks").val(FollowUpDetails.remarks);
                    $('#formContainer').show();
                } else {
                    $('#formContainer').hide();
                    toastr.error('No followups found for this enquiry');
                }
            });

        });

        function loadStaff(branchId) {
            if (branchId) {
                $.ajax({
                    url: '/api/branch-wiseStaff/' + branchId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $enqTakenBy = $('#assign_to');
                        console.log(data);
                        $enqTakenBy.empty();
                        $enqTakenBy.append('<option class="inputlabel" hidden value="0">Select Staff</option>');
                        $.each(data, function(key, value) {
                            $enqTakenBy.append('<option value="' + value.id + '">' + value.name +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#assign_to').empty();
                $('#assign_to').append('<option value="">Select Staff</option>');
            }
        }

        function searchEnquiries() {
            // Get the selected values from the form
            var selectedCourse = document.getElementById("course").value;
            var selectedEnquiryType = document.getElementById("enquirytype").value;
            var selectedLead = document.getElementById("lead").value;
            var selectedBranch = document.getElementById("branch").value;
            var selectedStaff = document.getElementById("assign_to").value;
            var selectedDate = document.getElementById("currentDate").value;
            var searchTerm = document.getElementById("SearchBar").value;

            var settings = {
                "url": "/api/followup/search-enquiries",
                "method": "POST",
                "timeout": 0,
                "data": {
                    "selectedCourse": selectedCourse,
                    "selectedEnquiryType": selectedEnquiryType,
                    "selectedLead": selectedLead,
                    "selectedBranch": selectedBranch,
                    "selectedStaff": selectedStaff,
                    "selectedDate": selectedDate,
                    "searchTerm": searchTerm
                }
            };
            // Make the API request
            fetch(settings.url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(settings.data)
                })
                .then(response => response.json())
                .then(data => {
                    // Process the search results
                    console.log(data);
                    // Update your UI with the search results
                    updateSearchResults(data);
                })
                .catch(error => {
                    console.error(error);
                });
        }







        //Add Followup

        $('#Feed_back').validate({
            rules: {
                FeedbackName: {
                    required: true,
                },
                nextdate: {
                    required: true,
                }
            },
            messages: {
                FeedbackName: {
                    required: "Please enter Feedback Name",
                },
                nextdate: {
                    required: "Please select a Date",
                }
            },
            submitHandler: function(form) {
                var feedbackName = $('#feedback_name').val();
                var feedbackRemark = $('#Followupremarks').val();
                var Nextfollowupdate = $('#nextdate').val();
                var enquiryId = $('#enquiry_id').val();
                var staffId = $('#assigned_staff_id').val();

                $.ajax({
                    url: "/api/submit-feedback",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        nextdate: Nextfollowupdate,
                        FeedbackName: feedbackName,
                        Remarks: feedbackRemark,
                        enquiry_id: enquiryId,
                        staff_id: staffId
                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('#FeedbackModel').modal('hide');
                        $('.mainContents').hide();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    console.log(response);
                    var EnResult = JSON.stringify(response);
                    console.log(EnResult);
                    var EnResultObj = JSON.parse(EnResult);
                    if (EnResultObj.success == true) {
                        if (EnResultObj.code == "0") {
                            swal("Warning", response.message, "warning");
                        } else if (EnResultObj.code == "1") {
                            swal("Success", response.message, "success");
                        } else if (EnResultObj.code == "2") {
                            swal("Error", response.message, "error");
                        }
                    } else {
                        swal("Some Error Occured!!!", "Please Try Again", "error");
                    }
                });
            }
        });





        // ------------------End addfollowup-----------------------

        const followupOptions = document.getElementsByName('followup_option');
        const nextDateInput = document.getElementById('nextdate');

        // Add an event listener to the followup radio buttons
        followupOptions.forEach((option) => {
            option.addEventListener('change', function() {
                // Get the selected followup value
                const selectedFollowup = parseInt(this.value);
                // Get the current date
                const currentDate = new Date();
                // Set the next date based on the selected followup
                const nextDate = new Date();

                if (selectedFollowup === 1) {
                    // Tomorrow
                    nextDate.setDate(currentDate.getDate() + 1);
                } else if (selectedFollowup === 2) {
                    // After 2 days
                    nextDate.setDate(currentDate.getDate() + 2);
                } else if (selectedFollowup === 3) {
                    // After 5 days
                    nextDate.setDate(currentDate.getDate() + 5);
                } else if (selectedFollowup === 4) {
                    // Next week
                    nextDate.setDate(currentDate.getDate() + 7);
                } else if (selectedFollowup === 5) {
                    // Next month
                    nextDate.setMonth(currentDate.getMonth() + 1);
                }

                // Format the next date as YYYY-MM-DD
                const formattedNextDate = nextDate.toISOString().split('T')[0];
                // Set the value of the nextdate input field
                nextDateInput.value = formattedNextDate;
            });
        });
        // -------------------------------End--------------------------------
        const followupOptionsInOffcanvas = document.getElementsByName('followup_optionInOffcanvas');
        const nextDateInputInOffcanvas = document.getElementById('update_nextdate');

        // Add an event listener to the followup radio buttons
        followupOptionsInOffcanvas.forEach((option) => {
            option.addEventListener('change', function() {
                // Get the selected followup value
                const selectedFollowup1 = parseInt(this.value);
                // Get the current date
                const currentDate1 = new Date();
                // Set the next date based on the selected followup
                const nextDate1 = new Date();

                if (selectedFollowup1 === 1) {
                    // Tomorrow
                    nextDate1.setDate(currentDate1.getDate() + 1);
                } else if (selectedFollowup1 === 2) {
                    // After 2 days
                    nextDate1.setDate(currentDate1.getDate() + 2);
                } else if (selectedFollowup1 === 3) {
                    // After 5 days
                    nextDate1.setDate(currentDate1.getDate() + 5);
                } else if (selectedFollowup1 === 4) {
                    // Next week
                    nextDate1.setDate(currentDate1.getDate() + 7);
                } else if (selectedFollowup1 === 5) {
                    // Next month
                    nextDate1.setMonth(currentDate1.getMonth() + 1);
                }

                // Format the next date as YYYY-MM-DD
                const formattedNextDateInOffcanvas = nextDate1.toISOString().split('T')[0];
                // Set the value of the nextdate input field
                nextDateInputInOffcanvas.value = formattedNextDateInOffcanvas;
            });
        });

        // Get the current date
        var currentDate1 = new Date().toISOString().split('T')[0];

        // Set the current date as the value of the date input field
        $('#update_nextdate').val(currentDate1);




        // // Get the current date
        // var currentDate = new Date().toISOString().split('T')[0];

        // // Set the current date as the value of the date input field
        // $('#nextdate').val(currentDate);

        //hide the next followup 
        const feedbackDropdown = document.getElementById('feedback_name');
        // Get the next_followup_in and next_followup_date elements
        const nextFollowupIn = document.getElementById('next_followup_in');
        const nextFollowupDate = document.getElementById('next_followup_date');

        // Add an event listener to the feedback dropdown
        feedbackDropdown.addEventListener('change', function() {
            // Get the selected feedback ID
            const selectedFeedbackId = parseInt(feedbackDropdown.value);
            // Check if the selected feedback ID is 1 or 2
            if (selectedFeedbackId === 1 || selectedFeedbackId === 2) {
                // Hide the next_followup_in and next_followup_date elements
                nextFollowupIn.setAttribute('hidden', 'hidden');
                nextFollowupDate.setAttribute('hidden', 'hidden');
            } else {
                // Show the next_followup_in and next_followup_date elements
                nextFollowupIn.removeAttribute('hidden');
                nextFollowupDate.removeAttribute('hidden');
            }
        });



        //hide the next followup IN OFFCANVAS
        const feedbackDropdownInOffcanvas = document.getElementById('update_feedback_name');
        // Get the next_followup_in and next_followup_date elements
        const nextFollowupInOffcanvas = document.getElementById('next_followup_inOffcanvas');
        const nextFollowupDateInOffcanvas = document.getElementById('next_followup_dateInOffcanvas');

        // Add an event listener to the feedback dropdown
        feedbackDropdownInOffcanvas.addEventListener('change', function() {
            // Get the selected feedback ID
            const selectedFeedbackIdInOffcanvas = parseInt(feedbackDropdownInOffcanvas.value);
            // Check if the selected feedback ID is 1 or 2
            if (selectedFeedbackIdInOffcanvas === 1 || selectedFeedbackIdInOffcanvas === 2) {
                // Hide the next_followup_in and next_followup_date elements
                nextFollowupInOffcanvas.setAttribute('hidden', 'hidden');
                nextFollowupDateInOffcanvas.setAttribute('hidden', 'hidden');
            } else {
                // Show the next_followup_in and next_followup_date elements
                nextFollowupInOffcanvas.removeAttribute('hidden');
                nextFollowupDateInOffcanvas.removeAttribute('hidden');
            }
        });






        // Add an event listener to the "Table" button
        document.getElementById("search-results-table").addEventListener("click", function() {
            document.getElementById("search-results-table-container").style.display = "block";
            document.getElementById("search-results-card-container").style.display = "none";
        });

        // Add an event listener to the "Card" button
        document.getElementById("search-results-card").addEventListener("click", function() {
            document.getElementById("search-results-table-container").style.display = "none";
            document.getElementById("search-results-card-container").style.display = "block";
        });
        var currentDate = new Date();

        // Format the date as YYYY-MM-DD
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);
        var formattedDate = year + '-' + month + '-' + day;

        // Set the value of the date input field to the current date
        document.getElementById("currentDate").value = formattedDate;
        $(function() {
            // tooltip
            function onHoverToggleTooltip(e) {
                var $this = $(this),
                    title = $this.attr('title'),
                    type = e.type,
                    offset = $this.offset(),
                    xOffset = e.pageX - offset.left + 10,
                    yOffset = e.pageY - offset.top + 30;

                if (type == 'mouseenter') {
                    $this.data('tipText', title).removeAttr('title');
                    $this.append('<span class="title">' + title + '</span>').hide().fadeIn(250);
                    $this.find('.title')
                        .css('top', (yOffset) + 'px')
                        .css('left', (xOffset) + 'px');
                } else if (type == 'mouseleave') {
                    $this.attr('title', $this.data('tipText'));
                    $this.find('.title').fadeOut().remove();
                } else if (type == 'mousemove') {
                    $this.find('.title')
                        .css('top', (yOffset) + 'px')
                        .css('left', (xOffset) + 'px');
                }

            }

            $(document.querySelectorAll('.tooltip')).on({
                mouseenter: onHoverToggleTooltip,
                mouseleave: onHoverToggleTooltip,
                mousemove: onHoverToggleTooltip
            });

        });





        //append to table and card
        function updateSearchResults(data) {
            // Clear the existing results
            $('#search-results-card-container').empty();
            $('#search-results-table-container tbody').empty();

            if (data.length > 0) {


                // Display the results in card view
                var rowHtmlCard = '<div class="row m-integrations__results">';
                // Create the table rows
                var tableRowsHtml = '';

                data.forEach(function(result, index) {

                    var cardColor = result.next_folow_up ? '' :
                        'style="background-color: #f8f2e1;"';
                    var cardHtml = '<div class="col-lg-3 col-md-6 col-12">' +
                        '<div class="card followup" ' + cardColor + '>' +
                        '<div class="card-text d-flex justify-content-end">' +
                        '<a href="tel:' + result.mob_no +
                        '" class="tooltip-custom CallButton" data-call-enquiry-id="' + result.id + '"' +
                        'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Call">' +
                        '<img class="followupfooterimg" ' +
                        'src="{{ asset('assets/img/phonecall.png') }}" ' +
                        'style="width:30px; height:30px;">' +
                        '</a>' +
                        '</div>' +
                        '<div class="card-body">' +
                        '<p class="card-text">Name: ' + result.name + '</p>' +
                        '<p class="card-text">Mobile: ' + result.mob_no + '</p>' +
                        '<p class="card-text">Course: ' + result.course_name + '</p>' +
                        '<p class="card-text">Enquiry Source: ' + result.EnqName + '</p>' +
                        '<p class="card-text">Feedback: ' + (result.FEED !== null ? result.FEED : '') + '</p>' +
                        '<hr>' +
                        '<div class="d-flex justify-content-between">' +
                        '<a data-bs-toggle="modal" data-bs-target="#FeedbackModel" onclick="setFeedbackModalData(' +
                        result.id + ', ' + result.Assignedto + ')">' +
                        '<img class="followupfooterimg" src="{{ asset('assets/img/feedback (1).png') }}" style="width:20px; height:20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Feedback">' +
                        '</a>' +
                        '<a class="ViewHistory" data-enquiry="' + result.id +
                        '" data-bs-toggle="modal" data-bs-target="#HistoryModal">' +
                        '<img class="followupfooterimg" src="{{ asset('assets/img/clock.png') }}" ' +
                        'style="width:20px; height:20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Feedback History">' +
                        '</a>';

                    if (result.leaddata === 'LD') {
                        cardHtml += '<a href="{{ url('/enquiryedit/') }}/' + result.id + '">' +
                            '<img class="followupfooterimg" ' +
                            'src="{{ asset('assets/img/data-transfer (1).png') }}" ' +
                            'style="width:20px; height:20px;" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Data Convert">' +
                            '</a>';
                    } else {
                        cardHtml += '<a href="{{ url('/admission/') }}/' + result.id + '">' +
                            '<img class="followupfooterimg" ' +
                            'src="{{ asset('assets/images/coursetype.png') }}" ' +
                            'style="width:20px; height:20px;" ' +
                            'data-bs-toggle="tooltip" data-bs-placement="bottom" title="Data Convert">' +
                            '</a>';
                    }

                    cardHtml += '<a href="tel:' + result.mob_no +
                        '" class="tooltip-custom followupfooterimg " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Message"><i class="bi bi-chat-quote-fill"></i></a>' +
                        '<a href="https://wa.me/91' + result.mob_no +
                        '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Whatsapp" class="tooltip-custom followupfooterimg" style="color:green"><i class="bi bi-whatsapp"></i></a>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    rowHtmlCard += cardHtml;

                    // Create the table row
                    var tableRowHtml = '<tr>' +
                        '<td class="text-center">' + (index + 1) + '</td>' +
                        '<td class="text-center">' + (result.enq_date ? result.enq_date : '') + '</td>' +
                        '<td class="text-center">' + result.name + '</td>' +
                        '<td class="text-center">' + result.mob_no + '</td>' +
                        '<td class="text-center">' + (result.course_name ? result.course_name : '') + '</td>' +
                        '<td class="text-center">' + result.EnqName + '</td>' +
                        '<td class="text-center"><a class="ViewHistory"  data-enquiry="' + result.id +
                        '" data-bs-toggle="modal" data-bs-target="#HistoryModal"><img class="followupfooterimg" src="{{ asset('assets/img/clock.png') }}" style="width:20px; height:20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Feedback History"></a></td>' +
                        '<td class="text-center"><a data-bs-toggle="modal" data-bs-target="#FeedbackModel" onclick="setFeedbackModalData(' +
                        result.id + ', ' + result.Assignedto +
                        ')"> <img class="followupfooterimg" src="{{ asset('assets/img/feedback (1).png') }}" style="width:20px; height:20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Feedback"></a></td>' +
                        '<td class="text-center"><a href="tel:' + result.mob_no +
                        '" class="tooltip-custom CallButton"  data-call-enquiry-id="' + result.id +
                        '" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Call"><img class="followupfooterimg" src="{{ asset('assets/img/phonecall.png') }}" style="width:30px; height:30px;"></a></td>' +
                        '<td class="text-center"><a href="tel:' + result.mob_no +
                        '" class="tooltip-custom followupfooterimg " data-bs-toggle="tooltip" data-bs-placement="bottom" title="Message"><i class="bi bi-chat-quote-fill"></i></a></td>' +
                        '<td class="text-center"><a href="https://wa.me/91' + result.mob_no +
                        '"data-bs-toggle="tooltip" data-bs-placement="bottom" title="Whatsapp" class="tooltip-custom followupfooterimg " style="color:green"><i class="bi bi-whatsapp"></i></a></td>';

                    if (result.leaddata === 'LD') {
                        tableRowHtml += '<td class="text-center"><a href="{{ url('/enquiryedit/') }}/' + result
                            .id +
                            '"><img class="followupfooterimg" src="{{ asset('assets/img/data-transfer (1).png') }}" style="width:20px; height:20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Data Convert"></a></td>';
                    } else {
                        tableRowHtml += '<td class="text-center"><a href="{{ url('/admission/') }}/' + result
                            .id +
                            '"><img class="followupfooterimg" src="{{ asset('assets/images/coursetype.png') }}" style="width:20px; height:20px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Data Convert"></a></td>';
                    }

                    tableRowHtml += '</tr>';

                    tableRowsHtml += tableRowHtml;
                });

                rowHtmlCard += '</div>';
                $('#search-results-card-container').append(rowHtmlCard);

                // Append the table rows to the table body
                $('#search-results-table-container tbody').append(tableRowsHtml);
            }
        }

        // Function to fetch staff details
        function getStaffDetails(staffId) {
            return $.ajax({
                url: "/api/staffName/" + staffId,
                method: "GET",
                headers: {
                    "Accept": "application/json"
                }
            });
        }

        // Function to fetch feedback details
        function getFeedbackDetails(feedbackId) {
            return $.ajax({
                url: "/api/feedbacks/" + feedbackId,
                method: "GET",
                headers: {
                    "Accept": "application/json"
                }
            });
        }
        // Function to set the data in the HistoryModal and make the Ajax request for follow-up history
        $(document).on('click', '.ViewHistory', function() {
            var resultId = $(this).data('enquiry');
            console.log(resultId);
            $.ajax({
                url: "/api/followup/history/" + resultId,
                type: 'GET',
                success: function(response) {
                    console.log(response);

                    // Assuming the response is an array of follow-up history objects
                    var followUpHistory = response;
                    console.log(response);

                    // Clear the existing table body
                    $('#Feed_back_followup tbody').empty();

                    // Iterate through the follow-up history and append rows to the table
                    followUpHistory.forEach(function(history) {
                        var FollwUpRemarks = history.remarks !== null ? history.remarks : '';
                        var row = '<tr>' +
                            '<td>' + history.followup + '</td>' +
                            '<td>' + history.feedback_name + '</td>' +
                            '<td>' + FollwUpRemarks + '</td>' +
                            '<td>' + history.staff_name + '</td>' +
                            '</tr>';

                        $('#Feed_back_followup tbody').append(row);
                    });


                },
                error: function(xhr) {
                    // Handle the error
                    console.log(xhr.responseText);
                }
            });
        });

        function setFeedbackModalData(enquiryId, assignedStaffId) {
            $('#enquiry_id').val(enquiryId);
            $('#assigned_staff_id').val(assignedStaffId);
        }

        function setFeedbackHistoryModalData(enquiryId) {
            $('#enquiry_id').val(enquiryId);

        }


        function resetSearch() {
            document.getElementById("course").value = "0";
            document.getElementById("lead").value = "0";
            document.getElementById("branch").value = "0";
            document.getElementById("assign_to").value = "";
            document.getElementById("nextdate").value = "";
            document.getElementById("SearchBar").value = "";
            $('#search-results-card-container').empty();
            $('#search-results-table-container tbody').empty();

        }

        // Open feedback on clicking call button
        $(document).on('click', '.CallButton', function() {
            console.log($(this).data('call-enquiry-id'));
            $('#enquiry_id').val($(this).data('call-enquiry-id'));
            $('#FeedbackModel').modal('show');
        });

        // Function to reset the form
        function resetFollowupForm() {
            // Clear the form values
            $('#feedback_name').val('');
            $('input[name="followup_option"]').prop('checked', false);
            $('#remarks').val('');
        }

        // Wire the resetForm function to the refresh button click event
        $('.fa-refresh').on('click', function() {
            resetFollowupForm();
        });
        //modal close function
        $(".addUpdateModal").on("hidden.bs.modal", function() {
            $(".AddForm")[0].reset();
        });


        $('#UpdateFeed_back').validate({
            rules: {
                FeedbackName: {
                    required: true,
                },
                nextdate: {
                    required: true,
                }
            },
            messages: {
                FeedbackName: {
                    required: "Please enter Feedback Name",
                },
                nextdate: {
                    required: "Please select a Date",
                }
            },
            submitHandler: function(form) {
                var UpdateEnquiryId = $('#Update_enquiry_id').val();
                var UpdateFeedbackId = $('#update_feedback_id').val();
                var feedbackName = $('#update_feedback_name').val();
                var feedbackRemarks = $('#update_remarks').val();
                var Nextfollowupdate = $('#update_nextdate').val();
                var UpdateStaffId = $('#Update_assigned_staff_id').val();
               

                $.ajax({
                    "url": "/api/followupupdate/" + UpdateEnquiryId,
                    "method": "PUT",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    "data": {

                        "FeedbackName": feedbackName,
                        "NextFollowup": Nextfollowupdate,
                        "feedback_id": UpdateFeedbackId,
                        "UpdateRemarks": feedbackRemarks,
                        "Staff_id": UpdateStaffId
                    },
                    beforeSend: function() {
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    console.log(response);
                    var EnResult = JSON.stringify(response);
                    console.log(EnResult);
                    var EnResultObj = JSON.parse(EnResult);
                    if (EnResultObj.success == true) {
                        if (EnResultObj.code == "0") {
                            swal("Warning", response.message, "warning");
                        } else if (EnResultObj.code == "1") {
                            swal("Success", response.message, "success");
                            $('.SearchAndSelect')[0].selectize.clear();
                            $('#UpdateFeed_back')[0].reset();
                            $('#formContainer').hide();
                        } else if (EnResultObj.code == "2") {
                            swal("Error", response.message, "error");
                        }
                    } else {
                        swal("Some Error Occured!!!", "Please Try Again", "error");
                    }
                });
            }
        });


        //Search And Select
    </script>

</body>


</html>
