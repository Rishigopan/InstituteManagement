<!DOCTYPE html>
<html lang="en">
<style>
    .toggle-btn {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
        background-color: #ccc;
        border-radius: 10px;
    }

    .toggle-btn .toggle-checkbox {
        display: none;
    }

    .toggle-slider {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 16px;
        height: 16px;
        background-color: #1c6bf4;
        border-radius: 50%;
        transition: transform 0.2s;
    }

    .toggle-btn .toggle-checkbox:checked+.toggle-slider {
        transform: translateX(20px);
    }
</style>

<head>

    @include('layouts.headder')
    <style>
        .mainContents {
            display: none;
        }
    </style>
    {{-- @livewireStyles --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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


        <div class="modal fade addUpdateModal" id="FeeCategoryModal" tabindex="-1"
            data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Fee Category</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Fee_category AddForm" id="add_feecategory" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <label class="mt-2 mb-1 inputlabel">Fee Category<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="fee_category"
                                        name="Fee_category" placeholder="Enter Fee Category" autofocus required>
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
                        <form class="Updatefee_category UpdateForm" id="update_fee_category_id" style="display: none;"
                            novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <input type="hidden" id="update_id">
                                    <label class="mt-2 mb-1 inputlabel">Fee Category<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="text" class="form-control mt-1 inputfield" id="update_fee_category"
                                        name="UpdateFeeCategory" autofocus required>
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

        <div class="modal fade " id="FeeCategoryViewModal" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Fee Category</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="Viewfee_category" id="view_fee_category" style="display: none;" novalidate>
                            {{ csrf_field() }}
                            <div class="row">
                                <div class=" col-12">
                                    <input type="hidden" id="view_feecategory_id">
                                    <label class="mt-2 mb-1 inputlabel">Fee Category</label><br>
                                    <input disabled class="form-control mt-1 inputfield" id="view_fee_category_id"
                                        name="ViewFeeCategory" autofocus required readonly>
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



        <div class="container-fluid ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Fee Category</h4>
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
                                data-bs-target="#FeeCategoryModal">+ Add</button>
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
                                    <th class="text-center">Fee category</th>
                                    <th class="text-center">Remarks</th>
                                    <th class="text-center">Active</th>
                                    <th class="text-center">Default</th>
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




            ajax: "{{ route('fee_category.Fee_category') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'remark',
                    name: 'remark'
                },
                {
                    data: 'isActive',
                    name: 'isActive'
                },
                {
                    data: 'isDefault',
                    name: 'isDefault'
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


        //Add Fee Category

        $("#FeeCategoryModal").validate({
            rules: {
                FeeCategory: {
                    required: true,
                    minlength: 2,
                }
            },
            messages: {
                FeeCategory: {
                    required: "Please Enter Fee Type",
                    minlength: "atleast 2 characters",
                }
            },
            submitHandler: function(form) {
                var FeeCategory = $('#fee_category').val();
                var FeeCategoryRemark = $('#remark').val();
                $.ajax({
                    url: "/api/fee_category",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        category_name: FeeCategory,
                        remark: FeeCategoryRemark,

                    },



                    beforeSend: function() {
                        $('.loader').show();
                        $('#FeeCategoryModal').modal('hide');
                        $('.mainContents').hide();

                    },
                }).done(function(response) {
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

        //edit Fee Category

        $('#MasterTable').on('click', '.btn_edit', function() {
            var EditEnquiryType = $(this).val();
            console.log(EditEnquiryType);

            var settings = {
                "url": "/api/fee_category/" + EditEnquiryType + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnquiryTypeResult = JSON.stringify(response);
                console.log(EnquiryTypeResult);
                var EnquiryTypeedit = JSON.parse(EnquiryTypeResult);
                if (EnquiryTypeedit.success == true) {
                    $('#FeeCategoryModal').modal('show');
                    $('#add_feecategory').hide();
                    $('#update_fee_category_id').show();
                    var CoTypeDataArray = EnquiryTypeedit.feecat;
                    for (const key in CoTypeDataArray) {
                        var FeeCategory = CoTypeDataArray['category_name'];
                        var FeeCategoryRemark = CoTypeDataArray['remark'];
                        var FeecatId = CoTypeDataArray['id'];

                    }
                    $("#update_id").val(FeecatId);
                    $("#update_fee_category").val(FeeCategory);
                    $("#update_remark").val(FeeCategoryRemark);
                }
            });



        });



        //Update Fee Category

        $("#update_fee_category_id").validate({
            rules: {
                UpdateFeeCategory: {
                    required: true,
                    minlength: 2,

                }
            },
            messages: {
                UpdateFeeCategory: {
                    required: "Please Enter Fee Category",
                    minlength: "atleast 2 characters",

                }
            },
            submitHandler: function(form) {
                var UpdateId = $('#update_id').val();
                var UpdateFeeCategory = $('#update_fee_category').val();
                var UpdateFeeCategoryRemark = $('#update_remark').val();
                var UpdatedDy = $('#updated_by').val();


                $.ajax({

                    "url": "http://127.0.0.1:8000/api/fee_category/85",
                    "method": "PUT",
                    "timeout": 0,
                    "headers": {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        category_name: UpdateFeeCategory,
                        remark: UpdateFeeCategoryRemark,
                        updated_by: UpdatedDy

                    },
                    beforeSend: function() {

                        $('#FeeCategoryModal').modal('hide');
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

        //Delete Fee Category

        $('#MasterTable').on('click', '.btn_delete', function() {
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
                        url: "/api/fee_category/" + DeleteEnType,
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



        //View Fee Category

        $('#MasterTable').on('click', '.btn_view', function() {
            var ViewEnType = $(this).val();
            console.log(ViewEnType);
            // var settings = {
            // "url": "/api/fee_type/"+ViewEnType+"",
            // "method": "GET",
            // "timeout": 0,
            // };
            var settings = {
                "url": "http://127.0.0.1:8000/api/fee_category/" + ViewEnType + "",
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "Accept": "application/json",
                    "Content-Type": "application/x-www-form-urlencoded",
                }
            };
            $.ajax(settings).done(function(response) {
                console.log(response);
                var EnResult = JSON.stringify(response);
                console.log(EnResult);
                var Enedit = JSON.parse(EnResult);
                if (Enedit.success == true) {
                    $('#FeeCategoryViewModal').modal('show');
                    $('#view_fee_category').show();
                    var EnDataArray = Enedit.feecat;
                    for (const key in EnDataArray) {
                        var FeeCategory = EnDataArray['category_name'];
                        var FeeCategoryRemark = EnDataArray['remark'];
                        var FeecatId = EnDataArray['id'];

                    }
                    $("#view_feecategory_id").val(FeecatId);
                    $("#view_fee_category_id").val(FeeCategory);
                    $("#view_remark").val(FeeCategoryRemark);
                }
            });

        });



        // Active Toggle

        function changestatus(param) {
            var status = $(param).prop('checked') ? 1 : 0;
            var id = $(param).data('id');
            $.ajax({
                type: "post",
                dataType: "json",
                url: "{{ route('changestatus') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "status": status,
                    "id": id
                },
                success: function(data) {
                    console.log(data.success);
                }
            });
        }

        // Default Toggle

        function changeDefaultStatus(param, id) {
            if ($(param).is(':checked')) {
                // Disable all other toggles
                $('.toggle-checkbox').not(param).prop('disabled', true);

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('changedefaultstatus') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id
                    },
                    success: function(data) {
                        console.log(data.success);
                    }
                });
            } else {
                // Enable all toggles
                $('.toggle-checkbox').prop('disabled', false);

                $.ajax({
                    type: "post",
                    dataType: "json",
                    url: "{{ route('changedefaultstatus') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "isDefault": false
                    },
                    success: function(data) {
                        console.log(data.success);
                    }
                });
            }
        }
    </script>


</body>

</html>
