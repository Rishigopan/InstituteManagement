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
                        <button type="button" id="btnClose" class="btn btn_save savebtn mt-4 px-5 py-2" data-bs-dismiss="modal">Okay</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Reset Password</h4>                                           
        </div>
        
        <div class="wrapper">
            <!--CONTENTS-->
            <div class="container-fluid mainContents">
                <div class="card card-body mt-2 shadow-lg p-3 mb-2">
                    <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                        <div>
                            <h6 class="pt-3 ">Reset Your Password</h6>
                        </div>
                    </div>
                    <form class="PasswordReset " id="reset_password" novalidate>
                        {{ csrf_field() }}
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="mt-2 mb-1 inputlabel" for="old_password">Old Password</label><br>
                                    <input type="password" class="form-control mt-1 inputfield" id="old_password" name="old_password" placeholder="Enter old password" required>
                                </div>
                                <div class="form-group">
                                    <label class="mt-2 mb-1 inputlabel" for="new_password">Create New Password</label><br>
                                    <input type="password" class="form-control mt-1 inputfield" id="new_password" name="new_password" placeholder="Enter new password" required>
                                </div>
                                <div class="form-group">
                                    <label class="mt-2 mb-1 inputlabel" for="confirm_password">Confirm New Password</label><br>
                                    <input type="password" class="form-control mt-1 inputfield" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" class="btn savebtn px-5">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
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

        //loader
        $(function() {
            $(".loader").fadeOut(1500, function() {
                $(".mainContents").show();        
            });
        });


        //Reset Password

        $("#reset_password").validate({
            rules:{
                old_password:{
                    required: true,
                    minlength: 5,  
                    maxlength: 25,                    
                },
                new_password:{
                    required: true,
                    minlength: 5,  
                    maxlength: 25,                    
                },
                confirm_password:{
                    required: true,
                    minlength: 5,  
                    maxlength: 25,  
                    equalTo: "#new_password",                  
                }     
            },
            messages: {
                old_password:{
                    required: "Please Enter Your Password",
                }
            },
            submitHandler: function(form) {
                // var UpdateId = $('#update_id').val();                
                var OldPassword = $('#old_password').val();
                var NewPassword = $('#new_password').val();
                var ConfirmPassword = $('#confirm_password').val();

                $.ajax({
                    url: "http://127.0.0.1:8000/api/ResetPassword/1",
                    method: "PUT",
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        old_password: OldPassword,
                        new_password: NewPassword,
                        confirm_password: ConfirmPassword
                    },
                    beforeSend: function() {
                        $('.loader').show();
                        $('.mainContents').hide();
                    },
                }).done(function (response) {
                    $(".PasswordReset")[0].reset(); 
                    $('.mainContents').show();
                    $('.loader').hide();
                    console.log(response);
                    var resetpw = JSON.stringify(response);
                    console.log(resetpw);
                    var ResetUpdateed = JSON.parse(resetpw);
                        if (ResetUpdateed.success == true) {
                            if (ResetUpdateed.code == "0") {
                            $('#ResponseImage').html('<img src="{{url('assets/images/warning.jpg')}}" style="height:130px;width:130px;" class="img-fluid" alt="">');
                            $('#ResponseText').text(ResetUpdateed.message);
                            $('#ResponseModal').modal('show');
                        } else if (ResetUpdateed.code == "1") {
                            $('#ResponseImage').html('<img src="{{url('assets/images/success.jpg')}}" style="height:130px;width:130px;" class="img-fluid" alt="">');
                            $('#ResponseText').text(ResetUpdateed.message);
                            $('#ResponseModal').modal('show');
                        } else if (ResetUpdateed.code == "2") {
                            $('#ResponseImage').html('<img src="{{url('assets/images/warning.jpg')}}" style="height:130px;width:130px;" class="img-fluid" alt="">');
                            $('#ResponseText').text(ResetUpdateed.message);
                            $('#ResponseModal').modal('show');
                        }
                    } 
                    else 
                    {
                        $('#ResponseImage').html('<img src="{{url('assets/images/error.jpg')}}" style="height:130px;width:130px;" class="img-fluid" alt="">');
                        $('#ResponseText').text("Some Error Occured, Please refresh the page (ERROR : 12ENJ)");
                        $('#ResponseModal').modal('show');
                    }  
                });
            }   
        });


    </script>

  </body>

</html>