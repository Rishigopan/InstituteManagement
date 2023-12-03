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

        <div class="container-fluid px-4 ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Branch</h4>
            <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">OP</li>
                    </ol> -->

        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                        <div>
                            <h5 class="pt- "> Branch Details</h5>
                        </div>
                    </div>
                    <form class="EditBranch UpdateForm" id="edit_branch" novalidate>
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-12">
                                <input type="hidden" id="update_id" value="{{ $branch->id }}">

                                <label class="mt-2 mb-1 inputlabel">Branch Name<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="branch_name"
                                    value="{{ $branch->branch_name }}"name="BranchName" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Code<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="code" name="Code"
                                    value="{{ $branch->code }}" placeholder="" autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Communication Address</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Address<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="caddress"
                                    name="CAddress" placeholder="" value="{{ $branch->communication_address }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Lan Line No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_lan_line"
                                    name="CLanLine" placeholder="" value="{{ $branch->communication_lan_line_no }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Pin Code</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="c_post_office"
                                    name="CPostOffice" placeholder="" value="{{ $branch->communication_post_office }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_mob_no" name="CMobNo"
                                    placeholder=""value="{{ $branch->communication_mobile_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="c_email_id"
                                    name="CEmailId" placeholder="" value="{{ $branch->communication_email }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="C_lan_mark"
                                    name="CLanMark" placeholder="" value="{{ $branch->communication_lan_mark }}"
                                    autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Permanant Address</h5>
                                </div>
                            </div>
                            <div><input type="checkbox" class="form-check-input" id="sameas"
                                    onchange="addressFunction()" />&nbsp; <label class="form-check-label"
                                    for="sameas">Same As Above</label></div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Address</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="address"
                                    name="Address" placeholder="" value="{{ $branch->permanent_address }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Lan Line No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="permanent_lan_line_no"
                                    name="LanNo" placeholder="" value="{{ $branch->permanent_lan_line_no }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Post Office</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="post_office"
                                    name="PostOffice" placeholder="" value="{{ $branch->permanent_post_office }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="mob_no"
                                    name="MobileNo" placeholder="" value="{{ $branch->permanent_mobile_no }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="email_id"
                                    name="EmailId" placeholder="" value="{{ $branch->permanent_email }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="Land_mark"
                                    name="LandMark" placeholder=""
                                    value="{{ $branch->permanent_lan_mark }}"autofocus>
                            </div>

                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Other Info</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">GST No</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="gst_no"
                                    name="GSTNo" placeholder="" value="{{ $branch->gst_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Website</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="website"
                                    name="Wedsite" placeholder="" value="{{ $branch->website }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">State</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="state"
                                    name="State" placeholder="" value="{{ $branch->state }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Pan No</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="pan_no"
                                    name="PanNo" placeholder="" value="{{ $branch->pan_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Country</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="country"
                                    name="Country" placeholder="" value="{{ $branch->country }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Location</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="location"
                                    name="Location" placeholder="" value="{{ $branch->location }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Print Heading</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="print_heading"
                                    name="PrintHeading" placeholder="" value="{{ $branch->headding }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Print Sub-Heading</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="print_sub_heading"
                                    name="PrintSubHeading" placeholder="" value="{{ $branch->subheading }}"
                                    autofocus>
                            </div>

                            <input type="hidden" id="created_by" value="0">
                            <input type="hidden" id="updated_by" value="0">

                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Update</button>
                            </div>

                        </div>
                    </form>
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
                                class="btn btn_save responsebtn mt-4 px-5 py-2"
                                data-bs-dismiss="modal">Proceed</button>
                            <button type="button" id="btnClose" class="btn btn_save responsebtn mt-4 px-5 py-2"
                                data-bs-dismiss="modal">Okay</button>
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
        function addressFunction() {
            if (document.getElementById('sameas').checked) {
                document.getElementById('address').value = document.getElementById('caddress').value;
                document.getElementById('permanent_lan_line_no').value = document.getElementById('c_lan_line').value;
                document.getElementById('post_office').value = document.getElementById('c_post_office').value;
                document.getElementById('mob_no').value = document.getElementById('c_mob_no').value;
                document.getElementById('email_id').value = document.getElementById('c_email_id').value;
                document.getElementById('Land_mark').value = document.getElementById('C_lan_mark').value;
            } else {
                document.getElementById('caddress').value = "";

            }
        }

        $(document).on('click', '#btnConfirm', function() {
            location.replace("{{ url('/BranchTable') }}")
        });


        //Update Enquiry Type
        $("#edit_branch").validate({
            submitHandler: function(form) {
                var UpdateId = $('#update_id').val();
                var UpdateName = $('#branch_name').val();
                var UpdateCode = $('#code').val();
                var UpdateAddress = $('#address').val();
                var UpdateLan = $('#permanent_lan_line_no').val();
                var UpdateLanMark = $('#Land_mark').val();
                var UpdateEmail = $('#email_id').val();
                var UpdateMobile = $('#mob_no').val();
                var UpdatePost = $('#post_office').val();
                var UpdateCAddress = $('#caddress').val();
                var UpdateCLan = $('#c_lan_line').val();
                var UpdateCEmail = $('#c_email_id').val();
                var UpdateCMobile = $('#c_mob_no').val();
                var UpdateCPost = $('#c_post_office').val();
                var UpdateClanmark = $('#C_lan_mark').val();
                var UpdateGst = $('#gst_no').val();
                var UpdatePan = $('#pan_no').val();
                var UpdateWeb = $('#website').val();
                var UpdateState = $('#state').val();
                var UpdateCountry = $('#country').val();
                var UpdateLocation = $('#location').val();
                var UpdateHeading = $('#print_heading').val();
                var UpdateSubheading = $('#print_sub_heading').val();

                var Updatedby = $('#updated_by').val();
                console.log(UpdateId, UpdateName, UpdateCode, UpdateAddress, UpdateLan, UpdateLanMark,
                    UpdateEmail,
                    UpdateMobile, UpdatePost, UpdateCAddress, UpdateCLan, UpdateCEmail, UpdateCMobile,
                    UpdateCPost,
                    UpdateClanmark, UpdateGst, UpdatePan, UpdateWeb, UpdateState, UpdateCountry,
                    UpdateLocation, Updatedby);

                $.ajax({

                    url: "/api/branch/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "branch_name": UpdateName,
                        "code": UpdateCode,
                        "permanent_address": UpdateAddress,
                        "permanent_mobile_no": UpdateMobile,
                        "permanent_lan_line_no": UpdateLan,
                        "permanent_email": UpdateEmail,
                        "permanent_post_office": UpdatePost,
                        "permanent_lan_mark": UpdateLanMark,
                        "communication_address": UpdateCAddress,
                        "communication_mobile_no": UpdateCMobile,
                        "communication_lan_line_no": UpdateCLan,
                        "communication_email": UpdateCEmail,
                        "communication_post_office": UpdateCPost,
                        "communication_lan_mark": UpdateClanmark,
                        "gst_no": UpdateGst,
                        "pan_no": UpdatePan,
                        "website": UpdateWeb,
                        "country": UpdateCountry,
                        "state": UpdateState,
                        "location": UpdateLocation,
                        "headding": UpdateHeading,
                        "subheading": UpdateSubheading,
                        "updated_by": Updatedby
                    },
                    beforeSend: function() {
                        $('.loader').show();
                    },
                }).done(function(response) {
                    $('.loader').hide();
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
      








        // $(document).on('submit','#patient_record',(function(e){
        //     e.preventDefault();
        //     var UpdateId = $('#update_id').val();                
        //     var UpdateName = $('#branch_name').val();
        //     var UpdateCode = $('#code').val();

        //     var UpdateAddress = $('#address').val();
        //     var UpdateLan = $('#permanent_lan_line_no').val();
        //     var UpdateLanMark = $('#Land_mark').val();
        //     var UpdateEmail = $('#post_office').val();
        //     var UpdateMobile = $('#mob_no').val();
        //     var UpdatePost = $('#email_id').val();
        //     var UpdateCAddress = $('#caddress').val();
        //     var UpdateCLan = $('#c_lan_line').val();
        //     var UpdateCEmail = $('#c_post_office').val();
        //     var UpdateCMobile = $('#c_mob_no').val();
        //     var UpdateCPost = $('#c_email_id').val();
        //     var UpdateClanmark = $('#C_lan_mark').val();

        //     var UpdateGst = $('#gst_no').val();
        //     var UpdatePan = $('#pan_no').val();
        //     var UpdateWeb = $('#website').val();
        //     var UpdateState = $('#state').val();
        //     var UpdateCountry = $('#country').val();
        //     var UpdateLocation = $('#location').val();
        //     var UpdateHeading = $('#print_heading').val();
        //     var UpdateSubHeading = $('#print_sub_heading').val();
        //     var UpdatedDy = $('#updated_by').val();


        //     $.ajax({

        //         url: "http://127.0.0.1:8000/api/branch/"+ UpdateId +"",
        //         method: "PUT",
        //         timeout: 0,
        //         headers: {
        //             "Accept": "application/json",
        //             "Content-Type": "application/x-www-form-urlencoded"
        //         },
        //         data: {
        //             branch_name: UpdateName,
        //             communication_address: UpdateCAddress,
        //             communication_mobile_no:UpdateCMobile ,
        //             communication_lan_line_no: UpdateCLan,
        //             communication_email:UpdateCEmail ,
        //             communication_post_office:UpdateCPost,
        //             communication_lan_mark:UpdateClanmark,
        //             gst_no: UpdateGst,
        //             pan_no:UpdatePan,
        //             website: UpdateWeb,
        //             country: UpdateCountry,
        //             state: UpdateState,
        //             location:UpdateLocation,
        //             permanent_lan_line_no: UpdateLan,
        //             code: UpdateCode,
        //             permanent_address:UpdateAddress ,
        //             permanent_mobile_no: UpdateMobile,
        //             permanent_email: UpdateEmail,
        //             permanent_post_office:UpdatePost,
        //             permanent_lan_mark:UpdateLanMark,
        //             headding: UpdateHeading,
        //             subheading: UpdateSubHeading,
        //             updated_by: UpdatedDy

        //         },
        //         beforeSend: function() {

        //             $('#relation_modal').modal('hide');
        //             $('.mainContents').hide();
        //             $('#ResponseImage').html("");
        //             $('#ResponseText').text("");
        //         },
        //     }).done(function (response) {
        //         $('.mainContents').show();
        //         $('.loader').hide();

        //         console.log(response);
        //         var CoTypeUpdate = JSON.stringify(response);
        //         console.log(CoTypeUpdate);

        //         var CoTypeUpdateed = JSON.parse(CoTypeUpdate);
        //             if (CoTypeUpdateed.success == true) {
        //                 if (CoTypeUpdateed.code == "0") {
        //                 $('#ResponseImage').html('<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">');
        //                 $('#ResponseText').text("Relation is Already Present");
        //                 $('#ResponseModal').modal('show');
        //             } else if (CoTypeUpdateed.code == "1") {
        //                 $('#ResponseImage').html('<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">');
        //                 $('#ResponseText').text("Successfully Updated Relation");
        //                 $('#ResponseModal').modal('show');
        //             } else if (CoTypeUpdateed.code == "2") {
        //                 $('#ResponseImage').html('<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">');
        //                 $('#ResponseText').text("Failed Update Relation");
        //                 $('#ResponseModal').modal('show');
        //             }
        //         } 
        //         else 
        //         {
        //             $('#ResponseImage').html('<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">');
        //             $('#ResponseText').text("Some Error Occured, Please refresh the page (ERROR : 12ENJ)");
        //             $('#ResponseModal').modal('show');
        //         }  
        //         });
        //     }));
    </script>




</body>

</html>
