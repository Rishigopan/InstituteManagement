<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.headder')

    <style>
        .container {
            display: flex;
            align-items: center;
            position: relative;
        }

        .content {
            flex-grow: 1;
        }

        .arrow-icon {
            position: absolute;
            right: 30px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
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

    <main id="main" class="main">
        <div class="modal fade addUpdateModal" id="splParentModal" tabindex="-1"
            data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content cntrymodalbg">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Parent</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

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
                                    <input type="number" class="form-control mt-1 inputfield" id="p_mob_no"
                                        name="PMobNo" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Secondary Mobile No<span
                                            style="color:red; font-size:15px"> *</span></label><br>
                                    <input type="number" class="form-control mt-1 inputfield" id="s_mob_no"
                                        name="SMobNo" placeholder="" autofocus>
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
                                    <input type="number" class="form-control mt-1 inputfield" id="c_mob_no"
                                        name="CMobNo" placeholder="" autofocus>
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
                                    <label class="mt-3 mb-1 inputlabel">Land Mark</label><br>
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

        <div class="container-fluid px-4 ">
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Enquiry</h4>
            <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">OP</li>
                    </ol> -->

        </div>


        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">

                    <div class="text-end">

                        <a href="{{ url('/enquiryTable') }}">
                            <button class="btn AddBtn px-4">View</button>
                        </a>
                    </div>
                    <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                        <div>
                            <h5 class="pt- ">Basic Details</h5>
                        </div>
                    </div>

                    <form class="EnquiryAdd AddForm" id="Enquiry_form" novalidate>
                        {{ csrf_field() }}
                        <label>Data Type<span style="color:red; font-size:15px" id="asterisk">*</span></label>
                        <select class="form-select inputfield" id="leadData" name="lded"
                            onchange="toggleFields()" autofocus required>
                            <option hidden class="inputlabel" value="ED">Select Datatype</option>
                            <option class="inputlabel" value="LD">Lead Data</option>
                            <option class="inputlabel" value="ED">Enquiry Data</option>
                        </select>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel formlabel" for="student_name">Student Name<span
                                        style="color:red; font-size:15px"> *</span></label>
                                <input type="text" class="form-control mt-1 inputfield" id="student_name"
                                    name="StudentName" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="mobile_no">Mobile No<span
                                        style="color:red; font-size:15px"> *</span></label>
                                <input type="number" class="form-control mt-1 inputfield" id="mobile_no"
                                    name="MobileNo" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="enq_source">Enquiry Source</label>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="enq_source" name="EnqSource" autofocus>
                                    <option hidden class="inputlabel" value=""> Choose Enquiry Source</option>
                                    @foreach ($enquiry as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="gender">Gender</label>
                                <select class="form-select inputfield"
                                    aria-label="Default select example name"id="gender" name="Gender" autofocus>
                                    <option hidden class="inputlabel" value="0"> Choose Gender</option>
                                    <option class="inputlabel" value="1"> Male</option>
                                    <option class="inputlabel" value="2"> Female</option>
                                    <option class="inputlabel" value="3"> Others</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="location">Location</label>
                                <input type="text" class="form-control  inputfield" id="Enquirylocation"
                                    name="Location" placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="branch">Branch<span
                                        style="color:red; font-size:15px"> *</span></label>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="branch" name="branch" autofocus required>
                                    <option hidden="inputlabel" value=""> Choose Branch</option>
                                    @foreach ($branch as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->branch_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="course_type">Course Type</label>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="course_type" name="CourseType">
                                    <option hidden class="inputlabel" value=""> Choose Course Type</option>
                                    @foreach ($course_type as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="course">Course</label>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="course" name="Course">
                                    <option hidden class="inputlabel" value=""> Choose Course</option>
                                    @foreach ($course as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->course_name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="enq_taken_by">Enquiry Assign To</label><br>
                                <select class="form-select inputfield" aria-label="Default select example name"
                                    id="enq_taken_by" name="EnqTakenBy" autofocus required>
                                    <option hidden class="inputlabel" value="">Choose Staff</option>
                                    @foreach ($staffs as $key)
                                        <option class="inputlabel branch-option" value="{{ $key->id }}">
                                            {{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                            <div>
                                <h5 class="pt- ">Enquiry Details</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="form-check-label inputlabel mt-4 mx-2" for="followup" >
                                    Is Follow Up Needed
                                </label>
                                <input class="form-check-input mt-4" type="checkbox" value="" id="is_followup"
                                    name="Isfollowup" checked>

                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="enq_date">Enquiry Date</label>
                                <input type="date" class="form-control  inputfield" id="enq_date" name="EnqDate"
                                    placeholder="" autofocus>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="remark">Remark</label><br>
                                <input type="text" class="form-control  inputfield" id="remark" name="Remark"
                                    placeholder="" autofocus>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="next_follow_up">Next Follow Up</label>
                                <input type="date" class="form-control  inputfield" id="next_follow_up"
                                    name="NextFollowUp" placeholder="" autofocus>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-1 mb-1 inputlabel" for="special_discount">Special Discount
                                    Requested</label><br>
                                <input type="text" class="form-control  inputfield" id="special_discount"
                                    name="SpecialDiscount" placeholder="" autofocus>
                            </div>


                        </div>
                        <div class="main_heading d-flex justify-content-center my-3 p-1 formheading">
                            <div>
                                <h5 class="pt-" data-bs-toggle="collapse" data-bs-target="#additionalDetails"
                                    aria-expanded="false" aria-controls="additionalDetails">
                                    Additional Details
                                    <span class="arrow-icon"><i class="bi bi-chevron-down"></i></span>
                                </h5>

                                <div class="collapse" id="additionalDetails">

                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="additionalDetails">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="parent_info"
                                        style="display: flex; align-items: center;">
                                        <span style="flex-grow: 1;">Parent Info</span>
                                        <a type="button" data-bs-toggle="modal" class="parent-icon"
                                            data-bs-target="#splParentModal">
                                            <i><img src="{{ url('assets/images/parentss.png') }}"
                                                    style="width:20px; height:20px;"></i>
                                        </a>
                                    </label>
                                    <select class="form-select" aria-label="Default select example name"
                                        id="parent_info" name="ParentInfo">
                                        <option hidden class="inputlabel" value="">Choose Parent Info</option>
                                        @foreach ($parent as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->father_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="dob">Date Of Birth</label>
                                    <input type="date" class="form-control inputfield" id="dob"
                                        name="DOB" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="education">Education</label>
                                    <input type="text" class="form-control inputfield" id="education"
                                        name="Education" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel"
                                        for="school_colg">College/School/Others</label>
                                    <input type="text" class="form-control inputfield" id="school_colg"
                                        name="SchoolColg" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="religion">Religion</label>
                                    <select class="form-select inputfield" aria-label="Default select example name"
                                        id="religion" name="Religion">
                                        <option hidden class="inputlabel" value="">Choose Religion</option>
                                        @foreach ($religion as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="caste">Caste</label>
                                    <select class="form-select inputfield" aria-label="Default select example name"
                                        id="caste" name="Caste">
                                        <option hidden class="inputlabel" value="">Choose Caste</option>
                                        @foreach ($caste as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="streem_id">Stream</label>
                                    <select class="form-select inputfield" aria-label="Default select example name"
                                        id="streem_id" name="Streem" autofocus>
                                        <option hidden class="inputlabel" value="">Choose Stream</option>
                                        @foreach ($stream as $key)
                                            <option class="inputlabel" value="{{ $key->id }}">
                                                {{ $key->stream }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="photo">Photo</label>
                                    <input type="file" class="form-control inputfield" id="photo"
                                        name="Photo" placeholder="" autofocus>
                                </div>
                            </div>
                        </div>



                        <div class="main_heading d-flex justify-content-center my-3 p-1 formheading">
                            <div>
                                <h5 class="pt-" data-bs-toggle="collapse" data-bs-target="#contactDetails"
                                    aria-expanded="false" aria-controls="contactDetails">
                                    Contact Details
                                    <span class="arrow-icon"><i class="bi bi-chevron-down"></i></span>
                                </h5>
                                <div class="collapse" id="contactDetails">

                                </div>
                            </div>
                        </div>
                        <div class="collapse" id="contactDetails">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="Enquirycountry">Country</label>
                                    <input type="text" class="form-control  inputfield" id="Enquirycountry"
                                        name="Country" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="Enquirypincode">Pincode</label>
                                    <input type="text" class="form-control  inputfield" id="Enquirypincode"
                                        name="Pincode" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="email">Email</label>
                                    <input type="email" class="form-control  inputfield" id="email"
                                        name="Email" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="Enquirystate">State</label>
                                    <input type="text" class="form-control  inputfield" id="Enquirystate"
                                        name="State" placeholder="" autofocus>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-1 mb-1 inputlabel" for="address">Address</label>
                                    <input type="text" class="form-control  inputfield" id="Enquiryaddress"
                                        name="Address" placeholder="" autofocus>
                                </div>

                            </div>
                        </div>
                        <div class=" text-end mt-3">
                            <button type="submit" class="btn responsebtn  px-5 ">Save</button>
                        </div>
                </div>

                </form>

            </div>
        </div>
        </div>
        </div>
        <!-- Offcanvas to display existing data -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="existingDataOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Existing Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Display existing data here -->
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
    </main><!-- End #main -->

    @include('layouts.footer')


    <script type="text/javascript">
        $(document).ready(function() {
            $('#branch').on('change', function() {
                var branchId = $(this).val();
                loadStaff(branchId);
            });

            $('#course_type').on('change', function() {
                var CourseId = $(this).val();
                loadCourse(CourseId);
            });
        });

        function loadStaff(branchId) {
            if (branchId) {
                $.ajax({
                    url: '/api/branchwiseStaff/' + branchId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $enqTakenBy = $('#enq_taken_by');
                        $enqTakenBy.empty();
                        $enqTakenBy.append('<option value="">Choose Staff</option>');
                        $.each(data, function(key, value) {
                            $enqTakenBy.append('<option class="inputlabel" value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#enq_taken_by').empty();
                $('#enq_taken_by').append('<option value="">Choose Staff</option>');
            }
        }

        function loadCourse(CourseId) {
            if (CourseId) {
                $.ajax({
                    url: '/api/CourseTypeWiseCourse/' + CourseId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var $enqTakenBy = $('#course');
                        $enqTakenBy.empty();
                        $enqTakenBy.append('<option value="">Choose Course</option>');
                        $.each(data, function(key, value) {
                            $enqTakenBy.append('<option class="inputlabel" value="' + value.id + '">' +
                                value.course_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#course').empty();
                $('#course').append('<option value="">Choose Course</option>');
            }
        }

        // Get the current date
        var currentDate = new Date().toISOString().slice(0, 10);

        // Set the current date as the value of the "Enquiry Date" input field
        document.getElementById("enq_date").value = currentDate;
        // document.getElementById("next_follow_up").value = currentDate;

        function addressFunction() {
            if (document.getElementById('sameas').checked) {
                document.getElementById('Address').value = document.getElementById('caddress').value;
                document.getElementById('lan_no').value = document.getElementById('c_lan_line').value;
                document.getElementById('post_office').value = document.getElementById('c_post_office').value;
                document.getElementById('mob_no').value = document.getElementById('c_mob_no').value;
                document.getElementById('email_id').value = document.getElementById('c_email_id').value;
                document.getElementById('Land_mark').value = document.getElementById('C_lan_mark').value;
            } else {
                document.getElementById('caddress').value = "";

            }
        }

        function toggleAsterisk() {
            var leadDataSelect = document.getElementById('leadData');
            var asteriskSpan = document.getElementById('asterisk');
            var mobileNoInput = document.getElementById('mobile_no');

            if (leadDataSelect.value === 'LD') {
                // Show the asterisk and make the Mobile No field required
                asteriskSpan.classList.remove('hidden');
                mobileNoInput.required = true;
            } else {
                // Hide the asterisk and remove the required attribute from the Mobile No field
                asteriskSpan.classList.add('hidden');
                mobileNoInput.required = false;
            }
        }













        //Add Parent Info


        $("#parent_add").validate({
            rules: {
                PMobNo: {
                    required: true,
                    minlength: 2,
                    maxlength: 15,
                },
                SMobNo: {
                    required: true,
                    minlength: 2,
                    maxlength: 15,
                },

            },
            messages: {
                PMobNo: {
                    required: "Please Enter Valid Phone Number",
                    minlength: "atleast 2 characters",
                    maxlength: "maximum 15 characters",
                },
                SMobNo: {
                    required: "Please Enter Valid Phone Number",
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
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Parent Informations is Already Present");
                            $('#ResponseModal').modal('show');
                        } else if (EnResultObj.code == "1") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/success.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Successfully Added Parent Informations");
                            $('#ResponseModal').modal('show');
                        } else if (EnResultObj.code == "2") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/error.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Failed Adding Parent Informations");
                            $('#ResponseModal').modal('show');
                        }
                    } else {
                        $('#ResponseImage').html(
                            '<img src="{{ url('assets/images/error.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                        );
                        $('#ResponseText').text(
                            "Some Error Occured, Please refresh the page (ERROR : 12ENJ)");
                        $('#ResponseModal').modal('show');
                    }
                });
            }
        });
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


        //Add Enquiry 
        $("#Enquiry_form").validate({
            lded: {
                required: true,

            },
            lded: {
                required: "Please select data type",

            },
            submitHandler: function(form, e) {
                e.preventDefault();
                var StudentName = $('#student_name').val();
                var gender = $('#gender').val();
                var Dob = $('#dob').val();
                var Staff = $('#enq_taken_by').val();
                var Parents = $('#parent_info').val();
                var caste = $('#caste').val();
                var Streem = $('#streem_id').val();
                var Branch = $('#branch').val();
                var photo = $('#photo').val();
                var religion = $('#religion').val();
                var education = $('#education').val();
                var school_colg = $('#school_colg').val();
                var country = $('#Enquirycountry').val();
                var Enquirylocation = $('#Enquirylocation').val();
                var pincode = $('#Enquirypincode').val();
                var email = $('#email').val();
                var mob_no = $('#mobile_no').val();
                var state = $('#Enquirystate').val();
                var address = $('#Enquiryaddress').val();
                var enq_date = $('#enq_date').val();
                var course = $('#course').val();
                var enq_source = $('#enq_source').val();
                var remark = $('#remark').val();
                var next_follow_up = $('#next_follow_up').val();
                var special_discount = $('#special_discount').val();
                var enq_stage = $('#enq_state').val();
                var leaddata = $('#leadData').val();
                var feedback = $('#is_followup').prop('checked') ? 0 : 1;
                console.log(leaddata, Staff);
                $.ajax({
                    url: "/api/enquiry",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "name": StudentName,
                        "gender": gender,
                        "dob": Dob,
                        "remarks": remark,
                        "religion_id": religion,
                        "caste_id": caste,
                        "Assignedto": Staff,
                        "education": education,
                        "stream_id": Streem,
                        "branch_id": Branch,
                        "colg_schl": school_colg,
                        "photo": photo,
                        "state": state,
                        "location": Enquirylocation,
                        "address": address,
                        "pincode": pincode,
                        "mob_no": mob_no,
                        "email": email,
                        "enq_date": enq_date,
                        "course_id": course,
                        "discount": special_discount,
                        "enq_source": enq_source,
                        "enq_stage": enq_stage,
                        "country": country,
                        "next_folow_up": next_follow_up,
                        "parent_info_id": Parents,
                        "leaddata": leaddata,
                        "feedback": feedback

                    },

                    beforeSend: function() {
                        $('.loader').show();

                    },
                }).done(function(response) {

                    $('.loader').hide();
                    console.log(response);
                    var CasteResult = JSON.stringify(response);
                    console.log(CasteResult);
                    var CasteResultObj = JSON.parse(CasteResult);
                    if (CasteResultObj.success == true) {
                        if (CasteResultObj.code == "0") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Enquiry  is Already Present");
                            $('#ResponseModal').modal('show');
                        } else if (CasteResultObj.code == "1") {
                            form.reset();

                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/success.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Successfully Added Enquiry ");
                            $('#ResponseModal').modal('show');
                        } else if (CasteResultObj.code == "2") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Failed Adding Enquiry ");
                            $('#ResponseModal').modal('show');
                        }
                    } else {
                        $('#ResponseImage').html(
                            '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                        );
                        $('#ResponseText').text(
                            "Some Error Occured, Please refresh the page (ERROR : 12ENJ)");
                        $('#ResponseModal').modal('show');
                    }

                });

            }

        });

        //checkbox
        // function change_followup_status(param) {
        //     var feedback = $(param).prop('checked') ? 0 : 1;
        //     var id = $(param).data('id');

        // }
    </script>



</body>

</html>
