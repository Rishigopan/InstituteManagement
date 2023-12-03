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

        <!-- End Header -->

        <!-- ======= Sidebar ======= -->

        <aside id="sidebar" class="sidebar ps-0">
            @include('layouts.sidebar')
        </aside>

        <!-- End Sidebar-->
        <main id="main" class="main">

            <div class="wrapper">
                <!--CONTENTS-->
                <div class="container-fluid mainContents">
                    <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">                           
                        <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                            <div>
                                <h5 class="pt-3 ">Duplicate Data</h5>                                    
                            </div>
                           
                        </div>
                        <div class="admintoolbar">
                            <div class="card card-body">
                                <div class="row justify-content-between">
                                    <div class="col-lg-4 col-4 mt-3 ">
                                        <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                                    </div>
                                    {{-- <div class="col-lg-4 text-end col-4">
                                        <i class="material-icons mt-3 me-3">file_download</i>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                <thead class=" tablehead">
                                    <tr>
                                        <th class="text-center">Si No</th>
                                        <th class="text-center">Student ID </th>
                                        <th class="text-center">FullName</th>  
                                        <th class="text-center">Duplicate Email</th>
                                        <th class="text-center">Duplicate Mobile</th>  
                                        <th class="text-center">Duplicate Id</th>                                  
                                      
                                    </tr>                                           
                                </thead>
                                <tbody>
                                
                                </tbody>
                               
                            </table>
                        </div>
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