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

        <div class="modal fade addUpdateModal" id="StaffModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Staff</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Staff AddForm" id="add_staff" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Name<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="staff_name"
                                        name="StaffName" placeholder="Enter Staff Name" autofocus required>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Branch<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <select class="form-select dropbdr " aria-label="Default select example name"
                                        id="branch" name="Branch" required>
                                        <option hidden class="inputlabel" value=""> Choose Branch</option>
                                        @foreach ($branch as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Department<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <select class="form-select dropbdr " aria-label="Default select example name"
                                        id="department" name="Department" required>
                                        <option hidden class="inputlabel"> Choose Department</option>
                                        @foreach ($department as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Email Id<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="email"
                                        name="Email" placeholder="Enter Your Email" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Password<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <input type="password" class="form-control mt-1 inputfield" id="staff_password"
                                        name="StaffPassword" placeholder="....." autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Confirm Password<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="password" class="form-control mt-1 inputfield" id="confirm_password"
                                        name="ConfirmPassword" placeholder="....." autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">

                                    <label class="mt-2 mb-1 inputlabel">Mobile No<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="mobile"
                                        name="Mobile" placeholder="Enter Mobile Number" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                    <textarea cols="30" rows="2" class="form-control mt-1 inputfield" id="remarks" name="Remarks"
                                        placeholder="Enter Remarks"></textarea>
                                </div>
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 "> Save</button>
                            </div>
                        </form>
                        <form class="UpdateStaff UpdateForm" id="update_add_staff" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" class="form-control mt-1 inputfield" id="update_id"
                                    name="UpdateId" autofocus required>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Name<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="update_staff_name"
                                        name="UpdateStaffName" autofocus required>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Branch<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <select class="form-select dropbdr " aria-label="Default select example name"
                                        id="update_branch" name="UpdateBranch" required>
                                        <option class="inputlabel" value=""> Choose Branch</option>
                                        @foreach ($branch as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Department<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <select class="form-select dropbdr " aria-label="Default select example name"
                                        id="update_department" name="UpdateDepartment" required>
                                        <option class="inputlabel" value=""> Choose Department</option>
                                        @foreach ($department as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Email Id<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="update_email"
                                        name="UpdateEmail" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">


                                    <label class="mt-2 mb-1 inputlabel">Mobile No<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="update_mobile"
                                        name="UpdateMobile" autofocus required>


                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                    <textarea cols="30" rows="2" class="form-control mt-1 inputfield" id="update_remarks"
                                        name="UpdateRemarks"></textarea>
                                </div>
                                <input type="hidden" id="updated_by" value="0">
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 "> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade addUpdateModal " id="StaffViewModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Staff Details</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="" id="view_add_staff" style="display: none;" novalidate>
                            <div class="row">
                                <input type="hidden" class="form-control mt-1 inputfield" id="view_id"
                                    name="viewId" autofocus required>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Name</label><br>
                                    <input type="text" disabled class="form-control mt-1 inputfield"
                                        id="view_staff_name" name="viewStaffName" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Branch</label><br>
                                    <select class="form-select dropbdr " disabled
                                        aria-label="Default select example name" id="view_branch" name="viewBranch">

                                        <option hidden class="inputlabel" value=""> Choose Branch</option>
                                        @foreach ($branch as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Department</label><br>
                                    <select class="form-select dropbdr " disabled
                                        aria-label="Default select example name" id="view_department"
                                        name="viewDepartment">

                                        <option hidden class="inputlabel" value=""> Choose Department</option>
                                        @foreach ($department as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                    <input type="text" disabled class="form-control mt-1 inputfield"
                                        id="view_email" name="viewEmail" autofocus required>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Mobile No</label><br>
                                    <input type="text" disabled class="form-control mt-1 inputfield"
                                        id="view_mobile" name="viewMobile" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                    <textarea disabled cols="30" rows="2" class="form-control mt-1 inputfield" id="view_remarks"
                                        name="viewRemarks"></textarea>
                                </div>
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
        <!-- Modal -->
        <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this Staff?</h4>
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
        <div class="container-fluid px-4 ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Staff </h4>
        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                        <div id="exportbtns"class="exportbtns">
                            <!-- export buttons -->
                        </div>
                        <div>
                            <input type="text" class="form-control text-center" id="SearchBar"
                                placeholder="Search">
                        </div>
                        <div class="">
                            <button class="btn AddBtn px-4" data-bs-toggle="modal" data-bs-target="#StaffModal">+
                                Add</button>
                            {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                            <thead class=" tablehead">
                                <tr>
                                    <th class="text-center">Si No</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">EmailId</th>
                                    <th class="text-center">MobileNo</th>
                                    <th class="text-center">Remark</th>
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
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3]
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



            ajax: "{{ route('staff.Staff') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobile_no',
                    name: 'mobile_no'
                },
                {
                    data: 'remarks',
                    name: 'remarks'
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


        //Add Staff
        $("#add_staff").validate({
    submitHandler: function(form) {
        var StaffName = $('#staff_name').val();
        var StaffDepartment = $('#department').val();
        var Branch = $('#branch').val();
        var StaffEmail = $('#email').val();
        var StaffPassword = $('#staff_password').val();
        var StaffCPassword = $('#confirm_password').val();
        var StaffMobile = $('#mobile').val();
        var StaffRemark = $('#remarks').val();
        
        $.ajax({
            url: "/api/staff",
            method: "POST",
            timeout: 0,
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },
            data: {
                name: StaffName,
                email: StaffEmail,
                password: StaffPassword,
                confirm_password: StaffCPassword,
                mobile_no: StaffMobile,
                remarks: StaffRemark,
                department_id: StaffDepartment,
                branch_id: Branch
            },
            beforeSend: function() {
                $('.loader').show();
                $('#StaffModal').modal('hide');
                $('.mainContents').hide();
                $('#ResponseImage').html("");
                $('#ResponseText').text("");
            },
        }).done(function(response) {
            $('.mainContents').show();
            $('.loader').hide();
            
            console.log(response);
            
            if (response.success) {
                if (response.code == "0") {
                    swal("Warning", response.message, "warning");
                } else if (response.code == "1") {
                    swal("Success", response.message, "success");
                } else if (response.code == "2") {
                    swal("Error", response.message, "error");
                } else if (response.code == "3") {
                    swal("Error", response.message, "error");
                }
            } else {
                if (response.error && response.error.email) {
                    swal("Error", response.error.email[0], "error");
                } else {
                    swal("Some Error Occurred!!!", "Please Try Again", "error");
                }
            }
        });
    }
});


        //edit Staff
        $('#MasterTable').on('click', '.btn_edit', function() {
            var EditEnquiryType = $(this).val();
            console.log(EditEnquiryType);

            var settings = {
                "url": "/api/Staffs/" + EditEnquiryType + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnquiryTypeResult = JSON.stringify(response);
                console.log(EnquiryTypeResult);
                var EnquiryTypeedit = JSON.parse(EnquiryTypeResult);
                if (EnquiryTypeedit.success == true) {
                    $('#StaffModal').modal('show');
                    $('#add_staff').hide();
                    $('#update_add_staff').show();
                    var CoTypeDataArray = EnquiryTypeedit.staffs;
                    for (const key in CoTypeDataArray) {
                        var StaffName = CoTypeDataArray['name'];
                        var StaffEmail = CoTypeDataArray['email'];
                        var StaffDepartment = CoTypeDataArray['department_id'];
                        var StaffBranch = CoTypeDataArray['branch_id'];
                        var StaffPswd = CoTypeDataArray['password'];
                        var StaffCPswd = CoTypeDataArray['confirm_password'];
                        var StaffMobile = CoTypeDataArray['mobile_no'];
                        var StaffRemark = CoTypeDataArray['remarks'];
                        var StaffId = CoTypeDataArray['id'];

                    }
                    $("#update_id").val(StaffId);
                    $("#update_staff_name").val(StaffName);
                    $("#update_department").val(StaffDepartment);
                    $("#update_branch").val(StaffBranch);
                    $("#update_email").val(StaffEmail);
                    $("#update_staff_password").val(StaffPswd);
                    $("#update_confirm_password").val(StaffCPswd);
                    $("#update_mobile").val(StaffMobile);
                    $("#update_remarks").val(StaffRemark);
                }
            });



        });



        //Update Staff

        $("#update_add_staff").validate({
            submitHandler: function(form) {
                var UpdateId = $('#update_id').val();
                var UpdateStaffName = $('#update_staff_name').val();
                var UpdateStaffDep = $('#update_department').val();
                var UpdateStaffBranch = $('#update_branch').val();
                var UpdateStaffEmail = $('#update_email').val();
                var UpdateStaffPswd = $('#update_staff_password').val();
                var UpdateStaffCPswd = $('#update_confirm_password').val();
                var UpdateStaffMobile = $('#update_mobile').val();
                var UpdateStaffRemark = $('#update_remarks').val();
                var UpdatedDy = $('#updated_by').val();


                $.ajax({

                    url: "/api/staff/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        name: UpdateStaffName,
                        email: UpdateStaffEmail,
                        password: UpdateStaffPswd,
                        confirm_password: UpdateStaffCPswd,
                        mobile_no: UpdateStaffMobile,
                        remarks: UpdateStaffRemark,
                        department_id: UpdateStaffDep,
                        branch_id: UpdateStaffBranch,
                        updated_by: UpdatedDy

                    },
                    beforeSend: function() {

                        $('#StaffModal').modal('hide');
                        $('.mainContents').hide();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
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

        //Delete Staff

        $('#MasterTable').on('click', '.btn_delete', function() {

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
                        url: "/api/staff/" + DeleteEnType,
                        method: "DELETE",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        beforeSend: function() {
                            $('.loader').show();
                            $('.mainContents').hide();
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

        //View Enquiry Type
        $('#MasterTable').on('click', '.btn_view', function() {
            var ViewEnType = $(this).val();
            console.log(ViewEnType);
            var settings = {
                "url": "/api/Staffs/" + ViewEnType + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnResult = JSON.stringify(response);
                console.log(EnResult);
                var Enedit = JSON.parse(EnResult);
                if (Enedit.success == true) {
                    $('#StaffViewModal').modal('show');
                    $('#view_add_staff').show();
                    var EnDataArray = Enedit.staffs;
                    for (const key in EnDataArray) {
                        var StaffName = EnDataArray['name'];
                        var StaffEmail = EnDataArray['email'];
                        var StaffDep = EnDataArray['department_id'];
                        var StaffBranch = EnDataArray['branch_id'];
                        var StaffMobile = EnDataArray['mobile_no'];
                        var StaffRemark = EnDataArray['remarks'];
                        var StaffId = EnDataArray['id'];

                    }
                    $("#view_id").val(StaffId);
                    $("#view_staff_name").val(StaffName);
                    $("#view_department").val(StaffDep);
                    $("#view_branch").val(StaffBranch);
                    $("#view_email").val(StaffEmail);
                    $("#view_mobile").val(StaffMobile);
                    $("#view_remarks").val(StaffRemark);
                }
            });

        });
    </script>


</body>

</html>
