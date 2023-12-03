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
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Parent Details </h4>
        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                        <div>
                            <h5 class="pt- ">Parent Details</h5>
                        </div>
                    </div>
                    <form class="EditParentinfo UpdateForm" id="edit_parent_info" novalidate>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <input type="hidden" id="update_id" value="{{ $parent->id }}">
                                <label class="mt-2 mb-1 inputlabel">Father Name</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="father_name"
                                    name="FatherName" value="{{ $parent->father_name }}"autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mother Name</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="mother_name"
                                    name="MotherName" value="{{ $parent->mother_name }}" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Primary Mobile No</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="p_mob_no" name="PMobNo"
                                    value="{{ $parent->primary_mobile_no }}"autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Secondary Mobile No</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="s_mob_no" name="SMobNo"
                                    value="{{ $parent->secondary_mobile_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Primary Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="p_email_id"
                                    name="PEmailId" value="{{ $parent->primary_email }}" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Secondary Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="s_email_id"
                                    name="SEmailId" value="{{ $parent->secondary_email }}"autofocus>
                            </div>

                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Permanent Address</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Address</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="address" name="Address"
                                    value="{{ $parent->permanent_address }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Lan Line No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="permanent_lan_line_no"
                                    name="LanNo" value="{{ $parent->permanent_lan_line_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Post Office</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="post_office"
                                    name="PostOffice" value="{{ $parent->permanent_post_office }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="mob_no"
                                    name="MobileNo" value="{{ $parent->permanent_mobile_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="email_id" name="EmailId"
                                    value="{{ $parent->permanent_email }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="Land_mark"
                                    name="LandMark" value="{{ $parent->permanent_lan_mark }}"autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Communication Address</h5>
                                </div>
                            </div>
                            <div><input type="checkbox" class="form-check-input" id="sameas"
                                    onchange="addressFunction()" />&nbsp; <label class="form-check-label"
                                    for="sameas">Same As Above</label></div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Address</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="caddress"
                                    name="CAddress" value="{{ $parent->communication_address }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Lan Line No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_lan_line"
                                    name="CLanLine" value="{{ $parent->communication_lan_line_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Post Office</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="c_post_office"
                                    name="CPostOffice" value="{{ $parent->communication_post_office }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_mob_no"
                                    name="CMobNo"value="{{ $parent->communication_mobile_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="c_email_id"
                                    name="CEmailId" value="{{ $parent->communication_email }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="C_lan_mark"
                                    name="CLanMark" value="{{ $parent->communication_lan_mark }}" autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Other Info</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Father's Occupation</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="father_occupation"
                                    name="FatherOccupation" value="{{ $parent->father_occupation }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mother's occupation</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="mother_occupation"
                                    name="MotherOccupation" value="{{ $parent->mother_occupation }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Country</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="country"
                                    name="Country" value="{{ $parent->country }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">State</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="state"
                                    name="State" value="{{ $parent->state }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Location</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="location"
                                    name="Location" value="{{ $parent->location }}" autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Credentials</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Login User Name<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="login_user_name"
                                    name="LoginUserName" value="{{ $parent->user_name }}" autofocus required>
                            </div>
                            <!-- <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Login Password</label><br>
                                        <input type="text" class="form-control mt-1 inputfield" id="login_password" name="LoginPassword" value="{{ $parent->communication_lan_mark }}" autofocus required>
                                    </div> -->
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
                                class="btn btn_save savebtn mt-4 px-5 py-2" data-bs-dismiss="modal">Proceed</button>
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
        //loader
        $(function() {
            $(".loader").fadeOut(1500, function() {
                $(".mainContents").show();
            });
        });
        $(document).on('click', '#btnConfirm', function() {
            location.replace("{{ url('/ParentInfo') }}")
        });


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

       
        //validations
        document.getElementById('father_name').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g,
            ''); // Remove any digits and special characters from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('mother_name').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g,
            ''); // Remove any digits and special characters from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('caddress').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g, ''); // Remove any digits from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('address').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g, ''); // Remove any digits from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('Land_mark').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g, ''); // Remove any digits from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('C_lan_mark').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g, ''); // Remove any digits from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('father_occupation').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g, ''); // Remove any digits from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('father_occupation').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^a-zA-Z\s]/g, ''); // Remove any digits from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('c_post_office').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });
        document.getElementById('post_office').addEventListener('input', function(event) {
            var input = event.target;
            var value = input.value;
            var newValue = value.replace(/[^0-9]/g, ''); // Remove any non-numeric characters from the input value
            if (newValue !== value) {
                input.value = newValue;
            }
        });


        $("#edit_parent_info").validate({
            rules: {
                PMobNo: {
                    required: true,
                    maxlength: 15,
                },
                SMobNo: {
                    maxlength: 15,
                },
                LanNo: {
                    maxlength: 15,
                },
                MobileNo: {
                    maxlength: 15,
                },
                CLanLine: {
                    // required: true,
                    maxlength: 15,
                },
                CMobNo: {
                    // required: true,
                    maxlength: 15,
                }
            },

            submitHandler: function(form) {
                var UpdateId = $('#update_id').val();
                var FatherName = $('#father_name').val();
                var Pmobile = $('#p_mob_no').val();
                var Pmail = $('#p_email_id').val();
                var MotherName = $('#mother_name').val();
                var SMobileNo = $('#s_mob_no').val();
                var SEmailId = $('#s_email_id').val();
                var UpdateAddress = $('#address').val();
                var UpdateLan = $('#permanent_lan_line_no').val();
                var UpdateLanMark = $('#Land_mark').val();
                var UpdateEmail = $('#post_office').val();
                var UpdateMobile = $('#mob_no').val();
                var UpdatePost = $('#email_id').val();
                var UpdateCAddress = $('#caddress').val();
                var UpdateCLan = $('#c_lan_line').val();
                var UpdateCEmail = $('#c_post_office').val();
                var UpdateCMobile = $('#c_mob_no').val();
                var UpdateCPost = $('#c_email_id').val();
                var UpdateClanmark = $('#C_lan_mark').val();
                var FatherOccupation = $('#father_occupation').val();
                var Country = $('#country').val();
                var Location = $('#location').val();
                var MotherOccupation = $('#mother_occupation').val();
                var State = $('#state').val();
                var username = $('#login_user_name').val();

                var Updatedby = $('#updated_by').val();
                // console.log(UpdateId,UpdateName,UpdateCode,UpdateAddress,UpdateLan,UpdateLanMark,UpdateEmail,
                // UpdateMobile,UpdatePost,UpdateCAddress,UpdateCLan,UpdateCEmail,UpdateCMobile,UpdateCPost,
                // UpdateClanmark,UpdateGst,UpdatePan,UpdateWeb,UpdateState,UpdateCountry,UpdateLocation,Updatedby);

                $.ajax({

                    url: "/api/parentinfo/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "father_name": FatherName,
                        "mother_name": MotherName,
                        "primary_mobile_no": Pmobile,
                        "secondary_mobile_no": SMobileNo,
                        "primary_email": Pmail,
                        "secondary_email": SEmailId,
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
                        "father_occupation": FatherOccupation,
                        "mother_occupation": MotherOccupation,
                        "country": Country,
                        "state": State,
                        "location": Location,
                        "user_name": username,
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

                            $('#btnClose').hide();
                            $('#btnConfirm').show();
                        } else if (CoTypeUpdateed.code == "2") {
                            swal("Error", response.message, "error");

                        }
                    } else {
                        swal("Error", response.message, "error");

                    }
                });
            }
        });
    </script>





</body>

</html>
