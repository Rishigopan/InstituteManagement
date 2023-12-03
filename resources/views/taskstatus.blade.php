<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')
    <style>
        .mainContents {
            display: none;
        }
    </style>
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
    <main id="main" class="">

        {{-- //add modal --}}


        <div class="modal fade addUpdateModal" id="TaskstatusModal" tabindex="-1"
            data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Task Status</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Year AddForm" id="add_taskstatus" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Task Status<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="taskstatus"
                                        name="taskstatus" placeholder="Enter  Task Status" autofocus required>
                                </div>

                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
                            </div>
                        </form>
                        <form class="UpdateYear UpdateForm" id="update_Taskstatus" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <input type="hidden" id="update_taskstatus_id">
                                    <label class="mt-2 mb-1 inputlabel">Task status<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="updated_taskstatus"
                                        name="updated_taskstatus" autofocus required>
                                </div>

                                <input type="hidden" id="updated_by" value="0">
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- //view modal --}}

        <div class="modal fade addUpdateModal" id="TaskstatusViewModal" tabindex="-1" data-bs-backdrop="static"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Task Status</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Viewyear" id="view_taskstatus" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" id="view_taskstatus_id">
                                    <label class="mt-2 mb-1 inputlabel">Task Status</label><br>
                                    <input disabled class="form-control mt-1 inputfield" id="view_TaskStatus"
                                        name="ViewYear" autofocus required readonly>
                                </div>
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

        <!-- Delete Modal -->
        <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this TaskStatus?</h4>
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
                            <button type="button" id="btnClose" class="btn btn_save  mt-4 responsebtn px-5 py-2"
                                data-bs-dismiss="modal">Okay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Task Status</h4>
        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 p-3 mb-2">
                    <div class="main_heading d-flex justify-content-between mb-2  p-2 ">
                        <div id="exportbtns"class="exportbtns">
                            <!-- export buttons -->

                        </div>
                        <br><br>
                        <div>
                            <input type="text" class="form-control text-center" id="SearchBar"
                                placeholder="Search">
                        </div>

                        <div class="">
                            {{-- <button class="btn AddBtn px-4" data-bs-toggle="modal"
                                data-bs-target="#TaskstatusModal">+ Add</button> --}}
                            {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                        </div>
                    </div>
                    <div class="admintoolbar">
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                            <thead class=" tablehead">
                                <tr>
                                    <th class="text-center">Sl No</th>
                                    <th class="text-center">Task Status</th>

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
                <img class="img-fluid" src="{{ url('assets/images/loading.gif') }}">
                <h4 class="text-center">LOADING</h4>
            </div>
        </div>
    </main><!-- End #main -->

    @include('layouts.footer')


    <script type="text/javascript">
        //Focus First Field
        $(document).ready(function() {
            $('#TaskstatusModal').on('shown.bs.modal', function() {
                $('#taskstatus').focus();
            });
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
            buttons: [{
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, ]
                    }
                },
            ],

            initComplete: function() {
                $("#MasterTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");
                var api = this.api();
                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        if (colIdx < api.columns().nodes().length - 1) {
                            $(cell).html(
                                '<input type="text" class="text-center searchcolumn" placeholder="Search" />'
                            );
                        } else {
                            $(cell).empty();
                        }
                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                // var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                // .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
                $('.dt-buttons').appendTo('#exportbtns');
            },




            ajax: "{{ route('Taskstatus.TaskStatus') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'taskstatus',
                    name: 'taskstatus'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });


        //Searchbar
        $('#SearchBar').keyup(function() {
            MasterTable.search($(this).val()).draw();
        });


        //Add TaskStatus

        $("#add_taskstatus").validate({
            rules: {
                taskstatus: {
                    required: true,
                    minlength: 2,
                    maxlength: 25,
                }
            },
            messages: {
                taskstatus: {
                    required: "Please Enter Task Status",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 25 characters",
                }
            },
            submitHandler: function(form) {
                var TaskStatus = $('#taskstatus').val();

                $.ajax({
                    url: "/api/Taskstatus",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        taskstatus: TaskStatus,


                    },



                    beforeSend: function() {
                        $('.loader').show();
                        $('#TaskstatusModal').modal('hide');
                        $('.mainContents').hide();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    MasterTable.ajax.reload();
                    console.log(response);
                    var GroupsUpdate = JSON.stringify(response);
                    console.log(GroupsUpdate);

                    var GroupsUpdateed = JSON.parse(GroupsUpdate);
                    if (GroupsUpdateed.success == true) {
                        if (GroupsUpdateed.code == "0") {
                            swal("Warning", response.message, "warning");

                        } else if (GroupsUpdateed.code == "1") {
                            swal("Success", response.message, "success");

                        } else if (GroupsUpdateed.code == "2") {
                            swal("Error", response.message, "error");

                        }
                    } else {
                        swal("Error", response.message, "error");

                    }

                });
            }
        });


        //edit TaskStatus
        $('#MasterTable').on('click', '.btn_edit', function() {
            var EditTaskStatus = $(this).val();
            console.log(EditTaskStatus);

            var settings = {
                "url": "/api/Taskstatus/" + EditTaskStatus + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnquiryTypeResult = JSON.stringify(response);
                console.log(EnquiryTypeResult);
                var EnquiryTypeedit = JSON.parse(EnquiryTypeResult);
                if (EnquiryTypeedit.success == true) {
                    $('#TaskstatusModal').modal('show');
                    $('#add_taskstatus').hide();
                    $('#update_Taskstatus').show();
                    var CoTypeDataArray = EnquiryTypeedit.taskStatus;
                    for (const key in CoTypeDataArray) {
                        var TaskStatus = CoTypeDataArray['taskstatus'];
                        var TaskStatusId = CoTypeDataArray['id'];

                    }
                    $("#update_taskstatus_id").val(TaskStatusId);
                    $("#updated_taskstatus").val(TaskStatus);

                }
            });



        });



        //Update TaskStatus

        $("#update_Taskstatus").validate({
            rules: {
                update_Taskstatus: {
                    required: true,
                    minlength: 2,

                }
            },
            messages: {
                update_Taskstatus: {
                    required: "Please Enter Task Status",
                    minlength: "atleast 2 characters",

                }
            },
            submitHandler: function(form) {
                var UpdateId = $('#update_taskstatus_id').val();
                var UpdateTaskStatus = $('#updated_taskstatus').val();
                var UpdatedDy = $('#updated_by').val();


                $.ajax({

                    url: "/api/Taskstatus/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        taskstatus: UpdateTaskStatus,
                        updated_by: UpdatedDy

                    },
                    beforeSend: function() {

                        $('#TaskstatusModal').modal('hide');
                        $('.mainContents').hide();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    MasterTable.ajax.reload();
                    console.log(response);
                    var GroupsUpdate = JSON.stringify(response);
                    console.log(GroupsUpdate);

                    var GroupsUpdateed = JSON.parse(GroupsUpdate);
                    if (GroupsUpdateed.success == true) {
                        if (GroupsUpdateed.code == "0") {
                            swal("Warning", response.message, "warning");

                        } else if (GroupsUpdateed.code == "1") {
                            swal("Success", response.message, "success");

                        } else if (GroupsUpdateed.code == "2") {
                            swal("Error", response.message, "error");

                        }
                    } else {
                        swal("Error", response.message, "error");

                    }

                });
            }
        });

        //Delete TaskStatus
        $('#MasterTable').on('click', '.btn_delete', function() {
            var DeleteEnType = $(this).val();
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this.",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "No",
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Yes",
                        value: true,
                        visible: true,
                        className: "btn-danger",
                        closeModal: true,
                    }
                },
                dangerMode: true,
                focusConfirm: true, // Focus on the "Yes" button
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "/api/Taskstatus/" + DeleteEnType + "",
                        method: "DELETE",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        beforeSend: function() {
                            $('.loader').show();
                            $('.delModal').modal('hide');
                            $('.mainContents').hide();
                            $('#ResponseImage').html("");
                            $('#ResponseText').text("");
                        },
                    }).done(function(response) {
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

        //View Academic Year
        $('#MasterTable').on('click', '.btn_view', function() {
            var ViewEnType = $(this).val();
            console.log(ViewEnType);
            var settings = {
                "url": "/api/Taskstatus/" + ViewEnType + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnResult = JSON.stringify(response);
                console.log(EnResult);
                var Enedit = JSON.parse(EnResult);
                if (Enedit.success == true) {
                    $('#TaskstatusViewModal').modal('show');
                    $('#view_taskstatus').show();
                    var EnDataArray = Enedit.taskStatus;
                    for (const key in EnDataArray) {
                        var TaskStatus = EnDataArray['taskstatus'];
                        var YearId = EnDataArray['id'];

                    }
                    $("#view_taskstatus_id").val(YearId);
                    $("#view_TaskStatus").val(TaskStatus);

                }
            });

        });


        document.getElementById('taskstatus').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g,
                ''); // Remove any digits and special characters from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
    </script>


</body>

</html>
