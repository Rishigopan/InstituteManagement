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
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Organization</h4>
        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <form class="UpdateOrganization" id="update_organization" novalidate>
                        <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                            <div>
                                <h5 class="pt- "> Organization Details</h5>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-12">
                                <input type="hidden" id="update_id" value="{{ $org->id }}">

                                <label class="mt-2 mb-1 inputlabel">Organization Name<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="organization_name"
                                    name="OrganizationName" placeholder="" value="{{ $org->organization_name }}"
                                    autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Code<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="code" name="Code"
                                    placeholder="" value="{{ $org->code }}" autofocus required>
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
                                    name="CAddress" placeholder="" value="{{ $org->communication_address }}" autofocus
                                    required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Tele Phone</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_lan_line"
                                    name="CLanLine" placeholder="" value="{{ $org->communication_lan_line_no }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Post Office</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="c_post_office"
                                    name="CPostOffice" placeholder="" value="{{ $org->communication_post_office }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="c_mob_no" name="CMobNo"
                                    placeholder=""value="{{ $org->communication_mobile_no }}" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control mt-1 inputfield" id="c_email_id"
                                    name="CEmailId" placeholder="" value="{{ $org->communication_email }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control  inputfield" id="C_lan_mark" name="CLanMark"
                                    placeholder="" value="{{ $org->communication_lan_mark }}" autofocus>
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
                                <input type="text" class="form-control  inputfield" id="address" name="Address"
                                    placeholder="" value="{{ $org->permanent_address }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Tele Phone</label><br>
                                <input type="number" class="form-control mt-1 inputfield" id="permanent_lan_line_no"
                                    name="LanNo" placeholder="" value="{{ $org->permanent_lan_line_no }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Post Office</label><br>
                                <input type="text" class="form-control  inputfield" id="post_office"
                                    name="PostOffice" placeholder="" value="{{ $org->permanent_post_office }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Mobile No<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="number" class="form-control  inputfield" id="mob_no"
                                    name="MobileNo" placeholder="" value="{{ $org->permanent_mobile_no }}"
                                    autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Email Id</label><br>
                                <input type="email" class="form-control  inputfield" id="email_id" name="EmailId"
                                    placeholder="" value="{{ $org->permanent_email }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Lan Mark</label><br>
                                <input type="text" class="form-control  inputfield" id="Land_mark"
                                    name="LandMark" placeholder="" value="{{ $org->permanent_lan_mark }}"autofocus>
                            </div>
                            <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                <div>
                                    <h5 class="pt- ">Other Info</h5>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">GST No</label><br>
                                <input type="text" class="form-control  inputfield" id="gst_no" name="GSTNo"
                                    placeholder="" value="{{ $org->gst_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Website</label><br>
                                <input type="text" class="form-control  inputfield" id="website" name="Wedsite"
                                    placeholder="" value="{{ $org->website }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">State</label><br>
                                <input type="text" class="form-control  inputfield" id="state" name="State"
                                    placeholder="" value="{{ $org->state }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Pan No</label><br>
                                <input type="text" class="form-control  inputfield" id="pan_no" name="PanNo"
                                    placeholder="" value="{{ $org->pan_no }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Country</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="country"
                                    name="Country" placeholder="" value="{{ $org->country }}" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-3 mb-1 inputlabel">Location</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="location"
                                    name="Location" placeholder="" value="{{ $org->location }}" autofocus>
                            </div>
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
        $(document).on('click', '#btnConfirm', function() {
            location.replace("{{ url('/OrganizationTable') }}")
        });

        //Update Organization
        $("#update_organization").validate({
            submitHandler: function(form) {
                var UpdateId = $('#update_id').val();
                var UpdateName = $('#organization_name').val();
                var UpdateCode = $('#code').val();
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
                var UpdateGst = $('#gst_no').val();
                var UpdatePan = $('#pan_no').val();
                var UpdateWeb = $('#website').val();
                var UpdateState = $('#state').val();
                var UpdateCountry = $('#country').val();
                var UpdateLocation = $('#location').val();
                var Updatedby = $('#updated_by').val();
                console.log(UpdateId, UpdateName, UpdateCode, UpdateAddress, UpdateLan, UpdateLanMark,
                    UpdateEmail,
                    UpdateMobile, UpdatePost, UpdateCAddress, UpdateCLan, UpdateCEmail, UpdateCMobile,
                    UpdateCPost,
                    UpdateClanmark, UpdateGst, UpdatePan, UpdateWeb, UpdateState, UpdateCountry,
                    UpdateLocation, Updatedby);

                $.ajax({

                    url: "/api/organization/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "organization_name": UpdateName,
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
