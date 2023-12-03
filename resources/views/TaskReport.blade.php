<!DOCTYPE html>
<html lang="en">

  <head>

     @include('layouts.headder')
     <style>
        .mainContents{
            display:none;
        }
        th.title {
            width: 400px !important; 
        }
    </style>
  </head>

  <body>

        <!-- ======= Header ======= -->
        
        <header id="header" class="header fixed-top d-flex align-items-center">
            @include('layouts.navbar')
        </header>
            <!-- Modal -->
            <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">Do you want to delete this Task Category?</h4>
                            <div class="text-center mt-3">
                                <button type="button" id="confirmYes" class="btn btn-primary me-5">Yes</button>
                                <button type="button" id="confirmNo" class="btn btn-secondary ms-5" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Response Modal -->
            <div class="modal fade ResponseModal" id="ResponseModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body p-3 py-5">
                            <div class="text-center mb-4" id="ResponseImage">

                            </div>
                            <h4 id="ResponseText" class="text-center mb-3"></h4>
                            <div class="text-center">
                                <button type="button" id="btnConfirm" style="display: none;" class="btn btn_save mt-4 px-5 py-2" data-bs-dismiss="modal">Proceed</button>
                                <button type="button" id="btnClose" class="btn btn_save responsebtn mt-4 px-5 py-2" data-bs-dismiss="modal">Okay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ChecklistModal -->
            <div class="modal fade addUpdateModal"  id="checklist" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content cntrymodalbg">
                        <div class="modal-header modelhead py-2">
                            <h6 class="modal-title" id="exampleModalLabel">Task Checklist</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul>
                              
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        <!-- End Header -->

        <!-- ======= Sidebar ======= -->

        <aside id="sidebar" class="sidebar ps-0">
            @include('layouts.sidebar')
        </aside>

        <!-- End Sidebar-->

        <main id="main" class="main">

            
           
                <div class="container-fluid">
                    <h4 class="d-flex justify-content-center py-1 contitle">Task Report</h4>              
                </div>
                <div class="card1 card-body">
                    <form class="AddForm" id="task_report" novalidate>

                        <div class="row">
                            <div class="col-lg-2 col-md-6 col-12 mt-3">
                            <select class="form-select inputfield"
                                aria-label="Default select example name" id="branch"
                                name="branch_id">
                                <option class="inputlabel" value="0">Select Branch
                                </option>
                                @foreach ($branch as $item)
                                    <option value="{{ $item->id }}">{{ $item->branch_name }}
                                    </option>
                                @endforeach
                            </select>



                            </div>
                            <div class="col-lg-2 col-md-6 col-12 mt-3">
                                <select class="form-select inputfield " aria-label="Default select example name" id="staff"
                                    name="assignTo">
                                    <option class="inputlabel" value="0">Select Staff
                                    </option>
                                    @foreach ($staffs as $staff)
                                        <option value="{{ $staff->id }}">{{ $staff->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-2 col-md-6 col-12 mt-3">
                            <input type="date" class="form-control inputfield"
                                                        id="date" name="date" autofocus>

                            </div>
                            <div class="col-lg-2 col-md-6 col-12 mt-3">

                                <select class="form-select inputfield "
                                    aria-label="Default select example name" id="task" name="task">
                                    <option class="inputlabel" value="0"> Select Task</option>
                                    @foreach ($Task as $tasks)
                                        <option class="inputlabel" value="{{ $tasks->id }}">
                                            {{ $tasks->task_name }}
                                        </option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="col-lg-2 col-md-6 col-12 mt-3">
                                <select class="form-select inputfield "
                                    aria-label="Default select example name" id="task_status" name="taskStatus">
                                    <option class="inputlabel" value="0">Task Status</option>
                                    @foreach ($Taskstatus as $tasksstatus)
                                        <option class="inputlabel" value="{{ $tasksstatus->id }}">
                                            {{ $tasksstatus->taskstatus }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 mt-3">
                                <button type="submit" class="btn AddBtn  px-5"> Search</button>
                            </div>
                        </div>

                        <!-- <div class="row justify-content-end"> -->

                            
                            <!-- <div class="col-lg-2 col-md-6 col-12 mt-3 ">
                                <button id="search-button" type="button" class="btn serachBtn"
                                    onclick="resetSearch()">
                                    <i class="bi bi-arrow-clockwise"></i> &nbsp;Reset
                                </button>
                            </div> -->
                        <!-- </div> -->
                    </form> 
                </div>
                <div class="wrapper">
                    <!--CONTENTS-->
                    <div class="container-fluid mainContents">
                        <div class="card card-body main_card mt-2 p-3 mb-2">                           
                                                        
                            <div class="table-responsive">
                                <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                    <thead class="tablehead">
                                        <tr>
                                            <!-- <th class="text-center">Si No</th> -->
                                            <th>Title</th>
                                            <th>Category</th>                                    
                                            <th class="text-nowrap">Assigned To</th>
                                            <th>Observers</th>
                                            <th>Patricipants</th>
                                            <th>Task Status</th>
                                            <th>Due</th>
                                        </tr>                                           
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="loader">
                <div class="">
                    <img class="img-fluid" src="{{url('assets/images/loading.gif')}}">
                    <h4 class="text-center">LOADING</h4>
                </div>
            </div>
        </main><!-- End #main -->  

        @include('layouts.footer')

        <script>

            //Onchange of branch 
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                console.log(branchId);
                loadStaff(branchId);
            });
            
            //load branch staffs 
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

            $(document).on('submit', '#task_report', function(e) {
                e.preventDefault();
                var Branch = $('#branch').val();
                var Staff = $('#staff').val();
                var Date = $('#date').val();
                var Task = $('#task').val();
                var Status = $('#task_status').val();

                var settings = {
                    "url": "/api/Taskreportdata?Branch=" + Branch + "&Staff=" + Staff + "&Date=" + Date + "&Task=" + Task + "&Status=" + Status,
                    "method": "GET",
                    "timeout": 0,
                    "headers": {
                        "Accept": "application/json"
                    },
                };

                $.ajax(settings).done(function(response) {
                    console.log(response);

                    // Clear the existing table body
                    $('#MasterTable tbody').empty();

                    // Loop through the response data and append rows to the table
                    $.each(response.TaskReports.TaskReports, function(index, taskReport) {
                        var row = '<tr>' +
                            '<td class="taskchecklist"data-task-id="' + taskReport.id + '">' + taskReport.TaskName + '</td>' +
                            '<td>' + taskReport.TaskCategoryName + '</td>' +
                            '<td>' + taskReport.StaffName + '</td>' +
                            '<td>' + (taskReport.ObserversName ? taskReport.ObserversName : '-') + '</td>' +
                            '<td>' + (taskReport.ParticipantName ? taskReport.ParticipantName : '-') + '</td>' +
                            '<td>' + taskReport.taskstatus + '</td>' +
                            '<td>' + taskReport.date + '</td>' +
                            '</tr>';

                        $('#MasterTable tbody').append(row);
                    });

                    $('.taskchecklist').click(function() {
                        // Open the modal popup
                        var taskId = $(this).data('task-id');
                        loadchecklist(taskId);
                        $('#checklist').modal('show');
                    });
                });
            });


            function loadchecklist(taskId){
            console.log(taskId);
            var settings = {
                "url": "/api/Checklist/"+taskId+"",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function (response) {
                console.log(response);
                 // Clear the existing list items
                $('#checklist ul').empty();

                // Loop through the checklist items and append them to the list
                $.each(response, function (index, item) {
                    var listItem = '<li>' + item.checklist + '</li>';
                    $('#checklist ul').append(listItem);
                });
                
            });
        }



        </script>
        
    </body>

</html>