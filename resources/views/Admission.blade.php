<!DOCTYPE html>
<html lang="en">

  <head>

     @include('layouts.headder')

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
                    <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Admission</h4>
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
                                    <h5 class="pt- "> Student Details</h5>                                    
                                </div>                                
                            </div>
                            <form class="Admission AddForm" id="student_record" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                    
                                    <div class="col-xl-6 col-lg-6 col-12">    
                                        <label class="mt-2 mb-1 inputlabel">Select Student<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <select class="form-select inputfield " aria-label="Default select example name" id="student" name="Student" required>
                                            <option class="inputlabel" value=""> Choose Student</option>  
                                                @foreach($student as $key)
                                            <option value="{{ $key->id }}">{{ $key->name }}</option>  
                                                @endforeach
                                                                                                        
                                        </select>                         
                                    </div>
                                    <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                        <div>
                                            <h5 class="pt- ">Admission Details</h5>                                    
                                        </div>                                
                                    </div> 
                                    <div class="col-xl-6 col-lg-6 col-12">                                                                                                                                                                 
                                        <label class="mt-2 mb-1 inputlabel">Academic Year<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <select class="form-select inputfield " aria-label="Default select example name" id="acadmic_year" name="AcadmicYear" required>
                                            <option class="inputlabel" value=""> Choose Academic Year</option>  
                                               @foreach($acadmic_year as $key)
                                            <option value="{{ $key->id }}">{{ $key->year }}</option>  
                                                @endforeach                                    
                                        </select> 
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Date Of Admission<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="date" class="form-control mt-1 inputfield" id="date_of_admission" name="DateOfAdmission" placeholder="" autofocus required>  
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Batch<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <select class="form-select inputfield " aria-label="Default select example name" id="batch" name="Batch" required>
                                            <option class="inputlabel" value=""> Choose Batch</option>  
                                                @foreach($batch as $key)
                                            <option value="{{ $key->id }}">{{ $key->batch_name }}</option>  

                                                @endforeach                                                     
                                        </select> 
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Date of Completion <span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="date" class="form-control mt-1 inputfield" id="date_of_completion" name="DateOfCompletion" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Registration No<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="number" class="form-control mt-1 inputfield" id="registration_no" name="RegistrationNo" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Email<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="email" class="form-control mt-1 inputfield" id="email" name="Email" placeholder="" autofocus required>    
                                             
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">                                        
                                        <label class="mt-2 mb-1 inputlabel">Admission No <span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="number" class="form-control mt-1 inputfield" id="admission_no" name="Admission_No" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-3 mb-1 inputlabel">Course<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <select class="form-select inputfield " aria-label="Default select example name"    id="course" name="Course">
                                            <option class="inputlabel" value=""> Choose Course</option>  
                                                  @foreach($course as $key)
                                            <option value="{{ $key->id }}">{{ $key->course_name }}</option>  

                                            @endforeach                                                         
                                        </select> 
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-3 mb-1 inputlabel">Date Of Joining<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="date" class="form-control mt-1 inputfield" id="date_of_joining" name="DateOfJoining" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-3 mb-1 inputlabel">Id Card No<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="number" class="form-control mt-1 inputfield" id="id_card_no" name="IdCardNo" placeholder="" autofocus required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-3 mb-1 inputlabel">Roll No<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="number" class="form-control mt-1 inputfield" id="roll_no" name="RollNo" placeholder="" autofocus required>
                                    </div>
                                    <div class="main_heading d-flex justify-content-center my-3  p-1 formheading">
                                        <div>
                                            <h5 class="pt- ">Fee Details</h5>                                    
                                        </div>                                
                                    </div> 
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        
                                        <label class="mt-2 mb-1 inputlabel">fee Plan<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="text" class="form-control mt-1 inputfield" id="fee_plan" name="FeePlan" placeholder="" autofocus required>                                                                                                                       
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="mt-2 mb-1 inputlabel">Special Discount<span  style="color:red; font-size:15px" > *</span></label><br>
                                        <input type="number" class="form-control mt-1 inputfield" id="Special_discount" name="SpecialDiscount" placeholder="" autofocus required>                                        
                                    </div>
                                    <div class=" text-end mt-3">
                                        <button type="submit" class="btn savebtn  px-5 ">Save</button>
                                    </div>

                                </div> 
                            </form>    
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
            </div>
           
        </main><!-- End #main -->  

         @include('layouts.footer')

         <script type="text/javascript">

    //Add admission
    $("#student_record").validate({
            submitHandler: function(form, e) {
                e.preventDefault();
                var StudentName = $('#student').val();
                var AcademicYear = $('#acadmic_year').val();
                var DoA = $('#date_of_admission').val();
                var Batch = $('#batch').val();
                var DoC = $('#date_of_completion').val();
                var RegNo = $('#registration_no').val();
                var Email = $('#email').val();
                var AdNo = $('#admission_no').val();
                var Course = $('#course').val();
                var DoJ = $('#date_of_joining').val();
                var IdNo = $('#id_card_no').val();
                var RollNo = $('#roll_no').val();
                var FeePlan = $('#fee_plan').val();
                var SpecialDiscount = $('#Special_discount').val();
                var createdby = $('#created_by').val();


                $.ajax({
                    url: "/api/admission",
                        method: "POST",
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                        },
                        data: {
                            "student_id": StudentName,
                            "academic_year": AcademicYear,
                            "date_of_admission": DoA,
                            "batch_id": Batch,
                            "complete_date": DoC,
                            "reg_no": RegNo,
                            "email": Email,
                            "admission_no": AdNo,
                            "course_id": Course,
                            "join_date": DoJ,
                            "id_no": IdNo,
                            "roll_no": RollNo,
                            "fee_plan": FeePlan,
                            "special_discount": SpecialDiscount,
                          

                            // console.log(StudentName);

                         },

                    beforeSend: function() {
                        $('.loader').show();
                        $('#ResponseImage').html("");
                        $('#ResponseText').text("");
                        
                    },
                }).done(function(response) {
                    $('.loader').hide();
                    $(".AddForm")[0].reset();
                    $('.mainContents').show();

                    

                    console.log(response);
                    var EnResult = JSON.stringify(response);
                    console.log(EnResult);
                    var EnResultObj = JSON.parse(EnResult);
                    if (EnResultObj.success == true) {
                        if (EnResultObj.code == "0") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Student  is Already Present");
                            $('#ResponseModal').modal('show');
                        } else if (EnResultObj.code == "1") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/success.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Student Added Successfully");
                            $('#ResponseModal').modal('show');
                        } else if (EnResultObj.code == "2") {
                            $('#ResponseImage').html(
                                '<img src="{{ url('assets/images/warning.jpg') }}" style="height:130px;width:130px;" class="img-fluid" alt="">'
                            );
                            $('#ResponseText').text("Failed Adding Student");
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

    </script>

         </body>

</html>