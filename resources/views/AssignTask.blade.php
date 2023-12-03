<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')


    @livewireStyles
</head>

<body>

    <!-- ======= Header ======= -->

    <header id="header" class="header fixed-top d-flex align-items-center">
        @include('layouts.navbar')
    </header>

    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <aside id="sidebar" class="sidebar ps-0">
        @include('layouts.sidebar')
    </aside>

    <!-- End Sidebar-->

    <main id="main" class="main">



        <div class="modal fade addUpdateModal" id="checklistModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Task Checklist</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="checklisttask_id" name="taskId">
                        <ul id="checklistItems"></ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this Assigned Task ?</h4>
                        <div class="text-center mt-3">
                            <button type="button" id="confirmYes" class="btn btn-primary me-5">Yes</button>
                            <button type="button" id="confirmNo" class="btn btn-secondary ms-5"
                                data-bs-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Response Modal -->
        <div class="modal fade ResponseModal" id="ResponseModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-3 py-5">
                        <div class="text-center mb-4" id="ResponseImage">

                        </div>
                        <h4 id="ResponseText" class="text-center mb-3"></h4>
                        <div class="text-center">
                            <button type="button" id="btnConfirm" style="display: none;"
                                class="btn btn_save mt-4 px-5 py-2" data-bs-dismiss="modal">Proceed</button>
                            <button type="button" id="btnClose" class="btn btn_save responsebtn mt-4 px-5 py-2"
                                data-bs-dismiss="modal">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <h4 class=" d-flex justify-content-center py-1 contitle">Add Tasks</h4>
        </div>
        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-12">
                        <div class="card card-body main_card mt-2  p-3 mb-2">
                            <form class="AssignTask AddForm" id="assign_task">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div id="taskCard">
                                        <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label class="mt-2 mb-1 inputlabel">Branch<span
                                                            style="color:red; font-size:15px">
                                                            *</span></label><br>
                                                </div>
                                                <div class="col-6">
                                                    <select class="form-select inputfield"
                                                        aria-label="Default select example name" id="branch"
                                                        name="branch_id" required>
                                                        <option class="inputlabel" hidden value="0">Select Branch
                                                        </option>
                                                        @foreach ($branch as $item)
                                                            <option value="{{ $item->id }}">{{ $item->branch_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label class="mt-2 mb-1 inputlabel">Assign To<span
                                                            style="color:red; font-size:15px">
                                                            *</span></label><br>
                                                </div>
                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <select class="form-select inputfield "
                                                                aria-label="Default select example name"
                                                                id="Assignto" name="assignTo" required>
                                                                <option class="inputlabel" hidden value="0">
                                                                    Assign To
                                                                </option>
                                                                @foreach ($staffs as $staff)
                                                                    <option value="{{ $staff->id }}">
                                                                        {{ $staff->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-2">

                                                            <button class="btn savebtn  btn-primary getpendingTask"
                                                                type="button" data-bs-toggle="offcanvas"
                                                                data-bs-target="#offcanvasExample"
                                                                aria-controls="offcanvasExample"><i
                                                                    class="bi bi-alarm-fill"></i></button>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label class="mt-2 mb-1 inputlabel">Date<span
                                                            style="color:red; font-size:15px">
                                                            *</span></label><br>
                                                </div>
                                                <div class="col-6">
                                                    <input type="date" class="form-control mt-1 inputfield"
                                                        id="date" name="date" autofocus required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label class="mt-2 mb-1 inputlabel">Webpage/SheetLink</label><br>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control mt-1 inputfield"
                                                        id="link" name="link" autofocus required>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label class="mt-2 mb-1 inputlabel">Observer</label><br>
                                                </div>
                                                <div class="col-6">
                                                    <select class="inputfield Viewgroupselect multiselect" multiple
                                                        id="show_members" name="Members" required>
                                                        <option hidden value=""> Select Team</option>
                                                        @foreach ($ObserverParticipant as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-6">
                                                    <label class="mt-2 mb-1 inputlabel">Participants</label><br>
                                                </div>
                                                <div class="col-6">
                                                    <select class="inputfield Viewgroupselect multiselect" multiple
                                                        id="show_memberss" name="Members" required>
                                                        <option hidden value=""> Select Team</option>
                                                        @foreach ($ObserverParticipant as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-5 d-md-flex d-none justify-content-center">
                                            <img class="mt-4" src="{{ url('assets/images/assigntaskavathar.png') }}"
                                                style="width:200px; height:150px;">
                                        </div> --}}
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-xl-6 col-lg-4 col-md-6 col-12">
                                            <label class="mt-2 mb-1 inputlabel">Task<span
                                                    style="color:red; font-size:15px">
                                                    *</span></label> <i class="bi bi-clipboard-plus-fill ml-auto"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal"></i><br>
                                            <select class="form-select inputfield"
                                                aria-label="Default select example name" id="select_task"
                                                name="task_id[]" required>
                                                <option class="inputlabel" hidden value="0"> Select Task</option>
                                                @foreach ($Task as $tasks)
                                                    <option class="inputlabel" value="{{ $tasks->id }}">
                                                        {{ $tasks->task_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" col-xl-3 col-lg-2 col-md-3 col-6">
                                            <label class="mt-2 mb-1 inputlabel">Starting Time<span
                                                    style="color:red; font-size:15px">
                                                    *</span></label><br>
                                            <input type="datetime-local" class="form-control mt-1 inputfield"
                                                id="start_time" name="start_time[]" autofocus required>
                                        </div>
                                        <div class="col-xl-3 col-lg-2 col-md-3 col-6">
                                            <label class="mt-2 mb-1 inputlabel">Ending Time<span
                                                    style="color:red; font-size:15px">
                                                    *</span></label><br>
                                            <input type="datetime-local" class="form-control mt-1 inputfield" id="end_time"
                                                name="end_time[]" autofocus required>
                                        </div>
                                        {{-- <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                            <label class="mt-2 mb-1 inputlabel">Upload File</label><br>
                                            <input type="file" class="form-control mt-1 inputfield" id="file"
                                                name="file[]" autofocus>
                                        </div> --}}


                                    </div>
                                    <div class="row mt-2">
                                        <label class="mt-2 mb-1 inputlabel">Remark</label><br>
                                    </div>
                                    <div class="col-12  mt-2">
                                        <textarea cols="30" rows="2" class="form-control mt-1 inputfield" id="remarks" name="Remarks"
                                            placeholder="Enter Remarks"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-center mt-2">

                                        <button type="button" class="btn savebtn mt-4" onclick="addTasks()">
                                            Add Task
                                        </button>
                                    </div>


                                </div>
                        </div>
                        <div class="card card-body main_card mt-2  p-3 mb-2">


                            <div class="row" id="taskCardContainer">


                            </div>






                            <div class="col-12 text-center">
                                <button type="submit" class="btn savebtn px-5 py-2 mt-4 fs-5"
                                    onclick="SubmitTask()"><b>Save</b></button>
                            </div>





                            </form>

                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-12">
                        <div class="card card-body main_card mt-2  p-3 mb-2">
                            <section>
                                <h5 class="text-center">Observers</h5>
                                <hr>
                                </hr>
                                <ul id="observers_list" class="list-unstyled observers_list">

                                </ul>


                            </section>
                            <section>
                                <h5 class="text-center">Participants</h5>
                                <hr>

                                <ul id="participants_list" class="list-unstyled  participants_list">

                                </ul>

                            </section>
                        </div>
                    </div>

                </div>
            </div>


            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                  <h5 class="offcanvas-title" id="offcanvasExampleLabel">Pending Works</h5>
                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="table-responsive">
                        <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                            <thead class=" tablehead">
                                <tr>

                                    <th class="text-center">Task Name</th>
                                    <th class="text-center">Assigned Date</th>
                                    <th class="text-center">Assigned StartTime</th>
                                    <th class="text-center">Assigned EndTime</th>
                                </tr>
                            </thead>
                            <tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

        </div>
        <div class="loader">
            <div class="">
                <img class="img-fluid" src="{{ url('assets/images/loading.gif') }}">
                <h4 class="text-center">LOADING</h4>
            </div>
        </div>
    </main><!-- End #main -->

    @include('layouts.footer')
    <script>
        // Initialize an empty array to store the added tasks
        let tasks = [];

        function addTaskToCard() {

            $('#taskCardContainer').empty();

            event.preventDefault();
            for (var i = 0; i < tasks.length; i++) {
                var task = tasks[i];

                const cardHtml = ` 
                <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1" data-task-id="${task.id}">
                <div class="taskcard">
                    <div class="p-2">
                        <h6 class="Taskname"><b>${task.taskName}</b></h6> 
                        <h6 class="Taskname">${task.Remarks}</h6> 
                        
                    </div>
                    <p class="ms-2 tasktime mb-1"  data-start-time="${task.startTime}" data-end-time="${task.endTime}">${task.startTime} - ${task.endTime}</p>
                    <hr class="my-0"></hr>
                    <div class="p-2 d-flex justify-content-between">
                    <i class="ri-eye-line ms-2 ViewChecklist" data-bs-toggle="modal" data-task-checklist="${task.taskId}" data-bs-target="#checklistModal"></i>
                    <i class="ri-delete-bin-6-line me-2" onclick="removeTask(${i})"></i>
                    </div>
                </div>
                </div>
            `;

                // Append the task card HTML to the container
                $('#taskCardContainer').append(cardHtml);
            }
        }

        function addTasks() {
            const taskName = $('#select_task option:selected').text(); // Get the selected task name
            const taskId = $('#select_task').val(); // Get the selected task ID
            const startTime = $('#start_time').val();
            const endTime = $('#end_time').val();
            const Remarks = $('#remarks').val();

            let ObserverArray = [];
                let ParticipantArray = [];

                $('.ObserverList').each(function() {
                    ObserverArray.push($(this).data('staff-id'));
                });

                $('.ParticipantList').each(function() {
                    ParticipantArray.push($(this).data('staff-id'));
                });

                console.log(ObserverArray, ParticipantArray);
           
            // Check if a task is selected
            if (taskId === '0') {
                toastr.error('Please select a task.');
                return;
            }

            // Check if start time is selected
            if (startTime === '') {
                toastr.error('Please select a start time.');
                return;
            }

            // Check if end time is selected
            if (endTime === '') {
                toastr.error('Please select an end time.');
                return;
            }
            
            // Add the task to the array
            tasks.push({
                taskId: taskId,
                taskName: taskName,
                startTime: startTime,
                endTime: endTime,
                Remarks: Remarks,
                observers: ObserverArray,
                participants: ParticipantArray
            });



            // Add the task to the card
            addTaskToCard();

            // Reset the form inputs
            $('#task').val('');
            $('#start_time').val('');
            $('#end_time').val('');
            $('#remarks').val('');
            


            console.log(tasks);
        }

        function removeTask(index) {
            // Remove the task from the array
            tasks.splice(index, 1);
            // Update the card display
            addTaskToCard();
            console.log(tasks);
        }


        // Function to load group members
        function loadGroupMembers(groupId, listId, ClassName) {
            if (groupId) {
                $.ajax({
                    url: '/api/getGroupMembers/' + groupId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var membersList = $('#' + listId);
                        console.log(data);

                        // Clear previous members
                        membersList.empty();

                        // Access the members array within data
                        var members = data.members;

                        $.each(members, function(key, member) {
                            var listItem = $('<li>');
                            listItem.addClass(ClassName);
                            var image = $('<img>').addClass('me-2').attr('src',
                                '{{ url('assets/images/two.png') }}').css({
                                'width': '30px',
                                'height': '25px'
                            });
                            var name = $('<span>').text(member.name);
                            listItem.attr('data-staff-id', member.id);
                            listItem.append(image);
                            listItem.append(name);
                            membersList.append(listItem);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Clear members list
                $('#' + listId).empty();
            }
        }




        $(document).on('click', '.ViewChecklist', function() {
            var resultId = $(this).data('task-checklist');
            console.log(resultId);
            $.ajax({
                "url": "/api/Addtask/showTaskChecklist/" + resultId,
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json"
                },
                success: function(response) {
                    console.log(response);
                    // Extract the checklist array from the response
                    var checklist = response.checklist;
                    $('#checklistItems').empty();
                    // Generate the HTML for the checklist items
                    var checklistHtml = '';
                    checklist.forEach(function(item) {
                        var checklistItem = item
                            .checklist; // Replace `name` with the appropriate property name
                        checklistHtml += `<li>${checklistItem}</li>`;
                    });

                    // Append the generated checklist items to the <ul> element
                    $('#checklistItems').html(checklistHtml);

                    // Show the modal
                    $('#checklistModal').modal('show');
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });


        // Reset the form fields
        function resetFormFields() {
            // Clear the form inputs
            $("#taskForm input").val("");
            $("#taskForm select").val("0");
            $("#show_members, #show_memberss").val("").trigger("change");

            // Clear the task rows except the first one
            $("#taskForm .row:not(:first)").remove();
        }

        // Handle the form submission on Save button click
        $("#saveButton").click(function(e) {
            e.preventDefault();
            addTasks();
        });

        // Add a new task row on Task selection
        $("#task").change(function() {
            var selectedTask = $(this).val();
            if (selectedTask !== "0") {
                var newTaskRow = `
                <div class="row mt-2">
                    <div class="col-6">
                        <label class="mt-2 mb-1 inputlabel">Task</label> <i class="bi bi-clipboard-plus-fill ml-auto" data-bs-toggle="modal" data-bs-target="#exampleModal"></i><br>
                        <select class="form-select inputfield" aria-label="Default select example name" name="task_id[]">
                            <option class="inputlabel" hidden value="0">Select Task</option>
                            @foreach ($Task as $tasks)
                                <option class="inputlabel" value="{{ $tasks->id }}">{{ $tasks->task_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-2">
                        <label class="mt-2 mb-1 inputlabel">Starting Time</label><br>
                        <input type="time" class="form-control mt-1 inputfield" name="start_time[]" autofocus>
                    </div>
                    <div class="col-2">
                        <label class="mt-2 mb-1 inputlabel">Ending Time</label><br>
                        <input type="time" class="form-control mt-1 inputfield" name="end_time[]" autofocus>
                    </div>
                    <div class="col-2">
                        <label class="mt-2 mb-1 inputlabel">Upload File</label><br>
                        <input type="file" class="form-control mt-1 inputfield" name="file[]" autofocus>
                    </div>
                </div>
            `;

                $(this).val("0"); // Reset the task selection
                $(this).closest(".row").after(newTaskRow);
            }
        });


        //Focus First Field
        $(document).ready(function() {
            $('#assign_task').on('shown.bs.modal', function() {
                $('#branch').focus();
            });
        });

        $(document).ready(function() {
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                console.log(branchId);
                loadStaff(branchId);
                loadGroup(branchId);
            });
        });

        function loadStaff(branchId) {
            if (branchId) {
                $.ajax({
                    url: '/api/branch-wiseStaff/' + branchId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $enqTakenBy = $('#Assignto');
                        console.log(data);
                        $enqTakenBy.empty();
                        $enqTakenBy.append('<option class="inputlabel" hidden value="0">Assign To</option>');
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
                $('#Assignto').empty();
                $('#Assignto').append('<option value="">Select Staff</option>');
            }
        }

        function loadGroup(branchId) {
            if (branchId) {
                $.ajax({
                    url: '/api/branch-wise-group/' + branchId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $showMembers = $('#show_members');
                        var $showMemberss = $('#show_memberss');

                        // Clear previous options
                        $showMembers[0].selectize.clearOptions();
                        $showMemberss[0].selectize.clearOptions();



                        // Add group options
                        $.each(data, function(key, value) {
                            $showMembers[0].selectize.addOption({
                                value: value.id,
                                text: value.name
                            });
                            $showMemberss[0].selectize.addOption({
                                value: value.id,
                                text: value.name
                            });
                        });

                        // Refresh the selectize control to display the updated options
                        $showMembers[0].selectize.refreshItems();
                        $showMemberss[0].selectize.refreshItems();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Clear options and reset the selectize control
                $('#show_members')[0].selectize.clearOptions();
                $('#show_memberss')[0].selectize.clearOptions();
                $('#show_members')[0].selectize.addItem('');
                $('#show_memberss')[0].selectize.addItem('');
            }
        }

        // Get the current date
        var currentDate = new Date().toISOString().split('T')[0];

        // Set the current date as the value of the date input field
        $('#date').val(currentDate);



        $(document).ready(function() {
            $('#show_members').selectize();
            $('#show_memberss').selectize();

            $('#show_members').on('change', function() {
                var selectedGroupIds = $(this).val();
                loadGroupMembers(selectedGroupIds, 'observers_list', 'ObserverList');
            });

            $('#show_memberss').on('change', function() {
                var selectedGroupIds = $(this).val();
                loadGroupMembers(selectedGroupIds, 'participants_list', 'ParticipantList');
            });
        });

        //Add the form 

        function SubmitTask() {
            event.preventDefault();

            // Check if all required fields are filled
            if (
                $('#branch').val() &&
                $('#date').val() &&
                $('#Assignto').val() 
                
            ) {
                let TaskArray = JSON.stringify(tasks);
                let branchId = $('#branch').val();
                let date = $('#date').val();
                let link = $('#link').val();
                let StaffId = $('#Assignto').val();

                

                $.ajax({
                    url: "/api/assign-task",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "branch_id": branchId,
                        "staff_id": StaffId,
                        "link": link,
                        "date": date,
                        "task": TaskArray
                    },
                    success: function(response) {
                        console.log(response);

                        var CoTypeUpdate = JSON.stringify(response);
                        console.log(CoTypeUpdate);

                        // Reset the form
                        $('#branch').val('');
                        $('#date').val('');
                        $('#link').val('');
                        $('#remarks').val('');
                        $('#Assignto').val('');
                        $('.ObserverList').remove();
                        $('.ParticipantList').remove();
                        $('#taskCardContainer').empty();
                       
                        var CoTypeUpdateed = JSON.parse(CoTypeUpdate);
                        if (CoTypeUpdateed.success == true) {

                            if (CoTypeUpdateed.code == "0") {
                                swal("Warning", response.message, "warning");
                            } else if (CoTypeUpdateed.code == "1") {
                                swal("Success", response.message, "success");
                            } else if (CoTypeUpdateed.code == "2") {
                                swal("Error", response.message, "error");
                            }
                        } else {
                            swal("Error", response.message, "error");
                        }
                    },
                });
            } else {
                // Display a message or toast indicating that all fields are required
                toastr.error('Please fill out all the required fields.');
            }
        }

        $('.getpendingTask').click(function() {
            var staffId = $('#Assignto').val();

            // AJAX request to fetch the staff's pending work details
            $.ajax({
                "url": "/api/getpendingtasks/" + staffId,
                "method": "GET",
                "timeout": 0,
                success: function(response) {

                    console.log(response);

                    // Clear previous table rows
                    $('#MasterTable tbody').empty();

                    // Iterate through the pending work details and populate the table
                    response.forEach(function(task) {
                        var row = '<tr>' +
                            '<td class="text-center" style="color:red">' + task.task_name +
                            '</td>' +
                            '<td class="text-center" style="color:red">' + task.date + '</td>' +
                            '<td class="text-center" style="color:red">' + task.starttime +
                            '</td>' +
                            '<td class="text-center" style="color:red">' + task.endtime +
                            '</td>' +
                            '</tr>';
                        $('#MasterTable tbody').append(row);
                    });

                    // Open the offcanvas
                    var offcanvas = new bootstrap.Offcanvas(document.getElementById(
                        'offcanvasExample'));
                    offcanvas.show();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });



    </script>




</body>

</html>
