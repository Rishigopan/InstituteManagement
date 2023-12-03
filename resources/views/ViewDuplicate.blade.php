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

            <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Import Result  </h3>
                  <div class="text-end">
                    <a class="btn AddBtn" href="{{url('/enquiryTable')}}">View</a>
                  </div>
                </div>
               
                <div class="row">
                  <div class="row mt-3 ms-1">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">        
                        <div class="duplicate-card">
                            <div class="row p-2">
                                <div class="col-8 ">
                                    <h6 class="mb-0 "><b>Total InsertedData</b></h6>
                                    <p class="ms-2 assigncard mb-1">{{$insertData}}</p>                                                       
                                </div>
                                <div class="col-4 px-2">
                                    <img class="assignimage" src="{{url('assets/images/assignsenquiry.png')}}" style="width:70px; height:60px;">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">        
                      <div class="duplicateview-card">
                          <div class="row p-2">
                              <div class="col-8 ">
                                  <h6 class="mb-0 "><b>Total DuplicateData</b></h6>
                                  <p class="ms-2 assigncard mb-1">{{$Count}}</p>                                                       
                              </div>
                              <div class="col-4 px-2">
                                  <img class="assignimage" src="{{url('assets/images/assignsenquiry.png')}}" style="width:70px; height:60px;">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">        
                    
                </div>  
                </div> 
                 
                 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  
                  <table id="example2" class="table table-bordered table-hover">
                    
                    <thead>
                    <tr>
                      <th>Name</th>
                      <th>Mobile NUmber</th>   
                      <th>Course</th> 
                      <th hidden></th>
                      <th>LEAD DATA/ENQUIRY DATA</th>
                    </tr>
                    </thead>
                    <tbody>
                     
                        @foreach ($duplicateData as $row)
                        <tr>
                            <td>{{ $row['name'] ?? '' }}</td>
                            <td>{{ $row['mob_no']  }}</td>
                            <td>{{ $row['course'] ?? '' }}</td>
                           
                            <td hidden>{{ request()->branch_id}}</td>
                            <td >{{ $leaddata}}</td>
                        </tr>
                        @endforeach
                       
                    </tbody>
                
                  </table>
                 
              
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
             
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
        </main>
        @include('layouts.footer')

  </body>

  </html>