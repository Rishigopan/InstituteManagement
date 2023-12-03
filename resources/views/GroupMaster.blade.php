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

        <div class="modal fade addUpdateModal" id="groupModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Group/Team</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Group AddForm" id="group" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Name<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="Group_name"
                                        name="GroupName" placeholder="Enter  Name" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 ">Select Branch<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <select class="form-select inputfield" aria-label="Default select example name"
                                        id="branchName" name="branch_id" required>
                                        <option class="inputlabel" hidden value="0">Select Branch
                                        </option>
                                        @foreach ($branch as $branchName)
                                            <option class="inputlabel" value="{{ $branchName->id }}">
                                                {{ $branchName->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 ">Select Members<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <select class="inputfield staffselect multiselect" multiple id="show_members"
                                        name="Members" required>
                                        <option hidden value=""> Select Members</option>
                                        @foreach ($staffs as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
                            </div>
                        </form>
                        <form class="UpdateGroup UpdateForm" id="update_group" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" id="update_group_id">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Name<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="update_Group_name"
                                        name="UpdateGroupName" placeholder="Enter  Name" autofocus required>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 ">Select Branch<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <select class="form-select inputfield" aria-label="Default select example name"
                                        id="Updatebranch" name="Updatebranch_id" required>
                                        <option class="inputlabel" hidden value="0">Select Branch
                                        </option>
                                        @foreach ($branch as $branchName)
                                            <option class="inputlabel" value="{{ $branchName->id }}">
                                                {{ $branchName->branch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 ">Select Members<span style="color:red; font-size:15px">
                                            *</span></label><br>
                                    <select class="inputfield upgroupselect multiselect" multiple
                                        aria-label="Default select example name" id="update_members"
                                        name="UpdateMembers">
                                        <option hidden value=""> Select Members</option>
                                        @foreach ($staffs as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade addUpdateModal " id="GroupViewModal" tabindex="-1"
            data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Group/Team</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="ViewGroup ViewForm" id="View_group" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" id="View_group_id">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Name</label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="View_Group_name"
                                        name="ViewGroupName" placeholder="Enter Group Name" autofocus disabled>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-12">
                                    <label class="mt-3 mb-1 ">Select Members</label><br>
                                    <select class="inputfield Viewgroupselect multiselect" multiple
                                        aria-label="Default select example name"id="View_members" name="ViewMembers"
                                        disabled>
                                        <option hidden value=""> Select Members</option>
                                        @foreach ($staffs as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                        <h4 class="text-center">Do you want to delete this Group/Team?</h4>
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
            <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Group/Team</h4>
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
                            <button class="btn AddBtn px-4" data-bs-toggle="modal" data-bs-target="#groupModal">+
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
                                    <th class="text-center">Branch</th>
                                    <th class="text-center">Members</th>
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


        var selectize = $('#show_members')[0].selectize;
        var selectize1 = $('#update_members')[0].selectize;

        $(document).ready(function() {
            $('#branchName').on('change', function() {
                var branchId = $(this).val();
                console.log(branchId);
                loadStaff(branchId);
            });
            $('#Updatebranch').on('change', function() {
                var branchId = $(this).val();
                console.log(branchId);
                loadStaffs(branchId);
            });
        });

        function loadStaff(branchId) {
            if (branchId) {
                $.ajax({
                    url: '/api/branch-wiseStaff/' + branchId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $enqTakenBy = $('#show_members');
                        console.log(data);
                        selectize.clearOptions();
                        $enqTakenBy.empty();
                        $enqTakenBy.append('<option value="">Select Members</option>');
                        $.each(data, function(key, value) {
                            selectize.addOption({
                                value: value.id,
                                text: value.name
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#show_members').empty();
                $('#show_members').append('<option value="">Select Members</option>');
            }
        }

        //branch wise staff in update 

        

       

        function loadStaffs(branchId) {
            if (branchId) {
                $.ajax({
                    url: '/api/branch-wiseStaff/' + branchId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $enqTakenBy = $('#update_members');
                        console.log(data);
                        selectize1.clearOptions();
                        $enqTakenBy.empty();
                        // $enqTakenBy.append('<option value="">Select Members</option>');
                        $.each(data, function(key, value) {
                            selectize1.addOption({
                                value: value.id,
                                text: value.name
                            });
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#update_members').empty();
                $('#members').append('<option value="">Select Members</option>');
            }
        }

        //Focus First Field
        $(document).ready(function() {
            $('#groupModal').on('shown.bs.modal', function() {
                $('#Group_name').focus();
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

            ajax: "{{ route('Groups.group') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'branchName',
                    name: 'branchName'
                },
                {
                    data: 'members',
                    name: 'members'
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



        //Add Group/Team


        $("#group").validate({
            rules: {
                GroupName: {
                    required: true,
                    minlength: 2,
                    maxlength: 25,
                },
                branch_id: {
                    required: true,

                }
            },
            messages: {
                GroupName: {
                    required: "Please Enter Group/Team Name",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 25 characters",
                },
                branch: {
                    required: "Please select Branch",
                }
            },
            submitHandler: function(form) {
                var GroupName = $('#Group_name').val();
                var BranchName = $('#branchName').val();
                var GroupMembers = $('#show_members').val().join();
                var selectize = $('.staffselect')[0].selectize;

                $.ajax({
                    url: "/api/group",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        name: GroupName,
                        members: GroupMembers,
                        branch_id: BranchName,
                        "created_by": "0"
                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('#groupModal').modal('hide');
                        $('.mainContents').hide();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    selectize.clear();
                    MasterTable.ajax.reload();
                    console.log(response);
                    var GroupResult = JSON.stringify(response);
                    console.log(GroupResult);
                    var GroupResultObj = JSON.parse(GroupResult);
                    if (GroupResultObj.success == true) {
                        if (GroupResultObj.code == "0") {
                            swal("Warning", response.message, "warning");

                        } else if (GroupResultObj.code == "1") {
                            swal("Success", response.message, "success");

                        } else if (GroupResultObj.code == "2") {
                            swal("Error", response.message, "error");

                        }
                    } else {
                        swal("Some Error Occured!!!", "Please Try Again", "error");

                    }
                });
            }
        });

        //edit Group/Team
        $('#MasterTable').on('click', '.btn_edit', function() {
            var EditGroup = $(this).val();
            console.log(EditGroup);

            var settings = {
                "url": "/api/group/" + EditGroup + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var GroupResult = JSON.stringify(response);
                console.log(GroupResult);
                var Groupedit = JSON.parse(GroupResult);
                if (Groupedit.success == true) {
                    $('#groupModal').modal('show');
                    $('#group').hide();
                    $('#update_group').show();
                    var groupDataArray = Groupedit.groups;
                    for (const key in groupDataArray) {
                        var GroupName = groupDataArray['name'];
                        var GroupMembers = groupDataArray['members'];
                        var GroupBranch = groupDataArray['branch_id'];
                        var GroupId = groupDataArray['id'];

                    }
                    $("#update_group_id").val(GroupId);
                    $("#update_Group_name").val(GroupName);
                    $("#Updatebranch").val(GroupBranch);
                    var Upselectize = $('.upgroupselect')[0].selectize;
                    var Updategroup = GroupMembers.split(",");
                    Upselectize.setValue(Updategroup);
                }
            });



        });



        //Update Group/Team

        $("#update_group").validate({
            rules: {
                UpdateGroupName: {
                    required: true,
                    minlength: 2,
                    maxlength: 25,
                }
            },
            messages: {
                UpdateGroupName: {
                    required: "Please Enter Group/Team Name",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 25 characters",
                }
            },
            submitHandler: function(form) {
                var UpdateId = $('#update_group_id').val();
                var UpdateGroupName = $('#update_Group_name').val();
                var UpdateBranchName = $('#Updatebranch').val();
                var UpdateGroupMember = $('#update_members').val().join();
                var Updateselectize = $('.upgroupselect')[0].selectize;


                $.ajax({
                    url: "/api/group/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        name: UpdateGroupName,
                        members: UpdateGroupMember,
                        branch_id: UpdateBranchName,
                        "updated_by": "2"

                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('#groupModal').modal('hide');
                        $('.mainContents').hide();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                    },
                }).done(function(response) {
                    $('.mainContents').show();
                    $('.loader').hide();
                    Updateselectize.clear();
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

        //Delete Group/Team
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
                        url: "/api/group/" + DeleteEnType,
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

        //View Group/Team
        $('#MasterTable').on('click', '.btn_view', function() {
            var ViewGroup = $(this).val();
            console.log(ViewGroup);

            var settings = {
                "url": "/api/group/" + ViewGroup + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var GroupResult = JSON.stringify(response);
                console.log(GroupResult);
                var GroupView = JSON.parse(GroupResult);
                if (GroupView.success == true) {
                    $('#GroupViewModal').modal('show');
                    $('#View_group').show();
                    var groupDataArray = GroupView.groups;
                    for (const key in groupDataArray) {
                        var GroupName = groupDataArray['name'];
                        var GroupMembers = groupDataArray['members'];
                        var GroupId = groupDataArray['id'];

                    }
                    $("#update_group_id").val(GroupId);
                    $("#View_Group_name").val(GroupName);
                    var Upselectize = $('.Viewgroupselect')[0].selectize;
                    var Updategroup = GroupMembers.split(",");
                    Upselectize.setValue(Updategroup);
                }
            });
        });

        //modal close function
        $(".addUpdateModal").on("hidden.bs.modal", function() {
            $(".UpdateForm").hide();
            $(".AddForm").show();
            $(".UpdateForm")[0].reset();
            $(".AddForm")[0].reset();
        });
    </script>

</body>

</html>
