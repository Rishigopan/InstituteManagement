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
            <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">OP</li>
                    </ol> -->

        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="text-end">
                        <a href="{{ url('/ParentInfo') }}">
                            <button class="btn AddBtn px-4">View</button>
                        </a>
                    </div>
                    <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                        <div>
                            <h5 class="pt- ">Parent Details</h5>
                        </div>
                    </div>
                    <form class="Parent AddForm" id="parent_add" novalidate>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Father's Name<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="father_name"
                                    name="FatherName" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mother's Name<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="mother_name"
                                    name="MotherName" placeholder="" autofocus reuired>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Primary Mobile No<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="p_mob_no" name="PMobNo"
                                    placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Secondary Mobile No<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="s_mob_no" name="SMobNo"
                                    placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Primary Email Id<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="p_email_id"
                                    name="PEmailId" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Secondary Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="s_email_id"
                                    name="SEmailId" placeholder="" autofocus>
                            </div>



                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Communication Address</h5>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Address</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="caddress"
                                    name="CAddress" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Tele Phone</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_lan_line"
                                    name="CLanLine" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Pin Code</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="c_post_office"
                                    name="CPostOffice" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_mob_no" name="CMobNo"
                                    placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="c_email_id"
                                    name="CEmailId" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="C_lan_mark"
                                    name="CLanMark" placeholder="" autofocus>
                            </div>

                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Permanent Address</h5>
                                </div>
                            </div>
                            <div><input type="checkbox" class="form-check-input" id="sameas"
                                    onchange="addressFunction()" />&nbsp; <label class="form-check-label"
                                    for="sameas">Same As Above</label></div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Address</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="address"
                                    name="Address" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Tele Phone</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="lan_no"
                                    name="LanNo" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Pin Code</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="post_office"
                                    name="PostOffice" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="mob_no"
                                    name="MobileNo" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="email_id"
                                    name="EmailId" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="Land_mark"
                                    name="LandMark" placeholder="" autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Other Info</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Father's occupation</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="father_occupation"
                                    name="FatherOccupation" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mother's occupation</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="mother_occupation"
                                    name="MotherOccupation" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Country</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="country"
                                    name="Country" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">State</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="state"
                                    name="State" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Location</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="location"
                                    name="Location" placeholder="" autofocus>
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
                                    name="LoginUserName" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Login Password<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="login_password"
                                    name="LoginPassword" placeholder="" autofocus required>
                            </div>
                            <input type="hidden" id="created_by" value="0">
                            <input type="hidden" id="updated_by" value="0">
                            <div class=" text-end mt-3">
                                <button type="submit" class="btn savebtn  px-5 ">Save</button>
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
                                class="btn btn_save mt-4 px-5 py-2" data-bs-dismiss="modal">Proceed</button>
                            <button type="button" id="btnClose" class="btn btn_save savebtn mt-4 px-5 py-2"
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

        function addressFunction() {
            if (document.getElementById('sameas').checked) {
                document.getElementById('address').value = document.getElementById('caddress').value;
                document.getElementById('lan_no').value = document.getElementById('c_lan_line').value;
                document.getElementById('post_office').value = document.getElementById('c_post_office').value;
                document.getElementById('mob_no').value = document.getElementById('c_mob_no').value;
                document.getElementById('email_id').value = document.getElementById('c_email_id').value;
                document.getElementById('Land_mark').value = document.getElementById('C_lan_mark').value;
            } else {
                document.getElementById('caddress').value = "";

            }
        }






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
 //Add Parent Info

        $("#parent_add").validate({
            rules: {
                PMobNo: {
                    required: true,
                    minlength: 2,
                    maxlength: 15,
                },
                SMobNo: {
                    // required: true,
                    minlength: 2,
                    maxlength: 15,
                },
                MobileNo: {
                    // required: true,
                    minlength: 2,
                    maxlength: 15,
                }
            },
            messages: {
                PMobNo: {
                    required: "Please Enter Valid Phone Number",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 15 characters",
                },
                SMobNo: {
                    // required: "Please Enter Valid Phone Number",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 15 characters",
                },
                MobileNo: {
                    // required: "Please Enter Valid Phone Number",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 15 characters",
                },
            },



            submitHandler: function(form) {
                var FatherName = $('#father_name').val();
                var Pmobile = $('#p_mob_no').val();
                var Pmail = $('#p_email_id').val();
                var MotherName = $('#mother_name').val();
                var SMobileNo = $('#s_mob_no').val();
                var SEmailId = $('#s_email_id').val();
                var Address = $('#address').val();
                var Lanline = $('#lan_no').val();
                var PostOffice = $('#post_office').val();
                var MobileNo = $('#mob_no').val();
                var EmailId = $('#email_id').val();
                var LandMark = $('#Land_mark').val();
                var CAddress = $('#caddress').val();
                var CLanLine = $('#c_lan_line').val();
                var CPostOffice = $('#c_post_office').val();
                var CMobNo = $('#c_mob_no').val();
                var CEmailId = $('#c_email_id').val();
                var CLanMark = $('#C_lan_mark').val();
                var FatherOccupation = $('#father_occupation').val();
                var Country = $('#country').val();
                var Location = $('#location').val();
                var MotherOccupation = $('#mother_occupation').val();
                var State = $('#state').val();
                var username = $('#login_user_name').val();
                var loginpassword = $('#login_password').val();
                var createdby = $('#created_by').val();

                $.ajax({
                    url: "/api/parentinfo",
                    method: "POST",
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
                        "permanent_address": Address,
                        "permanent_mobile_no": MobileNo,
                        "permanent_lan_line_no": Lanline,
                        "permanent_email": EmailId,
                        "permanent_post_office": PostOffice,
                        "permanent_lan_mark": LandMark,
                        "communication_address": CAddress,
                        "communication_mobile_no": CMobNo,
                        "communication_lan_line_no": CLanLine,
                        "communication_email": CEmailId,
                        "communication_post_office": CPostOffice,
                        "communication_lan_mark": CLanMark,
                        "father_occupation": FatherOccupation,
                        "mother_occupation": MotherOccupation,
                        "country": Country,
                        "state": State,
                        "location": Location,
                        "user_name": username,
                        "password": loginpassword,
                        "created_by": createdby
                    },
                    beforeSend: function() {
                        $('.loader').show();
                    },
                }).done(function(response) {
                    $('.loader').hide();
                    $(".AddForm")[0].reset();
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
    </script>

</body>

</html>
