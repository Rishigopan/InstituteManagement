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

            <div class="modal fade addUpdateModal" id="taskcategoryModal" tabindex="-1" data-bs-backdrop="static"               data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content cntrymodalbg">
                        <div class="modal-header modelhead py-2">
                            <h6 class="modal-title" id="exampleModalLabel">Task Category</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="TaskCategory AddForm" id="taskcategory" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <label class="mt-2 mb-1 inputlabel">Name<span style="color:red; font-size:15px"> *</span></label><br>
                                        <input type="text" class="form-control mt-1 inputfield" id="task_cat_name" name="TaskCatName" placeholder="Enter  Name" autofocus required>
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
                            <form class="UpdateTaskCategory UpdateForm" id="update_taskcategory" style="display: none;" novalidate>
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <input type="hidden"  id="update_taskcategory_id" >
                                        <label class="mt-2 mb-1 inputlabel">Name<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                        <input type="text" class="form-control mt-1 inputfield" id="update_taskcategory_name" name="UpdateTaskCategoryName"  autofocus required>
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
            <div class="modal fade addUpdateModal " id="taskcategoryViewModal" tabindex="-1" data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content cntrymodalbg">
                        <div class="modal-header modelhead py-2">
                            <h6 class="modal-title" id="exampleModalLabel">Task Category</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="Viewtaskcategory" id="view_taskcategory" style="display: none;" novalidate>
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class=" col-12">
                                        <input type="hidden"  id="view_taskcategory_id" >
                                        <label class="mt-2 mb-1 inputlabel">Name</label><br>
                                        <input  disabled class="form-control mt-1 inputfield" id="view_taskcategory_name" name="ViewtaskcategoryeName"  autofocus required>
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
                <div class="modal-dialog modal-dialog-centered">
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
                <div class="container-fluid px-4 ">
                    <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Task Category</h4>              
                </div>
                <div class="wrapper">
                    <!--CONTENTS-->
                    <div class="container-fluid mainContents">
                        <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">                           
                            <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                                <div>
                                    <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                                </div>
                                <div class="">
                                    <button class="btn AddBtn px-4" data-bs-toggle="modal" data-bs-target="#taskcategoryModal">+  Add</button> 
                                    {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                    <thead class=" tablehead">
                                        <tr>
                                            <th class="text-center">Sl No</th>
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

          //Focus First Field
        $(document).ready(function() {
            $('#taskcategoryModal').on('shown.bs.modal', function() {
                $('#task_cat_name').focus();
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
                // serverSide: true,
                // scrollX: true,
                "dom": 'lrt<"bottom"ip>',
                "pagingType": 'simple_numbers',
                "language": {
                    "paginate": {
                        "previous": "<i class='bi bi-caret-left-fill'></i>",
                        "next": "<i class='bi bi-caret-right-fill'></i>"
                    }
                },    
                
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
                },

                ajax: "{{ route('Taskcategory.taskcategory') }}",
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

             //Add Task Category


            $("#taskcategory").validate({
                rules:{
                    TaskCatName:{
                        required: true,
                        minlength: 2,  
                        maxlength: 25,                    
                    }     
                },
                messages: {
                    TaskCatName:{
                        required: "This field is required",
                        minlength:"atleast 2 characters",
                        maxlength: "maximum 25 characters",
                    }
                },
                submitHandler: function(form) {
                    var TaskCatName = $('#task_cat_name').val();
                    var TaskCatRemark = $('#remarks').val();
                    $.ajax({
                        url: "/api/taskcategory",
                            method: "POST",
                            timeout: 0,
                            headers: {
                                "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                            },
                            data: {
                            name: TaskCatName,
                            remarks: TaskCatRemark,
                            "created_by": "0"
                        },
                        beforeSend: function() {
                            $('.loader').show();
                            $('#taskcategoryModal').modal('hide');
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

            //edit Task Category
            $('#MasterTable').on('click', '.btn_edit', function () {
                var EditTaskCat = $(this).val();
                console.log(EditTaskCat);

                var settings = {
                    "url": "/api/taskcategory/"+EditTaskCat+"",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax(settings).done(function (response) {
                    console.log(response);
                    var TaskCatResult = JSON.stringify(response);
                    console.log(TaskCatResult);
                    var TaskCatedit = JSON.parse(TaskCatResult);
                    if (TaskCatedit.success == true) {
                        $('#taskcategoryModal').modal('show');
                        $('#taskcategory').hide();
                        $('#update_taskcategory').show();
                        var CoTypeDataArray = TaskCatedit.taskcategories;
                        for(const key in CoTypeDataArray){
                            var TaskCatName = CoTypeDataArray['name'];
                            var TaskCatRemark = CoTypeDataArray['remarks'];
                            var TaskCatId = CoTypeDataArray['id'];

                        }
                        $("#update_taskcategory_id").val(TaskCatId);
                        $("#update_taskcategory_name").val(TaskCatName);
                        $("#update_remarks").val(TaskCatRemark);
                    }
                });

               
               
            });


              
            //Update Task Category

            $("#update_taskcategory").validate({
                rules:{
                    UpdateTaskCategoryName:{
                        required: true,
                        minlength: 2,  
                        maxlength: 25,                    
                    }     
                },
                messages: {
                    UpdateTaskCategoryName:{
                        required: "Please Enter Task Category Name",
                        minlength:"atleast 2 characters",
                        maxlength: "maximum 25 characters",
                    }
                },
                submitHandler: function(form) {
                    var UpdateId = $('#update_taskcategory_id').val();                
                    var UpdateTaskCategoryName = $('#update_taskcategory_name').val();
                    var UpdateTaskCatRemark = $('#update_remarks').val();


                    $.ajax({
                        
                        url: "/api/taskcategory/"+UpdateId+"",
                        method: "PUT",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        data: {
                        name: UpdateTaskCategoryName,
                        remarks: UpdateTaskCatRemark,
                        "updated_by": "2"

                        },
                        beforeSend: function() {
                            $('.loader').show();
                            $('#taskcategoryModal').modal('hide');
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


            //Delete Task Category
            $('#MasterTable').on('click', '.btn_delete', function () {
                var DeleteTaskCat = $(this).val();
                swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                            url: "/api/taskcategory/"+DeleteTaskCat+"",
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


             //View Task Category
             $('#MasterTable').on('click', '.btn_view', function () {
                var ViewTaskCat = $(this).val();
                console.log(ViewTaskCat);
                var settings = {
                "url": "/api/taskcategory/"+ViewTaskCat+"",
                "method": "GET",
                "timeout": 0,
                };

                $.ajax(settings).done(function (response) {
                console.log(response);
                var ViewItemCatResult = JSON.stringify(response);
                    console.log(ViewItemCatResult);
                    var ViewItemCatedit = JSON.parse(ViewItemCatResult);
                    if (ViewItemCatedit.success == true) {
                        $('#taskcategoryViewModal').modal('show');                       
                        $('#view_taskcategory').show();
                        var ViewItemCatDataArray = ViewItemCatedit.taskcategories;
                        for(const key in ViewItemCatDataArray){
                            var ViewItemCatName = ViewItemCatDataArray['name'];
                            var ViewItemCatRemark = ViewItemCatDataArray['remarks'];
                            var ViewItemCatId = ViewItemCatDataArray['id'];

                        }
                        $("#view_taskcategory_id").val(ViewItemCatId);
                        $("#view_taskcategory_name").val(ViewItemCatName);
                        $("#view_remarks").val(ViewItemCatRemark);
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