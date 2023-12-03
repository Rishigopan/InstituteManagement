<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>INSTON</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <script src=”jquery.json-2.4.min.js”></script>
  <!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>

  <!-- Favicons -->
  <link href="{{url('assets/img/favicon.png')}}" rel="icon">
  <link href="{{url('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
  


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{url('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->

  <header id="header" class="header fixed-top d-flex align-items-center">
      @include('layouts.navbar')
  </header>

  <!-- End Header -->

  <!-- ======= Sidebar ======= -->

  <aside id="sidebar" class="sidebar  ps-0">
      @include('layouts.sidebar')
  </aside>

  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>
    <!-- End Page Title -->

    <section class="section dashboard" id="dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- lead data Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card" style="padding-left:20px;height:8rem">
                <div class="card-body">
                  <h5 class="card-title">Lead Data</h5>

                  <div class="d-flex align-items-center">
                    
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i>  <img src="{{url('assets/images/taskreport.png')}}" style="width:50px; height:50px;"></i>
                    </div>
                    <div class="ps-3">
                      <h2 style="color:#012970" id="lead_data"></h2>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- leada data Card -->

            <!-- Enquiry Card -->
            <div class="col-xxl-3 col-md-6">
              <div class="card info-card sales-card" style="padding-left:20px;height:8rem">
                <div class="card-body">
                  <h5 class="card-title">Enquiry</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i>  <img src="{{url('assets/images/enquiry.png')}}" style="width:50px; height:50px;"></i>

                    </div>
                    <div class="ps-3">
                        <h2 style="color:#012970" id="enquiries"></h2>
                    </div>
                  </div>
                </div>

              </div>
            </div>
    
            <!-- End Enquiry Card -->

            <!-- Admissions Card -->
            <div class="col-xxl-3 col-md-6">

              <div class="card info-card sales-card" style="padding-left:20px;height:8rem">
                <div class="card-body">
                  <h5 class="card-title">Admissions</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i>  <img src="{{url('assets/images/coursetype.png')}}" style="width:50px; height:50px;"></i>

                    </div>
                    <div class="ps-3">
                        <h2 style="color:#012970" id="admissions"></h2>
                    </div>
                  </div>

                </div>
              </div>

            </div>

<!-- Branch Card -->
<div class="col-xxl-3 col-md-6">
    <div class="card info-card sales-card" style="padding-left:20px;height:8rem">
      <div class="card-body">
        <h5 class="card-title">Branches</h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i> <img src="{{url('assets/images/branch.png')}}" style="width:50px; height:50px;"> </i>
          </div>
          <div class="ps-3">
            <h2 style="color:#012970" id="branches"></h2>
          </div>
        </div>
      </div>

    </div>
  </div>


    <!-- Collections Card -->
    <div class="col-xxl-3 col-md-6">

        <div class="card info-card sales-card" style="padding-left:20px;height:8rem">
          <div class="card-body">
            <h5 class="card-title">Fee Collections</h5>

            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i>  <img src="{{url('assets/images/rupee.png')}}" style="width:50px; height:50px;"></i>

              </div>
              <div class="ps-3">
                <h2 style="color:#012970" id="fee">$0</h2>
              </div>
            </div>

          </div>
        </div>

      </div>
                <!-- Feedback Card -->
    <div class="col-xxl-3 col-md-6">

      <div class="card info-card sales-card" style="padding-left:20px;height:8rem">
        <div class="card-body">
          <h5 class="card-title">Feedback</h5>

          <div class="d-flex align-items-center">
            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
              <i>  <img src="{{url('assets/images/feedback.png')}}" style="width:50px; height:50px;"></i>

            </div>
            <div class="ps-3">
              <h2 style="color:#012970" id="feedback"></h2>
            </div>
          </div>

        </div>
      </div>

    </div>
        </div>
    </div>
          
        <!-- End Left side columns -->

        <!-- Right side columns -->
        
        <div class="col-lg-6">
          
          <!-- Admission Statistics -->
        
          <div class="card">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <div class="container-md">
                  <h5 class="card-title">Admission Statistics</h5>
                </div>
                {{-- <table class="table" style="overflow:scroll"> --}}
                  <div class="table-responsive">

                  <table class="table" id="admission_MasterTable">

                    <thead class="tablehead">
                      <tr>
                        <th class="text-center" id="branch">Branch</th>
                        <th class="text-center" id="lead">Lead Data</th>
                        <th class="text-center" id="enquiry_data">Enquiry Data</th>
                        <th class="text-center" id="admission">Admission</th>
                        <th class="text-center" id="admission_percent">Admission (%)</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>
                </div>
                </div>
              </div>
          </div>  
        </div>
            <!-- End Admission Statistics -->

          <!-- Feedback Statistics card -->
         
          <div class="col-lg-6">
          <div class="card">
            <div class="card recent-sales overflow-auto">
            <div class="card-body pb-0">
          <span> <h5 class="card-title">Feedback Statistics
           <button type="button" style="float:right" class="btn btn-warning"></button></h5></span>
        
          <table class="table" id="feedback_MasterTable">
            <thead>
                  <tr>
                    <th scope="col">Feedback Type</th>
                    <th scope="col">Summary</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>

     
            
              <!-- End sidebar recent posts-->
            </div>
            </div>
          </div> 
          <!-- End News & Updates -->

        </div> 
        <!-- End Right side columns -->

      </div>
    </section>

  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  {{-- <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits"> --}}
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer> --}}
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{url('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/vendor/chart.js/chart.min.js')}}"></script>
  <script src="{{url('assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{url('assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{url('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{url('assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{url('assets/vendor/php-email-form/validate.js')}}"></script>


  <!-- Template Main JS File -->
  <script src="{{url('assets/js/main.js')}}"></script>

</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
 
  GetDasboardSummary();
  GetAdmissionSummary();
  
  // GetFeedbackSummary();

  function GetDasboardSummary(){
    var settings = {
      "url": "/api/dashboard",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json"
      },
    };

      $.ajax(settings).done(function (response) {
        //var Response =
        //console.log(response);
        var ResponseArray = response.dashboard;
        // console.log(response.dashboard);
        for(const key in ResponseArray){
          var BranchCount = ResponseArray['BranchCount'];
          var EnquiryCount = ResponseArray['EnquiryCount'];
          var AdmissionCount = ResponseArray['AdmissionCount'];
          var LeadDataCount = ResponseArray['LeadDataCount'];
          var FeedbackCount = ResponseArray['FeedbackCount'];

        $('#branches').text(BranchCount);
        $('#enquiries').text(EnquiryCount);
        $('#admissions').text(AdmissionCount);
        $('#lead_data').text(LeadDataCount);
        $('#feedback').text(FeedbackCount);
        }

      });
  }

  function GetAdmissionSummary(){
    var settings = {
      "url": "/api/dashboard_admission",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json"
      },
    }
  

    $.ajax(settings).done(function(response) {
      var dashboardData = response.dashboard_admission;
      // console.log(dashboardData)

   
      var tableBody = $('#admission_MasterTable tbody');
      tableBody.empty();
      
      $.each(dashboardData, function(index, count) {
        console.log(index);
        if (index == 0) {
          var firstElementId = count.id;
          firstElementBranchName = count.branch_name;
          updateFeedbackCount(firstElementId, firstElementBranchName);

          $('.btn.btn-warning').text(firstElementBranchName);
          
        }
    

        var row = $('<tr></tr>');

        row.append('<td class="text-center"><a href="#" class="branch_feedback" data-branchid="'+ count.id +'">' + count.branch_name + '</td>');
        row.append('<td class="text-center"><a href="{{ url('enquiry') }}">' + count.LeadData + '</td>');
        row.append('<td class="text-center"><a href="{{ url('enquiry') }}">' + count.EnquiryData + '</td>');
        row.append('<td class="text-center"> <a href="{{ url('admission') }}">' + count.Admission + '</td>');
        row.append('<td class="text-center">' + count.Percent + '</td>');
        tableBody.append(row); // Append the row to the table body
       
      
      });
      

    });

  }
     
     

  function GetFeedbackSummary(){


          var settings = {
      "url": "/api/dashboard_feedback",
      "method": "GET",
      "timeout": 0,
      "headers": {
        "Accept": "application/json"
      },
    };

          $.ajax(settings).done(function(response) {
        var FeedbackCount = response.dashboard_feedback;

        //console.log(response);

 

        var tableBody = $('#feedback_MasterTable tbody');
        tableBody.empty();

        $.each(FeedbackCount, function(index, count) {
          var row = $('<tr></tr>');
          row.append('<td class="text-center">' + count.feedback + '</td>');
          row.append('<td class="text-center feedback_count">' + count.FeedbackCount + '</td>');
        
          // console.log(row);

          tableBody.append(row); // Append the row to the table body
        });
      })

         
        }
        
        
        // Event handler for clicking branch feedback link
        
        $(document).on('click','.branch_feedback',function(e) {
                    e.preventDefault();
                    var branchId = $(this).data('branchid');
                    updateFeedbackCount(branchId);
                    // console.log(branchId);
                  });


  function updateFeedbackCount(branchId){
    var settings = {
  "url": "/api/dashboard_feedback",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "branchId": branchId
  }
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

          $.ajax(settings).done(function(response) {
        var FeedbackCount = response.dashboard_feedback;

        console.log(response);

 

        var tableBody = $('#feedback_MasterTable tbody');
        tableBody.empty();

        $.each(FeedbackCount, function(index, count) {
          var row = $('<tr></tr>');
          row.append('<td class="text-center">' + count.feedback + '</td>');
          row.append('<td class="text-center feedback_count">' + count.FeedbackCount + '</td>');
        
          // console.log(row);

          tableBody.append(row); // Append the row to the table body
        });
      })

         
        }

           
                // Get the button element
                var button = document.querySelector('.btn.btn-warning');

      // Add click event listener to the branch feedback links
      $(document).on('click', '.branch_feedback', function() {
        // Get the branch name from the clicked link
        var branchName = $(this).text();
        
        // Update the button text with the selected branch name
        button.innerText = branchName;
      });

          
</script>



</html>