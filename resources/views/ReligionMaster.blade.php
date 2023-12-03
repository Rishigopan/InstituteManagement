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

        <main id="main" class="main">

            <div class="modal fade addUpdateModal" id="religion_modal" tabindex="-1" data-bs-backdrop="static"               data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content cntrymodalbg">
                        <div class="modal-header modelhead py-2">
                            <h6 class="modal-title" id="exampleModalLabel">Religion</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="Religion AddForm" id="religion" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <label class="mt-2 mb-1 inputlabel">Name<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="text" class="form-control mt-1 inputfield" id="religion_name" name="ReligionName" placeholder="Enter Religion Name" autofocus required>
                                    </div>                           
                                    <div class=" col-12">
                                        <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                        <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="remarks" name="Remarks" placeholder="Enter Remarks"></textarea>
                                    </div>                            
                                </div>
                                <div class=" text-end mt-3">
                                    <button type="submit" class="btn savebtn  px-5 ">Save</button>
                                </div>
                            </form>    
                            <form class="UpdateReligion UpdateForm" id="update_religion" style="display: none;" novalidate>
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <input type="hidden"  id="update_religion_id" >
                                        <label class="mt-2 mb-1 inputlabel">Name<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="text" class="form-control mt-1 inputfield" id="update_religion_name" name="UpdateReligionName"  autofocus required>
                                    </div>                           
                                    <div class=" col-12">
                                        <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                        <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="update_remarks" name="UpdateRemarks" ></textarea>
                                    </div>    
                                    <input type="hidden"  id="updated_by" value="0" >                           
                                </div>
                                <div class=" text-end mt-3">
                                    <button type="submit" class="btn savebtn  px-5 ">Update</button>
                                </div>
                            </form>                                 
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade addUpdateModal " id="religionViewModal" tabindex="-1" data-bs-backdrop="static"               data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content cntrymodalbg">
                        <div class="modal-header modelhead py-2">
                            <h6 class="modal-title" id="exampleModalLabel">Religion</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="ViewReligion " id="view_religion" style="display: none;" novalidate>
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <input type="hidden"  id="view_religion_id" >
                                        <label class="mt-2 mb-1 inputlabel">Name</label><br>
                                        <input  disabled class="form-control mt-1 inputfield" id="view_religion_name" name="ViewReligionName"  autofocus required>
                                    </div>                           
                                    <div class=" col-12">
                                        <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                                        <textarea  disabled cols="30" rows="2" class="form-control mt-1 inputfield" id="view_remarks" name="ViewRemarks" ></textarea>
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
            <!-- Modal -->
            <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <h4 class="text-center">Do you want to delete this Religion?</h4>
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
            
                <div class="container-fluid px-4 ">
                    <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Religion </h4>                                      
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
                                    <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                                </div>
                                <div class="">
                                    <button class="btn AddBtn px-4" data-bs-toggle="modal" data-bs-target="#religion_modal">+  Add</button> 
                                    {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                                </div>
                            </div>
                           
                            <div class="table-responsive">
                                <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                    <thead class=" tablehead">
                                        <tr>
                                            <th class="text-center">Si No</th>
                                            <th class="text-center">Name</th>
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
                    <img class="img-fluid" src="{{url('assets/images/loading.gif')}}">
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
                ajax: "{{ route('religion.Religion') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'}, 
                    {data: 'remarks', name: 'remarks'},                  
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

//Searchbar
$('#SearchBar').keyup(function() {
                    MasterTable.search($(this).val()).draw();
                });
            //Add Enquiry Type

           
        $("#religion").validate({
            rules: {
                ReligionName: {
                    required: true,
                    minlength: 2,
                    maxlength: 25,
                }
            },
            messages: {
                ReligionName: {
                    required: "Please Enter Religion Name",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 25 characters",
                }
            },
            submitHandler: function(form) {
                var religionName = $('#religion_name').val();
                var religionRemark = $('#remarks').val();
                $.ajax({
                    url: "/api/religion",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        name: religionName,
                        remarks: religionRemark,
                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('#religion_modal').modal('hide');
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

        //edit Enquiry type
        $('#MasterTable').on('click', '.btn_edit', function() {
            var EditReligion = $(this).val();
            console.log(EditReligion);

            var settings = {
                "url": "/api/religion/" + EditReligion + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax(settings).done(function(response) {
                console.log(response);
                var ReligionResult = JSON.stringify(response);
                console.log(ReligionResult);
                var Religionedit = JSON.parse(ReligionResult);
                if (Religionedit.success == true) {
                    $('#religion_modal').modal('show');
                    $('#religion').hide();
                    $('#update_religion').show();
                    var CoTypeDataArray = Religionedit.religions;
                    for (const key in CoTypeDataArray) {
                        var ReligionName = CoTypeDataArray['name'];
                        var ReligionRemark = CoTypeDataArray['remarks'];
                        var ReligionId = CoTypeDataArray['id'];

                    }
                    $("#update_religion_id").val(ReligionId);
                    $("#update_religion_name").val(ReligionName);
                    $("#update_remarks").val(ReligionRemark);
                }
            });



        });



        //Update Enquiry Type

        $("#update_religion").validate({
            rules: {
                UpdateReligionName: {
                    required: true,
                    minlength: 2,
                    maxlength: 25,
                }
            },
            messages: {
                UpdateReligionName: {
                    required: "Please Enter Religion Name",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 25 characters",
                }
            },
            submitHandler: function(form) {
                var UpdateId = $('#update_religion_id').val();
                var UpdateReligionName = $('#update_religion_name').val();
                var UpdateReligionRemark = $('#update_remarks').val();
                var UpdatedDy = $('#updated_by').val();


                $.ajax({

                    url: "/api/religion/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        name: UpdateReligionName,
                        remarks: UpdateReligionRemark,
                        updated_by: UpdatedDy

                    },
                    beforeSend: function() {

                        $('#religion_modal').modal('hide');
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

        //Delete Course Type
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
                        url: "/api/religion/" + DeleteEnType,
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
             $('#MasterTable').on('click', '.btn_view', function () {
                var ViewEnType = $(this).val();
                console.log(ViewEnType);
                var settings = {
                "url": "/api/religion/"+ViewEnType+"",
                "method": "GET",
                "timeout": 0,
                };

                $.ajax(settings).done(function (response) {
                console.log(response);
                var EnResult = JSON.stringify(response);
                    console.log(EnResult);
                    var Enedit = JSON.parse(EnResult);
                    if (Enedit.success == true) {
                        $('#religionViewModal').modal('show');                       
                        $('#view_religion').show();
                        var EnDataArray = Enedit.religions;
                        for(const key in EnDataArray){
                            var ReligionsName = EnDataArray['name'];
                            var ReligionsRemark = EnDataArray['remarks'];
                            var ReligionsId = EnDataArray['id'];

                        }
                        $("#view_religion_id").val(ReligionsId);
                        $("#view_religion_name").val(ReligionsName);
                        $("#view_remarks").val(ReligionsRemark);
                    }
                });
               
            });

            
                    

          
        </script>
    </body>

</html>