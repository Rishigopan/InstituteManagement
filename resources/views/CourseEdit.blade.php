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
                    <div class="main_heading d-flex justify-content-center my-2  p-1 formheading">
                        <div>
                            <h5 class="pt- "> Course Details</h5>
                        </div>
                    </div>



                    <form class="courseUpdate AddForm" id="Update_Course" novalidate>
                        {{ csrf_field() }}
                        <div class="row">


                            <div class="col-xl-6 col-lg-6 col-12">
                                <input type="hidden" id="update_course_id" value="{{ $getdata->id }}">
                                <label class="mt-2 mb-1 inputlabel">Course Provider<span
                                        style="color:red; font-size:15px"> *</span></label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="update_course_provider" name="CourseProvider">
                                    <option hidden class="inputlabel"> Choose course
                                        Provider</option>
                                    @foreach ($course as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->provider_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="mt-2 mb-1 inputlabel">Code<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="update_code"
                                    name="Code" value="{{ $getdata->code }}" placeholder="" autofocus required>
                                <label class="mt-3 mb-1 inputlabel">Printable Name</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="update_printable_name"
                                    value="{{ $getdata->printable_name }}" name="PrintableName" placeholder=""
                                    autofocus>
                                <label class="mt-2 mb-1 inputlabel">Department</label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="update_department_id" name="update_department_id"
                                    value="{{ $getdata->depName }}">
                                    <option class="inputlabel"> Choose Department
                                    </option>
                                    @foreach ($department as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="mt-2 mb-1 inputlabel">Course Type</label><br>

                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="update_course_type" name="CourseType">
                                    <option class="inputlabel"> Choose Course Type
                                    </option>
                                    @foreach ($CType as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12">

                                {{-- <label class="mt-2 mb-1 inputlabel">Visibility</label><br>
                            <input type="text" class="form-control mt-1 inputfield" id="update_visibility"
                                name="Visibility" placeholder="" value="{{$getdata->}}" autofocus required> --}}
                                <label class="mt-2 mb-1 inputlabel">Course Name<span style="color:red; font-size:15px">
                                        *</span></label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="Update_course_name"
                                    name="CourseName" placeholder="" value="{{ $getdata->course_name }}" autofocus
                                    required>
                                <label class="mt-3 mb-1 inputlabel">Is Batch Course</label><br>

                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="update_is_batch_course" name="IsBatchCourse">

                                    <option class="inputlabel" value="1">YES</option>
                                    <option class="inputlabel"value="2">NO</option>

                                </select>

                                <label class="mt-2 mb-1 inputlabel">Course Category</label><br>
                                <select class="form-select inputfield " aria-label="Default select example name"
                                    id="update_course_cat" name="CourseCat">
                                    <option class="inputlabel"> Choose
                                        Course Catagory</option>
                                    @foreach ($Cat as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label class="mt-2 mb-1 inputlabel">Zonal Discount</label><br>
                                <input type="text" class="form-control mt-1 inputfield" id="update_zonal_discount"
                                    name="ZonalDiscount" placeholder=""
                                    value="{{ $getdata->zonal_discount }} "autofocus>

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
                                                                id="get_document{{ $key->id }}"
                                                                name="documents" />
                                                            <label class="form-check-label"
                                                                for="get_document{{ $key->id }}">
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
                                <button type="submit" id="submit" href=""
                                    class="btn savebtn  px-5 ">Update</button>
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
                                    class="btn btn_save responsebtn mt-4 px-5 py-2"
                                    data-bs-dismiss="modal">Proceed</button>
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
        //view dropdown Datas
        var courseProviderdata = {{ $getdata->course_provider_id == '' ? 0 : $getdata->course_provider_id }}
        var departmentdata = {{ $getdata->department_id == '' ? 0 : $getdata->department_id }}
        var courseCatagorydata = {{ $getdata->course_category_id == '' ? 0 : $getdata->course_category_id }}
        var CourseName = {{ $getdata->course_type_id == '' ? 0 : $getdata->course_type_id }}
        var batch_course = {{ $getdata->batch_course == '' ? 0 : $getdata->batch_course }}

        $("#update_department_id").val(departmentdata);
        $("#update_course_provider").val(courseProviderdata);
        $("#update_course_type").val(CourseName);
        $("#update_course_cat").val(courseCatagorydata);






        //document checkbox check
        var EditDocuments = {{ $EditDocumentsArray }};
        console.log(EditDocuments);

        for (var i = 0; i < EditDocuments.length; i++) {
            $('#get_document' + EditDocuments[i]).prop('checked', true);

        }

        var EditQualificationArray = {{ $EditQualificationArray }};

        for (var i = 0; i < EditQualificationArray.length; i++) {
            $('#get_qualification' + EditQualificationArray[i]).prop('checked', true);

        }

        var EditBatchArray = {{ $EditBatchArray }};

        for (var i = 0; i < EditBatchArray.length; i++) {
            $('#get_batch' + EditBatchArray[i]).prop('checked', true);

        }


        $(document).on('click', '#btnClose', function() {
            location.replace("{{ url('/courseTable') }}")
        });


        //qualification array 


        $("#Update_Course").validate({
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

                var UpdateId = $('#update_course_id').val();
                var UpdatePName = $('#update_printable_name').val();
                var UpdateCtype = $('#update_course_type').val();
                var UpdateCourseName = $('#Update_course_name').val();
                var UpdateCoursePro = $('#update_course_provider').val();
                var UpdateDepartment = $('#update_department_id').val();
                var UpdateCourseCat = $('#update_course_cat').val();
                var UpdateBatchCourse = $('#update_is_batch_course').val();
                var UpdateZonal = $('#update_zonal_discount').val();
                var UpdateCode = $('#update_code').val();
                console.log(UpdateId, UpdatePName, UpdateCtype, UpdateCourseName,
                    UpdateCoursePro,
                    UpdateDepartment,
                    UpdateCourseCat,
                    UpdateBatchCourse,
                    UpdateZonal,
                    UpdateCode)


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
                    url: "/api/courseRequirement/" + UpdateId + "",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "course_provider_id": UpdateCoursePro,
                        "course_name": UpdateCourseName,
                        "department_id": UpdateDepartment,
                        "course_type_id": UpdateCtype,
                        "course_category_id": UpdateCourseCat,
                        "code": UpdateCode,
                        "batch_course": UpdateBatchCourse,
                        "printable_name": UpdatePName,
                        "zonal_discount": UpdateZonal,
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
    </script>
</body>

</html>
