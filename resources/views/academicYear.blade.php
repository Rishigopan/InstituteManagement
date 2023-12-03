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


        <div class="modal fade addUpdateModal" id="AcademicyearModal" tabindex="-1"
            data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Academic Year</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Year AddForm" id="add_year" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Academic Year<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="number" class="form-control mt-1 inputfield" id="academic_year"
                                        name="Academic_year" placeholder="Enter Academic Year" autofocus required>
                                </div>
                                <div class=" col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                    <textarea cols="30" rows="2" class="form-control mt-1 inputfield" id="remark" name="Remark"
                                        placeholder="Enter Remarks"></textarea>
                                </div>
                            </div>
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
                            </div>
                        </form>
                        <form class="UpdateYear UpdateForm" id="update_year_id" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <input type="hidden" id="update_year_id">
                                    <label class="mt-2 mb-1 inputlabel">Academic Year<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="number" class="form-control mt-1 inputfield" id="update_academic_year"
                                        name="UpdateAcademicYear" autofocus required>
                                </div>
                                <div class=" col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                    <textarea cols="30" rows="2" class="form-control mt-1 inputfield" id="update_remark" name="UpdateRemark"></textarea>
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

        <div class="modal fade " id="YearViewModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Academic Year</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Viewyear " id="view_year" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <input type="hidden" id="view_year_id">
                                    <label class="mt-2 mb-1 inputlabel">Academic Year</label><br>
                                    <input disabled class="form-control mt-1 inputfield" id="view_academic_year"
                                        name="ViewYear" autofocus required readonly>
                                </div>
                                <div class=" col-12">
                                    <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                    <textarea disabled cols="30" rows="2" class="form-control mt-1 inputfield" id="view_remark"
                                        name="ViewRemark" readonly></textarea>
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
        <!-- Delete Modal -->
        <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Do you want to delete this Year?</h4>
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
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Academic Year </h4>
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
                            <button class="btn AddBtn px-4" data-bs-toggle="modal"
                                data-bs-target="#AcademicyearModal">+ Add</button>
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
                                    <th class="text-center">Academic Year</th>
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




            ajax: "{{ route('academicYear.AcademicYear') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'year',
                    name: 'year'
                },
                {
                    data: 'remark',
                    name: 'remark'
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


        //Add Academic Year

        //Add Academic Year

        $("#add_year").validate({
            rules: {
                AcademicYear: {
                    required: true,
                    minlength: 2,
                    maxlength: 25,
                }
            },
            messages: {
                AcademicYear: {
                    required: "Please Enter Academic Year",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 25 characters",
                }
            },
            submitHandler: function(form) {
                var AcademicYear = $('#academic_year').val();
                var AcademicYearRemark = $('#remark').val();
                $.ajax({
                        url: "/api/academicYear",
                        method: "POST",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        data: {
                            year: AcademicYear,
                            remark: AcademicYearRemark,

                        },



                        beforeSend: function() {
                            $('.loader').show();
                            $('#AcademicyearModal').modal('hide');
                            $('.mainContents').hide();

                        },
                    })
                    .done(function(response) {
                        $('.mainContents').show();
                        $('.loader').hide();
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
                        } else {
                            swal("Some Error Occured!!!", "Please Try Again", "error");

                        }

                    });
            }
        });



        //edit Academic year
        $('#MasterTable').on('click', '.btn_edit', function() {
            var EditYear = $(this).val();
            console.log(EditYear);

            var settings = {
                "url": "/api/academicYear/" + EditYear + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnquiryTypeResult = JSON.stringify(response);
                console.log(EnquiryTypeResult);
                var EnquiryTypeedit = JSON.parse(EnquiryTypeResult);
                if (EnquiryTypeedit.success == true) {
                    $('#AcademicyearModal').modal('show');
                    $('#add_year').hide();
                    $('#update_year_id').show();
                    var CoTypeDataArray = EnquiryTypeedit.year;
                    for (const key in CoTypeDataArray) {
                        var AcademicYear = CoTypeDataArray['year'];
                        var AcademicYearRemark = CoTypeDataArray['remark'];
                        var YearId = CoTypeDataArray['id'];

                    }
                    $("#update_year_id").val(YearId);
                    $("#update_academic_year").val(AcademicYear);
                    $("#update_remark").val(AcademicYearRemark);
                }
            });



        });



        //Update Academic Year

        $("#update_year_id").validate({
            rules: {
                UpdateAcademicYear: {
                    required: true,
                    minlength: 2,

                }
            },
            messages: {
                UpdateAcademicYear: {
                    required: "Please Enter Academic Year",
                    minlength: "atleast 2 characters",

                }
            },
            submitHandler: function(form) {
                var UpdateId = $('#update_year_id').val();
                var UpdateAcademicYear = $('#update_academic_year').val();
                var UpdateAcademicYearRemark = $('#update_remark').val();
                var UpdatedDy = $('#updated_by').val();


                $.ajax({

                    url: "/api/academicYear/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        year: UpdateAcademicYear,
                        remark: UpdateAcademicYearRemark,
                        updated_by: UpdatedDy

                    },
                    beforeSend: function() {

                        $('#AcademicyearModal').modal('hide');
                        $('.mainContents').hide();

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

        //Delete Academic Year


        $('#MasterTable').on('click', '.btn_delete', function() {

            var DeleteEnType = $(this).val();
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                                url: "/api/academicYear/" + DeleteEnType,
                                method: "DELETE",
                                timeout: 0,
                                headers: {
                                    "Accept": "application/json",
                                    "Content-Type": "application/x-www-form-urlencoded"
                                },
                                data: {
                                    DeleteEnType: DeleteEnType
                                },
                                beforeSend: function() {
                                    $('.loader').show();
                                    $('.mainContents').hide();
                                },
                            })

                            .done(function(response) {
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
                    } else {
                        //swal("Cancelled");
                    }
                });
        });
        //View Academic Year
        $('#MasterTable').on('click', '.btn_view', function() {
            var ViewEnType = $(this).val();
            console.log(ViewEnType);
            var settings = {
                "url": "/api/academicYear/" + ViewEnType + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnResult = JSON.stringify(response);
                console.log(EnResult);
                var Enedit = JSON.parse(EnResult);
                if (Enedit.success == true) {
                    $('#YearViewModal').modal('show');
                    $('#view_year').show();
                    var EnDataArray = Enedit.year;
                    for (const key in EnDataArray) {
                        var AcademicYear = EnDataArray['year'];
                        var AcademicYearRemark = EnDataArray['remark'];
                        var YearId = EnDataArray['id'];

                    }
                    $("#view_year_id").val(YearId);
                    $("#view_academic_year").val(AcademicYear);
                    $("#view_remark").val(AcademicYearRemark);
                }
            });

        });
    </script>


</body>

</html>
