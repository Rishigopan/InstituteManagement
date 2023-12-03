<!DOCTYPE html>
<html lang="en">
   
  <head>

     @include('layouts.headder')
     <style>
        .mainContents{
            display:none;
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
        <main id="main" class="">
            
        {{-- add update modal --}}
        <div class="modal fade addUpdateModal" id="TaskModal" tabindex="-1" data-bs-keyboard="true" aria-hidden="true">

  
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content cntrymodalbg">

                <div class="modal-header modelhead py-2">
                            <h6 class="modal-title" id="exampleModalLabel">Task Template</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                    <form class="Task AddForm" id="add_task" novalidate>
                        {{ csrf_field() }}
                        <div class="row">
                            <div class=" col-xl-6 col-lg-12 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Category<span style="color:red; font-size:15px"> *</span></label><br>
                                <select class="form-select inputfield " 
                                    aria-label="Default select example name" id="task_category_id"
                                    name="task_category" autofocus required>

                                    <option class="inputlabel" hidden value=""> Select Task Category
                                    </option>
                                    @foreach($task_categories as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>  
                                    @endforeach
                                        <option value=""></option>
                                </select>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Name<span style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control inputfield" id="task_name" name="taskName"
                                    placeholder="Enter Task Name"  autofocus required>
                            
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <input class="form-check-input mt-4" type="checkbox" value="" id="is_repeat"
                                        name="IsRepeat" >

                                    <label class="form-check-label inputlabel mt-4 mx-2" for="is_repeat">
                                        check if the task repetitive
                                    </label>
                                </div>
                                <div class=" col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Repeat Cycle </label><br>
                                    <select class="form-select inputfield" aria-label="Default select example name"
                                        id="repetcycle" name="Repetcycle" disabled>
                                        <option class="inputlabel" hidden value="0" hidden> Select Repeat Cycle
                                        </option>
                                        <option class="inputlabel" value="1">Monthly</option>
                                        <option class="inputlabel" value="2">Yearly</option>
                                        <option class="inputlabel" value="3">Quarterly</option>
                                        <option class="inputlabel" value="4">Daily</option>
                                    </select>
                                </div>
                            
                            </div>
                            <div class="col-12">
                                <label class="mt-3 mb-1 inputlabel">Task Description </label><br>
                                <textarea cols="30" rows="3" class="form-control mt-1 inputfield" id="task_desc" name="Description"
                                    placeholder="Enter Task Description" ></textarea>
                                
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Task Checklist</label><br>
                                    <input type="text" class="form-control mt-1 inputfield checkList"
                                        id="task_checklist" name="TaskChecklist" placeholder="Enter Task Checklist">

                                    <div class="text-center">
                                        <button type="button" class="btn savebtn px-3 mt-2 text-center"
                                            >Add</button>
                                    </div>
                                </div>

                                <div class="table-responsive col-xl-6 col-lg-6 col-12 mt-4">
                                    <div style="max-height: 300px; overflow-y: scroll;">
                                        <table class="table-hover MasterTable_inside" id="MasterTable_inside" style="width: 100%;">
                                            <thead class=" tablehead">
                                                <tr>
                                                    <th class="text-center">Sl No</th>
                                                    <th class="text-center" id="check_lists">Task Checklist</th>
                                                    <th class="text-center">Delete</th>

                                                </tr>
                                            </thead>
                                            <tbody id="addtaskChecklistBody">
                                                
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class=" text-end mt-3">
                                <button type="submit" class="btn btn-success btn-lg refresh px-5 ">Save</button>
                            </div>
                        </div>
                        </form>    
                            <form class="UpdateTask UpdateForm" id="update_task" style="display: none;" novalidate>     
                                {{ csrf_field() }} 
                                <div class="row">
                                    <input type="hidden" id="update_task_id">
                                    <div class=" col-xl-6 col-lg-12 col-12">
                                        <label class="mt-2 mb-1 inputlabel"> Task Category<span style="color:red; font-size:15px"> *</span></label><br>
                                        <select class="form-select inputfield " 
                                            aria-label="Default select example name" id="update_task_category"
                                            name="utask_category">
        
                                            <option class="inputlabel" hidden value="0"> Select Task Category
                                            </option>
                                            @foreach($task_categories as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>  
                                            @endforeach
                                                <option value=""></option>
                                        </select>
                                       
                                    </div>
                                    <div class=" col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel"> Task Name<span style="color:red; font-size:15px"> *</span></label><br>
                                        <input type="text" class="form-control inputfield" id="update_task_name" name="UTaskName"
                                            placeholder="Enter Task Name"  autofocus required>
                                      
        
        
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-12">
                                            <input class="form-check-input mt-2" type="checkbox" value=""
                                                id="update_is_repeat" name="IsRepeat"  checked>
        
                                            <label class="form-check-label inputlabel mt-2 mx-2" for="is_repeat">
                                                check if the task repetitive
                                            </label>
                                        </div>
                                        <div class=" col-xl-6 col-lg-6 col-12">
                                            <label class="mt-2 mb-1 inputlabel"> Repeat Cycle </label><br>
                                            <select class="form-select inputfield " aria-label="Default select example name"
                                                id="update_repetcycle" name="Repetcycle" disabled
                                               >
                                                <option class="inputlabel" hidden value="0" hidden> Select Repeat Cycle
                                                </option>
                                                <option class="inputlabel" value="1">Monthly</option>
                                                <option class="inputlabel" value="2">Yearly</option>
                                                <option class="inputlabel" value="3">Quarterly</option>
                                                <option class="inputlabel" value="4">Daily</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="mt-3 mb-1 inputlabel">Task Description </label><br>
                                        <textarea cols="30" rows="3" class="form-control mt-1 inputfield" id="update_task_desc" name="Description"
                                            placeholder="Enter Task Description" ></textarea>
                                       
                                    </div>
        
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-12">
                                            <label class="mt-2 mb-1 inputlabel"> Task Checklist</label><br>
                                            <input type="text" class="form-control mt-1 inputfield checkList"
                                                id="update_task_checklist" name="TaskChecklist" placeholder="Enter Task Checklist"
                                                >
        
                                            <div class="text-center">
        
        
                                                <button type="button" class="btn savebtn px-3 mt-2 text-center" id="updateaddchecklist"
                                                    >Add</button>
        
                                            </div>
                                        </div>
        
                                        <div class="table-responsive col-xl-6 col-lg-6 col-12 mt-4">
                                            <table class="table table-hover MasterTable_update" id="MasterTable_update" style="width: 100%;">
                                                <thead class="tablehead">
                                                    <tr>
                                                        <th class="text-center userial">Sl No</th>
                                                        <th class="text-center">Task Checklist</th>
                                                        <th class="text-center">Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="taskChecklistBody"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                    <div class=" text-end mt-3">
                                        <button type="submit" class="btn btn-success btn-lg refresh px-5 ">Update</button>
                                    </div>
                                </form>
                                </div>                
                        </div>
                    </div>
                </div>
            </div>

        {{-- view modal --}}

        <div class="modal fade " id="viewTaskModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Task Template</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Viewtask " id="view_task_template" style="display: none;" novalidate>
                        {{ csrf_field() }}
                        <div class="row">
                            <input type="hidden" id="view_task_id">
                            <div class=" col-xl-6 col-lg-12 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Category</label><br>
                                <select class="form-select inputfield " 
                                    aria-label="Default select example name" id="view_task_category"
                                    name="name" readonly disabled>

                                    <option class="inputlabel" hidden value="0"> Select Task Category
                                    </option>
                                    @foreach($task_categories as $key)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>  
                                    @endforeach
                                        <option value=""></option>
                                </select>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Name</label><br>
                              
                                    <input type="text" class="form-control inputfield" id="view_task_name" name="TaskName" placeholder="Enter Task Name" autofocus required readonly disabled>


                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <input class="form-check-input mt-2" type="checkbox" value=""
                                        id="is_repeat" name="IsRepeat"  checked readonly disabled>

                                    <label class="form-check-label inputlabel mt-2 mx-2" for="is_repeat">
                                        check if the task repetitive
                                    </label>
                                </div>
                                <div class=" col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Repeat Cycle </label><br>
                                    <select class="form-select inputfield " aria-label="Default select example name"
                                        id="view_repetcycle" name="Repetcycle" disabled
                                       >
                                        <option class="inputlabel" hidden value="0" hidden> Select Repeat Cycle
                                        </option>
                                        <option class="inputlabel" value="1">Monthly</option>
                                        <option class="inputlabel" value="2">Yearly</option>
                                        <option class="inputlabel" value="3">Quarterly</option>
                                        <option class="inputlabel" value="4">Daily</option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive col-12 mt-4">
                                <table class="table table-hover MasterTable_update" id="MasterTable_update" style="width: 100%;">
                                    <thead class=" tablehead">
                                        <tr>
                                            <th class="text-center">Sl No</th>
                                            <th class="text-center">Task Checklist</th>
                                        </tr>
                                    </thead>
                                    <tbody id="viewtaskChecklistBody">
                                        <tr>
                                       </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <label class="mt-3 mb-1 inputlabel">Task Description </label><br>
                                <textarea cols="30" rows="3" class="form-control mt-1 inputfield" id="view_task_desc" name="Description"
                                    placeholder="Enter Task Description" readonly disabled></textarea>
                               
                            </div>

                        </div>  
                            <div class=" text-end mt-3">
                                <button type="button" class="btn savebtn  px-5 "data-bs-dismiss="modal" aria-label="Close">Close</button>
                            </div>                              
                        </form>                                 
                    </div>
                </div>
            </div>
        </div>
         
     
       
            
            <div class="container-fluid px-4 ">
                <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Task Template</h4>
            </div>
                
                <div class="wrapper">
                    <!--CONTENTS-->
                    <div class="container-fluid mainContents">
                        <div class="card card-body main_card mt-2 p-3 mb-2">                           
                            <div class="main_heading d-flex justify-content-between mb-2  p-2 ">
                                <div id="exportbtns"class="exportbtns">
                                    <!-- export buttons -->
                                </div>
                                <div>
                                    <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                                </div>
                                
                                <div class="">
                                    <div class="text-center">
                                        
                                    </div>
                                    <button class="btn AddBtn px-4" data-bs-toggle="modal" data-bs-target="#TaskModal">+  Add</button> 
                                    {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                                </div>
                            </div>
                            <div class="admintoolbar">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                    <thead class=" tablehead">
                                        <tr>
                                            <th class="text-center">Sl No</th>
                                            <th class="text-center">Task Name</th>
                                            <th class="text-center">Task Category</th>
                                            <th class="text-center">Task Description</th>
                                            <th class="text-center">Actions</th>
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


    <script type="text/javascript">



        //modal close function
        $(".addUpdateModal").on("hidden.bs.modal", function() {
            $(".UpdateForm").hide();
            $(".AddForm").show();
            $(".UpdateForm")[0].reset();
            $(".AddForm")[0].reset();
            $(".addUpdateModal").removeClass("error");
            var errorMessage = $('label.error');
            errorMessage.hide();
            var errorMessage = $('.inputfield.error');
            errorMessage.removeClass('error');
            var form = $('.AddForm');
            form.validate().resetForm();
            form.find('.error').removeClass('error');
            var Uform = $('.UpdateForm');
            Uform.validate().resetForm();
            Uform.find('.error').removeClass('error');
            $('#MasterTable_inside tbody').empty();
            $('#MasterTable_update tbody').empty();

        });



        //Data Table

        $('.MasterTable thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('.MasterTable thead');
            var MasterTable = $('.MasterTable').DataTable({
                processing: true,
                orderCellsTop: true,
                fixedHeader: true,
                "dom": 'Blrt<"bottom"ip>',
                "pagingType": 'simple_numbers',
                "language": {
                    "paginate": {
                        "previous": "<i class='bi bi-caret-left-fill'></i>",
                        "next": "<i class='bi bi-caret-right-fill'></i>"
                    }
                },    
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2]
                        }
                    },  
                ],
                
                initComplete: function () {
                    $("#MasterTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                    var api = this.api();
                        // For each column
                    api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        if (colIdx < api.columns().nodes().length - 1) {
                            $(cell).html('<input type="text" class="text-center searchcolumn" placeholder="Search" />');
                        } else {
                            $(cell).empty();
                        }     
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
    
                                // var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();
    
                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    // .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
                    $('.dt-buttons').appendTo('#exportbtns');
                },
                
                ajax: "{{ route('task_template.index') }}",
                                        columns: [
                                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                            {data: 'task_name', name: 'task_name'}, 
                                            {data: 'task_category', name: 'task_category'},     
                                            {data: 'task_description', name: 'task_description'},              
                                            {data: 'action', name: 'action', orderable: false, searchable: false},
                                        ]
            
        });



        
        // Get references to the checkbox and select elements
        var checkbox = document.getElementById('is_repeat');
        var select = document.getElementById('repetcycle');
        checkbox.addEventListener('click', function() {
            select.disabled = !checkbox.checked;
        });


        //Searchbar
        $('#SearchBar').keyup(function() {
                MasterTable.search($(this).val()).draw();
        });

        $(document).ready(function() {
            $('#TaskModal').on('shown.bs.modal', function() {
                $('#task_name').focus();

                var ucheckbox = document.getElementById('update_is_repeat');
                var uselect = document.getElementById('update_repetcycle');

                uselect.disabled = !ucheckbox.checked;
                
                // Add event listener to the checkbox
                ucheckbox.addEventListener('change', function() {
                    uselect.disabled = !ucheckbox.checked;
                });
            });
        });
           
        //add Task Checklist
        $(document).ready(function() {
            var serialNumber = 1; // Initialize serial number counter

            $('.savebtn').click(function() {
                var taskChecklist = $('#task_checklist').val().trim();
                if (taskChecklist !== '') {
                    // Check if the value already exists in the table
                    var existingValue = $('#MasterTable_inside tbody td:nth-child(2)')
                    .filter(function() {
                        return $(this).text().trim() === taskChecklist;
                    })
                    .first();
                    
                    if (existingValue.length === 0) {
                    var row = '<tr><td class="text-center">' + serialNumber + '</td><td class="text-center">' + taskChecklist + '</td> <td><i class="ri-delete-bin-6-line delete-row"></i></td></tr>';
                    $('#MasterTable_inside tbody').append(row);
                    $('#task_checklist').val('');
                    serialNumber++; // Increment serial number counter
                    } else {
                    // Value already exists, display a message or take appropriate action
                    toastr.warning("The value already exists in the table");

                    }
                }
            });

            // // Update Task Checklist

            $('#updateaddchecklist').click(function() {
                var UtaskChecklist = $('#update_task_checklist').val().trim();
                if (UtaskChecklist !== '') {
                    // Get the count of existing rows in the table
                    var rowCount = $('#MasterTable_update tbody tr').length;

                    // Calculate the new serial number as the count of the last row plus one
                    var UserialNumber = rowCount ;

                    // Check if the value already exists in the table
                    var existingValue = $('#MasterTable_update tbody td:nth-child(2)')
                    .filter(function() {
                        return $(this).text().trim() === UtaskChecklist;
                    })
                    .first();

                    if (existingValue.length === 0) {
                    var row = '<tr><td class="text-center userial">' + UserialNumber + '</td><td class="text-center">' + UtaskChecklist + '</td> <td><i class="ri-delete-bin-6-line delete-row"></i></td></tr>';
                    $('#MasterTable_update tbody').append(row);
                    $('#update_task_checklist').val('');
                    
                    } else {
                    // Value already exists, display a message or take appropriate action
                        toastr.warning("The value already exists in the table");
                     }
                }
            });
 
        });

       // Handle delete button click event
       $('#addtaskChecklistBody').on('click', '.delete-row', function() {
            $(this).closest('tr').remove();
        });
            

        //Add Task Template

        $("#add_task").validate({
            rules:{
                task_category:{
                    required: true,               
                },
                taskName:{
                    required: true,
                                    
                }   
            },
            submitHandler: function(form) {
                var TaskCategory = $('#task_category_id').val();
                var TaskName = $('#task_name').val();
                var IsRepeted = $('#is_repeat').is(':checked') ? 1 : 0;
                var TaskRepetedCycle = $('#repetcycle').val();
                var TaskDescreption = $('#task_desc').val();
                var TaskChecklists = [];

                    // Iterate over the table rows to extract the checklist items
                    $('#MasterTable_inside tbody tr').each(function() {
                        var checklistItem = $(this).find('td:nth-child(2)').text();
                        TaskChecklists.push(checklistItem);
                    });
                    console.log(TaskChecklists);

                $.ajax({
                    url: "/api/tasks",
                        method: "POST",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                        },
                        data: {
                            task_name: TaskName,
                            task_category_id: TaskCategory,
                            repeat_cycle: TaskRepetedCycle,
                            repeat_status: IsRepeted,
                            task_description: TaskDescreption,
                            checklist: TaskChecklists,
                    },
                    
                    beforeSend: function() {
                        $('.loader').show();
                        $('#TaskModal').modal('hide');
                        $('.mainContents').hide();
                        
                    },
                }).done(function (response) {
                    $('#add_task')[0].reset();
                    $('.mainContents').show();
                    $('.loader').hide();
                    $('#MasterTable_inside tbody').empty();
                    MasterTable.ajax.reload();
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
                    } 
                    else 
                    {
                        swal("Some Error Occured!!!", "Please Try Again", "error");

                    }  
                
                });  
            }
        });

            
        //edit task template

        $('#MasterTable').on('click', '.btn_edit', function() {
            var Edittask = $(this).val();
            console.log(Edittask);

            var settings = {
                "url": "/api/taskstemp/" + Edittask + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnquiryTypeResult = JSON.stringify(response);
                console.log(EnquiryTypeResult);
                var EnquiryTypeedit = JSON.parse(EnquiryTypeResult);
                if (EnquiryTypeedit.success == true) {
                    $('#TaskModal').modal('show');
                    $('#add_task').hide();
                    $('#update_task').show();
                    var CoTypeDataArray = EnquiryTypeedit.Tasks.tasks;
                    for (const key in CoTypeDataArray) {
                        var TaskCategory = CoTypeDataArray['task_category_id'];
                        var TaskName = CoTypeDataArray['task_name'];
                        var RepeatCycle = CoTypeDataArray['repeat_cycle'];
                        var TaskDescription = CoTypeDataArray['task_description'];
                        var TaskChecklist = CoTypeDataArray['checklist'];
                        var repStatus = CoTypeDataArray['repeat_status'];
                        var taskId = CoTypeDataArray['id'];

                    }
                    $("#update_task_id").val(taskId);
                    $("#update_task_category").val(TaskCategory);
                    $("#update_task_name").val(TaskName);
                    $("#update_repetcycle").val(RepeatCycle);
                    $("#update_task_desc").val(TaskDescription);
                    $("#update_task_checklist").val(TaskChecklist);
                    $("#update_is_repeat").prop("checked", repStatus == 1);

                    var taskchecksData = EnquiryTypeedit.Tasks.taskchecks;

                    // Populate the taskchecks data in the table
                    var taskChecklistBody = $('#taskChecklistBody');
                    taskChecklistBody.empty();
                    for (var i = 0; i < taskchecksData.length; i++) {
                        var checklistItem = taskchecksData[i].checklist;
                        var serialNumber = i + 1;
                        var tableRow = $('<tr></tr>');
                        var serialNumberCell = $('<td class="text-center"></td>').text(serialNumber);
                        var checklistCell = $('<td class="text-center"></td>').text(checklistItem);
                        var deleteCell = $('<td class="text-center"></td>');
                        var deleteButton = $('<i class="ri-delete-bin-6-line delete-row"></i>');
                        deleteCell.append(deleteButton);
                        tableRow.append(serialNumberCell, checklistCell, deleteCell);
                        taskChecklistBody.append(tableRow);
                    }

                    // Handle delete button click event
                    $('#taskChecklistBody').on('click', '.delete-row', function() {
                        $(this).closest('tr').remove();
                    });


                }
            });
        });


        //Update task template
        $("#update_task").validate({
            rules: {
                utask_category: {
                    required: true,
                },
                UTaskName: {
                    required: true,
                    minlength: 2,

                }
            },

            submitHandler: function(form) {
                var UpdateId = $('#update_task_id').val();
                var UpdateTaskCategory = $('#update_task_category').val();
                var UpdateTaskName = $('#update_task_name').val();
                var UpdateRepeatCycle = $('#update_repetcycle').val();
                var UpdateTaskDescription = $('#update_task_desc').val();
                var UpdateIsRepeat = $('#update_is_repeat').is(':checked') ? 1 : 0;

                console.log(UpdateId,UpdateTaskCategory,UpdateTaskName,UpdateRepeatCycle,UpdateTaskDescription,UpdateIsRepeat);

                var UpdateTaskChecklist = [];

                // Iterate over the table rows to extract the checklist items
                $('#MasterTable_update tbody tr').each(function() {
                    var uchecklistItem = $(this).find('td:nth-child(2)').text();
                    UpdateTaskChecklist.push(uchecklistItem);
                });

                console.log(UpdateTaskChecklist);


                $.ajax({

                    url: "/api/taskstemp/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "task_category_id":UpdateTaskCategory ,
                        "task_name": UpdateTaskName,
                        "repeat_cycle": UpdateRepeatCycle,
                        "task_description":UpdateTaskDescription,
                        "checklist":UpdateTaskChecklist ,                      
                        "repeat_status":UpdateIsRepeat ,                      


                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('#TaskModal').modal('hide');
                        $('.mainContents').hide();

                    },
                })
                .done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    $('#update_task')[0].reset();
                    $('#MasterTable_update tbody').empty();
                    $('#update_is_repeat').prop('checked', false);
                    MasterTable.ajax.reload();
                    console.log(response);
                    var CoTypeUpdate = JSON.stringify(response);
                    console.log(CoTypeUpdate);

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
                });
            }
        });

        //View Task template
        $('#MasterTable').on('click', '.btn_view', function () {
            var ViewEnType = $(this).val();
            console.log(ViewEnType);
            var settings = {
            "url": "/api/taskstemp/"+ViewEnType+"",
            "method": "GET",
            "timeout": 0,
            };

            $.ajax(settings).done(function (response) {
            console.log(response);
            var EnResult = JSON.stringify(response);
                console.log(EnResult);
                var Enedit = JSON.parse(EnResult);
                if (Enedit.success == true) {
                    $('#viewTaskModal').modal('show');                                
                    $('#view_task_template').show();
                    var EnDataArray = Enedit.Tasks.tasks;
                    for(const key in EnDataArray){
                        var TaskCategory = EnDataArray['task_category_id'];
                        var TaskName = EnDataArray['task_name'];
                        var RepeatCycle = EnDataArray['repeat_cycle'];
                        var TaskDescription = EnDataArray['task_description'];
                        var TaskChecklist = EnDataArray['checklist'];
                        var taskId = EnDataArray['id'];

                    }
                    $("#view_task_id").val(taskId);
                    $("#view_task_category").val(TaskCategory);
                    $("#view_task_name").val(TaskName);
                    $("#view_repetcycle").val(RepeatCycle);
                    $("#view_task_desc").val(TaskDescription);
                    $("#view_task_checklist").val(TaskChecklist);

                    var taskchecksData = Enedit.Tasks.taskchecks;

                    // Populate the taskchecks data in the table
                    var taskChecklistBody = $('#viewtaskChecklistBody');
                    taskChecklistBody.empty();
                    for (var i = 0; i < taskchecksData.length; i++) {
                        var checklistItem = taskchecksData[i].checklist;
                        var serialNumber = i + 1;
                        var tableRow = $('<tr></tr>');
                        var serialNumberCell = $('<td class="text-center"></td>').text(serialNumber);
                        var checklistCell = $('<td class="text-center"></td>').text(checklistItem);
                        
                        tableRow.append(serialNumberCell, checklistCell);
                        taskChecklistBody.append(tableRow);
                    }
                    
                }
            });
            
        });
                    
        //Delete task template
        $('#MasterTable').on('click', '.btn_delete', function () {
            $('.delModal').modal('show');
            var DeleteEnType = $(this).val();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/api/tasks/" + DeleteEnType,
                        method: "DELETE",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        beforeSend: function () {
                            $('.loader').show();
                            $('.mainContents').hide();
                        },
                    }).done(function (response) {
                        $('.mainContents').show();
                        $('.loader').hide();
                        MasterTable.ajax.reload();
                        console.log(response);
                        var EnDeleteResult = JSON.stringify(response);
                        console.log(EnDeleteResult);
                        var EnDelObj = JSON.parse(EnDeleteResult);
                        if (EnDelObj.success == true) {
                            if (EnDelObj.code == "0") {
                                swal("Warning", EnDelObj.message, "warning");
                            } else if (EnDelObj.code == "1") {
                                swal("Success", EnDelObj.message, "success");
                            } else if (EnDelObj.code == "2") {
                                swal("Error", EnDelObj.message, "error");
                            }
                        } else {
                            swal("Some Error Occured!!!", "Please Try Again", "error");
                        }
                    });
                }
            });
        });
                
    </script>

    </body>

</html>