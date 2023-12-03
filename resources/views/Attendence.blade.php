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
                                <h5 class="pt-3 ">INSTON ATTENDENCE</h5>                                    
                            </div>
                            
                        </div>
                        <div class="admintoolbar">
                            <div class="card card-body">
                                <div class="row justify-content-between">
                                   
                                    <div class="col-lg-4 col-4 mt-3 ">
                                        
                                        <select class="form-select inputfield " aria-label="Default select example name"
                                        id="course" name="course">
                                        <option class="inputlabel" value=""> Choose Course</option>
                                        @foreach ($course   as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->course_name }}
                                        </option>
                                    @endforeach
                                    </select>
                                    </div>
                                    <div class="col-lg-4 col-4 mt-3 ">
                                        
                                        <select class="form-select inputfield " aria-label="Default select example name"
                                        id="batch" name="batch">
                                        <option class="inputlabel" value=""> Choose Batch</option>
                                        @foreach ($batch   as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->batch_name }}
                                        </option>
                                    @endforeach
                                    </select>
                                        </div>
                                        <div class="col-lg-4 col-4 mt-3 ">
                                        
                                            <select class="form-select inputfield " aria-label="Default select example name"
                                            id="batchtype" name="batchtype">
                                            <option class="inputlabel" value=""> Choose Batch Type</option>
                                            @foreach ($batchType   as $key)
                                        <option class="inputlabel" value="{{ $key->id }}">{{ $key->name }}
                                        </option>
                                    @endforeach
                                        </select>
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
                                        <th class="text-center">Student Name</th>
                                        <th class="text-center">Period</th>                          
                                        
                                    </tr>                                           
                                </thead>
                                <tbody>
                                
                                </tbody>
                                <tr>
                                    <tr class="student">
                                        <td>1</td>
                                        <td class="name-col">Student</td>
                                        <td class="attend-col"><input type="checkbox"></td>
                                        
                                        
                                    </tr>
                                    <tr class="student">
                                        <td>2</td>
                                        <td class="name-col">Student</td>
                                        <td class="attend-col"><input type="checkbox"></td>
                                        
                                       
                                        
                                    </tr>
                                    <tr class="student">
                                        <td>3</td>
                                        <td class="name-col">Student</td>
                                        <td class="attend-col"><input type="checkbox"></td>
                                        
                                        
                                        
                                    </tr>
                                    <tr class="student">
                                        <td>4</td>
                                        <td class="name-col">Student</td>
                                        <td class="attend-col"><input type="checkbox"></td>
                                        
                                        
                                        
                                    </tr>
                                    
                               
                            </table>
                            <div class="text-center">
                            <button type="button" class=" btn btn-outline-success">Save</button>
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
        </main><!-- End #main -->  

         @include('layouts.footer')


         <script type="text/javascript">


            //loader
             $(function() {
                $(".loader").fadeOut(1500, function() {
                    $(".mainContents").show();        
                });
            });
       </script>
         </body>

</html>