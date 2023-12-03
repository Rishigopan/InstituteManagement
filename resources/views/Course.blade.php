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
            <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Course</h4>
        </div>

        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                    <div class="text-end">
                        <a href="{{ url('/courseTable') }}">
                            <button class="btn AddBtn px-4">View</button>
                        </a>
                    </div>
                    <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                        <div>
                            <h5 class="pt- "> Course Details</h5>
                        </div>
                    </div>
                    <form class="CourseMain AddForm" id="course_main" novalidate>
                        {{ csrf_field() }}
                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="course_provider">Course Provider<span
                                        style="color:red; font-size:15px"> *</span></label>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="course_provider" name="CourseProvider" autofocus required>
                                    <option hidden class="inputlabel" value=""> Choose course Provider</option>
                                    @foreach ($course as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->provider_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="code">Code<span
                                        style="color:red; font-size:15px"> *</span></label>
                                <input type="text" class="form-control  inputfield" id="code" name="Code"
                                    placeholder="" autofocus required>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="printable_name">Printable Name</label><br>
                                <input type="text" class="form-control  inputfield" id="printable_name"
                                    name="PrintableName" placeholder="">
                            </div>

                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="department">Department</label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="department" name="department">
                                    <option hidden class="inputlabel" value=""> Choose Department</option>
                                    @foreach ($department as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="course_type">Course Type</label><br>

                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="course_type" name="CourseType">
                                    <option hidden class="inputlabel" value=""> Choose Course Type</option>
                                    @foreach ($CType as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="course_name">Course Name<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <input type="text" class="form-control  inputfield" id="course_name"
                                    name="CourseName" placeholder="" autofocus required>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="is_batch_course">Is Batch Course</label><br>

                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="is_batch_course" name="IsBatchCourse">
                                    <option hidden class="inputlabel" value="0">--------SELECT-----------</option>
                                    <option class="inputlabel" value="1">YES</option>
                                    <option class="inputlabel" value="2">NO</option>
                                    </option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel" for="course_cat">Course Category</label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="course_cat" name="CourseCat">
                                    <option hidden class="inputlabel" value=""> Choose Course Catagory</option>
                                    @foreach ($Cat as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel">Zonal Discount</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="zonal_discount"
                                    name="ZonalDiscount" placeholder="">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-4 col-xl-4 col-12">
                                <div class="table-responsive">
                                    <table class="table  table-hover MasterTable" id="MasterTable"
                                        style="width: 100%;">
                                        <thead class="table  tablehead">
                                            <tr>

                                                <th class="text-center">Batch Type Available</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Batchtype as $key)
                                                <tr>
                                                    <td value="{{ $key->id }}">
                                                        <input class="get_batch  form-check-input" type="checkbox"
                                                            value="{{ $key->id }}"
                                                            id="get_batch{{ $key->id }}" name="batchtype" />
                                                        <label class="form-check-label"
                                                            for="get_batch{{ $key->id }}">
                                                            {{ $key->name }} </label>
                                                    </td>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-12">
                                <div class="table-responsive">
                                    <table class="table  table-hover MasterTable" id="MasterTable"
                                        style="width: 100%;">
                                        <thead class="table  tablehead">
                                            <tr>
                                                <th class="text-center">Qualification Needed</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Qualification as $key)
                                                <tr>
                                                    <td value="{{ $key->id }}"> <input
                                                            class="get_qualification  form-check-input"
                                                            type="checkbox" value="{{ $key->id }}"
                                                            id="get_qualification{{ $key->id }}"
                                                            name="qualification" />
                                                        <label class="form-check-label"
                                                            for="get_qualification{{ $key->id }}">
                                                            {{ $key->name }} </label>
                                                    </td>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-4 col-12">
                                <div class="table-responsive">
                                    <table class="table  table-hover MasterTable" id="MasterTable"
                                        style="width: 100%;">
                                        <thead class="table  tablehead">
                                            <tr>
                                                <th class="text-center">Documents Needed</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($document as $key)
                                                <tr>
                                                    <td value="{{ $key->id }}"> <input
                                                            class="get_document  form-check-input" type="checkbox"
                                                            value="{{ $key->id }}"
                                                            id="get_docuemt{{ $key->id }}" name="documents" />
                                                        <label class="form-check-label"
                                                            for="get_docuemt{{ $key->id }}">
                                                            {{ $key->name }} </label>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class=" text-end mt-3">
                            <button type="submit" id="submit" class="btn savebtn  px-5 ">Save</button>
                        </div>

                </div>
                </form>







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
        //add Course


        $("#course_main").validate({
            rules: {
                PrintableName: {
                    required: true,
                    minlength: 2,
                    maxlength: 120,
                },
                CourseName: {
                    required: true,
                    minlength: 2,
                    maxlength: 120,
                }

            },
            messages: {
                PrintableName: {

                    minlength: "atleast 2 characters",
                    maxlength: "maximum 120 characters",
                },
                CourseName: {

                    minlength: "atleast 2 characters",
                    maxlength: "maximum 120 characters",
                }
            },
            submitHandler: function(form, e) {

                e.preventDefault();
                var CoursePro = $('#course_provider').val();
                var Code = $('#code').val();
                var PrintName = $('#printable_name').val();
                var Department = $('#department').val();
                var CourseType = $('#course_type').val();
                var CourseName = $('#course_name').val();
                var BatchCourse = $('#is_batch_course').val();
                var CourseCat = $('#course_cat').val();
                var Zonal = $('#zonal_discount').val();

                //qualification array 
                var qualificationArray = [] //array declaration
                $('.get_qualification').each(function() {
                    if ($(this).is(":checked")) {
                        qualificationArray.push($(this).val());
                    }
                });
                console.log(qualificationArray);

                var batchArray = [] //array declaration
                $('.get_batch').each(function() {
                    if ($(this).is(":checked")) {
                        batchArray.push($(this).val());
                    }
                });
                //insert=insert.toString();
                console.log(batchArray);

                var documentArray = [] //array declaration
                $('.get_document').each(function() {
                    if ($(this).is(":checked")) {
                        documentArray.push($(this).val());
                    }
                });
                console.log(documentArray);

                qualifications = qualificationArray.toString();
                batch = batchArray.toString();
                documents = documentArray.toString();

                $.ajax({
                    url: "/api/courseRequirement",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "course_provider_id": CoursePro,
                        "course_name": CourseName,
                        "department_id": Department,
                        "course_type_id": CourseType,
                        "course_category_id": CourseCat,
                        "code": Code,
                        "batch_course": BatchCourse,
                        "printable_name": PrintName,
                        "zonal_discount": Zonal,
                        "documents": documents,
                        "qualification": qualifications,
                        "batch": batch
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
