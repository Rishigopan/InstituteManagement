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

        <!-- task Details Canvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="taskdetail" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-body p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-12">
                            <div class="text-start mt-2 ps-4">
                                <button class="btn taskcomplete py-0 px-3 mb-3"><i class="ri-check-line me-2"></i>Mark Complete</button>
                            </div>
                            <div class="row ms-3">
                                <div class="col-6">
                                    <h5>Exam Preparation</h5>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-success StartBtns py-0 px-2 ms-3 my-1">Start</button><button class="btn btn-danger StartBtns py-0 px-2 ms-3">Stop</button>
                                </div>
                            </div>
                            <ul>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="payment-checkbox">
                                            <label class="form-check-label" for="payment-checkbox">
                                                Make Payments
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success StartBtns py-0 px-2 ms-3 my-1">Start</button>
                                        <button class="btn btn-danger StartBtns py-0 px-2 ms-3">Stop</button>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="receipt-checkbox">
                                            <label class="form-check-label" for="receipt-checkbox">
                                                Receipt print
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success StartBtns py-0 px-2 ms-3 my-1">Start</button>
                                        <button class="btn btn-danger StartBtns py-0 px-2 ms-3">Stop</button>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="calculate-checkbox">
                                            <label class="form-check-label" for="calculate-checkbox">
                                                calculate
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success StartBtns py-0 px-2 ms-3 my-1">Start</button>
                                        <button class="btn btn-danger StartBtns py-0 px-2 ms-3">Stop</button>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="excel-checkbox">
                                            <label class="form-check-label" for="excel-checkbox">
                                                Add Excel
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success StartBtns py-0 px-2 ms-3 my-1">Start</button>
                                        <button class="btn btn-danger StartBtns py-0 px-2 ms-3">Stop</button>
                                    </div>
                                </div>
                            </ul>
                            <hr></hr>
                            <h5 class="ms-4 ps-1">Attachments</h5>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-12 taskdatesec">
                            <h5 class="mt-2">Observers</h5>
                                <i> <img src="{{url('assets/images/girls.png')}}" style="width:20px; height:18px;">
                                    <img src="{{url('assets/images/girl.png')}}" style="width:20px; height:18px;">
                                    <img src="{{url('assets/images/boys.png')}}" style="width:20px; height:18px;">
                                </i>
                            <hr></hr>
                            <h5>Participants</h5>
                                <i> <img src="{{url('assets/images/girls.png')}}" style="width:20px; height:18px;">
                                    <img src="{{url('assets/images/man.png')}}" style="width:20px; height:18px;">
                                    <img src="{{url('assets/images/girl.png')}}" style="width:20px; height:18px;">
                                    <img src="{{url('assets/images/man.png')}}" style="width:20px; height:18px;">
                                    <img src="{{url('assets/images/boys.png')}}" style="width:20px; height:18px;">
                                </i>
                            <hr></hr>
                            <h6>Created Date</h6>
                            <p class="tasktime">jan 10 2022</p>
                            <hr></hr>
                            <h6>Last Update Date</h6>
                            <p class="tasktime">May 16 2022</p>
                            <hr></hr>
                            <h6>Due Date</h6>
                            <p class="tasktime">June 22 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- ======= Sidebar ======= -->

        <aside id="sidebar" class="sidebar ps-0">
            @include('layouts.sidebar')
        </aside>

        <!-- End Sidebar-->
        <main id="main" class="main">
            <div class="container-fluid d-flex justify-content-between">
                <h4 class="p-2 mt-3"><b>My Tasks</b></h4>    
                <div class="p-3">
                <a class="taskiconnav" href="{{ url('/viewtaskboard') }}"><i class="ri-layout-grid-fill me-3 fs-4"></i></a>
                <a class="taskiconnav" href="{{ url('/viewtask') }}"><i class="ri-file-list-2-line ms-2 fs-4"></i></a>
                </div>         
            </div>
            <div class="wrapper">
                <!--CONTENTS-->
                <div class="container-fluid mainContents">
                    <div class="row">
                        <!-- Not Set Started  -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                            <div class="viewtaskcard pb-2">
                                <div class="text-center tasknotstart">
                                    <h6 class="mb-0">Not Yet Started</h6>
                                </div>
                                <div class="m-3">
                                    <div class="viewtaskcarddetail taskstartborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>MOC Exam For Students in final exam</b></h6>                             
                                        </div> 
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 22 May</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                    <div class="viewtaskcarddetail taskstartborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>Shedule timetable for second session </b></h6>                             
                                        </div> 
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 17 Oct</p> 
                                        </div> 
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- In Progress  -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12 ">
                            <div class="viewtaskcard pb-2">
                                <div class="text-center taskprogress">
                                    <h6 class="mb-0">In Progress</h6>
                                </div>
                                <div class="m-3">
                                    <div class="viewtaskcarddetail taskprogressborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>Evaluate the papers and update the marks and ranks </b></h6>                             
                                        </div> 
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 16 Aug</p> 
                                        </div> 
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                    <div class="viewtaskcarddetail taskprogressborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>MOC Exam For Students in final exam</b></h6>                             
                                        </div>  
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 17 Oct</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                    <div class="viewtaskcarddetail taskprogressborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>List the revaluation applications and make the priority first</b></h6>                             
                                        </div>  
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 20 Nov</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- On Hold  -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                            <div class="viewtaskcard pb-2">
                                <div class="text-center taskhold">
                                    <h6 class="mb-0">On Hold</h6>
                                </div>
                                <div class="m-3">
                                    <div class="viewtaskcarddetail taskholdborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>Pay the taxes of the property and send the recepits</b></h6>                             
                                        </div> 
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 19 Jan</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div>  
                                    </div>
                                    <div class="viewtaskcarddetail taskholdborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>MOC Exam For Students in final exam</b></h6>                             
                                        </div>
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 17 Oct</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Completed  -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-12 ">
                            <div class="viewtaskcard pb-2">
                                <div class="text-center taskcompleted">
                                    <h6 class="mb-0">Completed</h6>
                                </div> 
                                <div class="m-3">
                                    <div class="viewtaskcarddetail taskcompletedborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>update all fees details in our branches</b></h6>                             
                                        </div>  
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 22 Sep</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                    <div class="viewtaskcarddetail taskcompletedborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>MOC Exam For Students in final exam</b></h6>                             
                                        </div> 
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 20 Nov</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div>  
                                    </div>
                                    <div class="viewtaskcarddetail taskcompletedborder my-2">
                                        <div class="p-2">
                                            <h6 class=" "><b>Shedule all timetable for upcomming Exams</b></h6>                             
                                        </div>  
                                        <div class=" d-flex justify-content-between"> 
                                            <i class="p-2"><img src="{{url('assets/images/girl.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/man.png')}}" style="width:20px; height:17px;">
                                                <img src="{{url('assets/images/two.png')}}" style="width:20px; height:17px;">
                                            </i>
                                            <p class="text-end taskdue p-2">Due 28 Nov</p> 
                                        </div>
                                        <hr class="my-0"></hr>
                                        <div class="p-2 d-flex justify-content-between">    
                                            <i  class="ri-list-check-2" data-bs-toggle="offcanvas" data-bs-target="#taskdetail" aria-controls="offcanvasRight"> </i>
                                            <i class="ri-attachment-2 me-2"> </i>   
                                        </div> 
                                    </div>
                                </div>
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
        </main>
        @include('layouts.footer')
    </body>

</html>