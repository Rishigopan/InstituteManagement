<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')
    <style>
        .mainContents {
            display: none;
        }
    </style>
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
        <div class="container-fluid d-flex justify-content-between">
            <h4 class="p-2 mt-3"><b>My Tasks</b></h4>
            <div class="p-3">
                <a class="taskiconnav" href="{{ url('/viewtaskboard') }}"><i
                        class="ri-layout-grid-fill me-3 fs-4"></i></a>
                <a class="taskiconnav" href="{{ url('/viewtask') }}"></a>
            </div>
        </div>
        <div class="wrapper">
            <!--CONTENTS-->
            <div class="row d-flex justify-content-end">
                <div class="col-lg-2 col-6 mt-3">
                    <select id="branch" class="form-select branchDrop" name="Branch">
                        <option value="0">Select Branch</option>
                        @foreach ($branch as $item)
                            <option value="{{ $item->id }}">{{ $item->branch_name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-lg-2 col-6 mt-3">

                    <select class="form-select assigndrop staffDrop " id="assign_to" name="AssignTo">
                        <option value="">Select Staff</option>

                    </select>


                </div>
                <div class="col-lg-2 col-6 mt-3">

                    <select class="form-select assigndrop staffDrop " id="Status" name="status">
                        <option value="">Select Status</option>
                        @foreach ($Taskstatus as $taskStatus)
                            <option value="{{ $taskStatus->id }}">{{ $taskStatus->taskstatus }}</option>
                        @endforeach
                    </select>


                </div>
                <div class="col-lg-2 col-6 mt-3">
                    
                    <input type="datetime-local" class="form-control inputfield"
                        id="from_date" name="start_time[]" autofocus required>
                       
                </div>
                <div class="col-lg-1 col-6 mt-3">TO</div>
                <div class="col-lg-2 col-6 mt-3">
                    <input type="datetime-local" class="form-control inputfield" id="to_date"
                        name="end_time[]" autofocus required>
                </div>
                <div class="col-lg-1 col-6 mt-3">
                    <button type="button" id="searchButton" class="btn AddBtn w-99">Search</button>
                </div>
            </div>

            <div id="tableContainer">
                <div class="container-fluid mainContents">
                    <div class="card card-body main_card mt-2 p-3 mx-0 mb-2">
                        <div class="table-responsive"style="overflow-x: auto;">
                            <table class="table  MasterTable" id="MasterTable" style="width: 100%;">
                                <thead class=" tablehead">
                                    <tr>
                                        <th class="text-center">Sl No</th>
                                        <th class="text-center">Task Name</th>
                                        <th class="text-center">Checklist</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Assigned To</th>
                                        <th class="text-center">Start Time</th>
                                        <th class="text-center">End Time</th>
                                        <th class="text-center">Participants</th>
                                        <th class="text-center">Link</th>
                                        <th class="text-center">Task Status</th>
                                    </tr>
                                </thead>
                                <tbody id="taskTableBody">
                                    {{-- backend starts here --}}

                                </tbody>
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
    </main>
    @include('layouts.footer')
</body>

<script>
    $(document).ready(function() {
        var currentDate = new Date().toISOString().slice(0, 16).replace('T', ' ');
    $('#from_date').val(currentDate);
    $('#to_date').val(currentDate);
        $('#branch').on('change', function() {
            var branchId = $(this).val();
            loadStaff(branchId);
            console.log(moment());

        });


    });

    $('#searchButton').on('click', function() {

        searchTasks();
    });

    function loadStaff(branchId) {
        if (branchId) {
            $.ajax({
                url: '/api/branch-wiseStaff/' + branchId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var $enqTakenBy = $('#assign_to');
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

    function searchTasks() {
        var staffId = $('#assign_to').val();
        var statusId = $('#Status').val();
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        //console.log(staffId, statusId,from_date,to_date);

        $.ajax({
            url: '/api/filter-tasks',
            type: 'GET',
            data: {
                staffId: staffId,
                statusId: statusId,
                from_date: from_date,
                to_date: to_date
            },

            dataType: 'json',
            success: function(data) {
                console.log(data);
                ShowDataInTable(data);

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });

    }


    function ShowDataInTable(data) {
        var taskTableBody = $("#taskTableBody");
        taskTableBody.empty();
        data.forEach(function(assignedTask, index) {
            var row = document.createElement('tr');
            row.innerHTML = '<td>' + (index + 1) + '</td>' +
                '<td>' + assignedTask.task_name + '</td>';

            // Checklists column as an unordered list (ul)
            var checklistsCell = document.createElement('td');
            var checklistsList = document.createElement('ul');
            assignedTask.task.checklists.forEach(function(checklist) {
                var checklistItem = document.createElement('li');
                checklistItem.textContent = checklist.checklist;
                checklistsList.appendChild(checklistItem);
            });
            checklistsCell.appendChild(checklistsList);
            row.appendChild(checklistsCell);

            row.innerHTML +=
                '<td><div class="d-flex justify-content-center"><button class="btn btn-success StartBtns py-0 px-2 ms-3 my-1 start-button" ' +
                (assignedTask.task_start_time != null ? "disabled" : "") + ' value="' +
                assignedTask.id +
                '">Start</button><button class="btn btn-danger StartBtns py-0 px-2 ms-3 my-1 end-button" ' +
                (assignedTask.task_end_time != null ? "disabled" : "") + ' value="' +
                assignedTask.id + '">Finish</button></div></td>';

                row.innerHTML += '<td>' + assignedTask.StaffName + '</td>' +
    '<td>' + (assignedTask.starttime ) + '</td>' +
    '<td>' + (assignedTask.endtime ) + '</td>';
            

            // Participants column as a comma-separated string
            var participantsCell = document.createElement('td');
            var participantsText = assignedTask.participant_staff.map(function(
                participant) {
                return participant.name;
            }).join(', ');
            participantsCell.textContent = participantsText;
            row.appendChild(participantsCell);

            var LinkCell = document.createElement('td');
            var LinkContent = '';
            if (assignedTask.link != '') {
                LinkContent +=
                    '<a href="" target="_blank" style="font-size:20px"><i class="ri-attachment-2"></i></a></td>'
            }
            LinkCell.innerHTML = LinkContent;
            row.appendChild(LinkCell);
            // row.innerHTML += '<td> <a href="'+ assignedTask.link +'" target="_blank" style="font-size:20px"><i class="ri-attachment-2"></i></a></td>';
            if ((moment(assignedTask.endtime).isAfter(moment()) == false) && assignedTask.completed_status == 0) {
                row.innerHTML += '<td><span class="badge btn btn-danger btn-lg" >Pending</span></td>';
            } else {
                row.innerHTML += '<td><span class="badge bg-primary rounded-pill">' + assignedTask.STATUS +
                    '</span></td>';
            }


            taskTableBody.append(row);

           
        });
    }


    $(document).on('click', '.start-button', function() {
        taskId = $(this).val();
        const startTime = moment().format('YYYY-MM-DD HH:mm:ss');

        $.ajax({
            url: '/api/store-start-time',
            type: 'POST',
            data: {
                id: taskId,
                task_start_time: startTime,
                completed_status: "3"
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                searchTasks()
                toastr.success('Task Started');


            },
            error: function(xhr) {
                // Handle error response
                console.log(xhr.responseText);
            }
        });


    })

    $(document).on('click', '.end-button', function() {
    taskId = $(this).val();
    const endTime = moment().format('YYYY-MM-DD HH:mm:ss');

    // Check if Start button was clicked before Finish button
    var startButton = $('.start-button[value="' + taskId + '"]');
    if (startButton.prop('disabled') === true) {
        $.ajax({
            url: '/api/store-end-time',
            type: 'POST',
            data: {
                id: taskId,
                task_end_time: endTime,
                completed_status: "1"
            },
            success: function(response) {
                // Handle success response
                console.log(response);
                searchTasks();
                toastr.success('Task Finished');
            },
            error: function(xhr) {
                // Handle error response
                console.log(xhr.responseText);
            }
        });
    } else {
        toastr.warning('Please Start Your Task First.');
    }
});





    // function updateTaskTable(tasks) {
    //     var taskTableBody = $("#taskTableBody");
    //     taskTableBody
    // .empty(); // Clear existing table rowsI apologize for the incomplete response in the previous message. Here's the continuation of the code:


    //     tasks.forEach(function(task, index) {
    //         var row = $("<tr></tr>");

    //         row.append("<td class='text-center'>" + (index + 1) + "</td>");
    //         row.append("<td class='text-start'><b>" + task.task_name + "</b><br><span class='text-start'>" +
    //             task.remarks + "</span></td>");

    //         var checklistColumn = $("<td class='text-start'><ul></ul></td>");
    //         var checklistItems = task.checklist.map(function(checklist) {
    //             return "<li>" + checklist + "</li>";
    //         });
    //         checklistColumn.find("ul").append(checklistItems);
    //         row.append(checklistColumn);

    //         row.append("<td class='text-center'>" + task.assigned_to + "</td>");
    //         row.append("<td class='text-center'>" + task.participants + "</td>");
    //         row.append("<td class='text-center'>" + task.task + "</td>");
    //         row.append("<td class='text-center'>" + task.link + "</td>");
    //         row.append("<td class='text-center'>" + task.task_status + "</td>");

    //         taskTableBody.append(row);
    //     });

    //     // Show the updated table
    //     $(".mainContents").show();
    // }



    // // $('.taskdropdown').change(function() {
    // //     var selectedTaskId = $(this).attr('id').split('-')[
    // //         2]; // Extract the task ID from the select element's ID
    // //     var selectedStatusId = $(this).val(); // Get the selected task status ID

    // //     $.ajax({
    // //         url: '/api/store-task-status',
    // //         type: 'POST',
    // //         data: {
    // //             id: selectedTaskId,
    // //             completed_status: selectedStatusId
    // //         },
    // //         success: function(response) {
    // //             // Handle success response
    // //             console.log(response);
    // //             updateTaskStatus(selectedTaskId,
    // //                 selectedStatusId); // Update the task status in the table
    // //         },
    // //         error: function(xhr) {
    // //             // Handle error response
    // //             console.log(xhr.responseText);
    // //         }
    // //     });
    // // });

    // // Get all the table rows in the tbody
    // const tableRows = document.querySelectorAll("#MasterTable tbody tr");

    // // Iterate over each table row
    // tableRows.forEach((row) => {
    //     // Extract the task ID from the data-task-id attribute
    //     const taskId = row.querySelector(".start-button").getAttribute("data-task-id");

    //     // Get the checklist items within the current row
    //     const checklistItems = row.querySelectorAll("ul > div > div.col-6 li");

    //     // Extract the checklist names
    //     const checklist = Array.from(checklistItems).map((item) => item.textContent.trim());

    //     // Get the start and end buttons within the current row
    //     const startButton = row.querySelector(".start-button");
    //     const endButton = row.querySelector(".end-button");

    //     // Get the task_start_time and task_end_time values
    //     const taskStartTime = row.getAttribute("data-task-start-time");
    //     const taskEndTime = row.getAttribute("data-task-end-time");

    //     // Retrieve the stored button states from local storage
    //     const startButtonState = localStorage.getItem(`startButton_${taskId}`);
    //     const endButtonState = localStorage.getItem(`endButton_${taskId}`);

    //     // Set the initial button states based on the stored values
    //     if (startButtonState === "disabled") {
    //         startButton.disabled = true;
    //     }
    //     if (endButtonState === "disabled") {
    //         endButton.disabled = true;
    //     }



    //     // Add event listeners to the start and end buttons
    //     startButton.addEventListener("click", () => {
    //         const startTime = moment().format('YYYY-MM-DD HH:mm:ss'); // Store the start time

    //         // Check if task_start_time is "00:00:00" or null
    //         if (taskStartTime === "00:00:00" || taskStartTime === null) {
    //             startButton.disabled = true; // Disable the start button

    //             $.ajax({
    //                 url: '/api/store-start-time',
    //                 type: 'POST',
    //                 data: {
    //                     id: taskId,
    //                     task_start_time: startTime,
    //                     completed_status: "4"
    //                 },
    //                 success: function(response) {
    //                     // Handle success response
    //                     console.log(response);
    //                     startButton.disabled = true; // Disable the start button permanently
    //                     localStorage.setItem(`startButton_${taskId}`,
    //                         "disabled"); // Store the button state
    //                 },
    //                 error: function(xhr) {
    //                     // Handle error response
    //                     console.log(xhr.responseText);
    //                 }
    //             });
    //         }
    //     });

    //     endButton.addEventListener("click", () => {
    //         const endTime = moment().format('YYYY-MM-DD HH:mm:ss'); // Store the end time

    //         // Check if task_end_time is "00:00:00" or null
    //         if (taskEndTime === "00:00:00" || taskEndTime === null) {
    //             endButton.disabled = true; // Disable the end button

    // $.ajax({
    //     url: '/api/store-end-time',
    //     type: 'POST',
    //     data: {
    //         id: taskId,
    //         task_end_time: endTime,
    //         completed_status: "2"
    //     },
    //     success: function(response) {
    //         // Handle success response
    //         console.log(response);
    //         location.reload();
    //         endButton.disabled = true; // Disable the end button permanently
    //         localStorage.setItem(`endButton_${taskId}`,
    //             "disabled"); // Store the button state


    //     },
    //     error: function(xhr) {
    //         // Handle error response
    //         console.log(xhr.responseText);
    //     }
    // });
    //         }
    //     });
    // });


    // Now you have access to the task ID, checklist, start time, and end time within each table row
    $(document).ready(function() {

        function updateTaskStatus(taskId, selectedStatusId) {
            var selectElement = $('#status-select-' + taskId);
            selectElement.val(selectedStatusId); // Set the selected value in the dropdown
        }

        function updateStartTime(taskId, startTime) {
            $('#start-time-' + taskId).text(startTime);
        }

        function updateEndTime(taskId, endTime) {
            $('#end-time-' + taskId).text(endTime);
        }
    });
</script>


</html>
