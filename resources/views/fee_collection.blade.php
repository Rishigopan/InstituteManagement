<!DOCTYPE html>
<html lang="en">
   
  <head>

     @include('layouts.headder')
     <style>
        .mainContents{
            display:none;
        }
    </style>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <main id="main" class="">

             
            
                <div class="container-fluid ">
                    <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Fee Collection</h4>      
                </div>
                <div class="admintoolbar">
                </div>
                <div class="wrapper">
                    <!--CONTENTS-->
                    <div class="container-fluid"  id="student-details-container"  style="border-radius:10px;">
                        <div class="card mb-3" style="max-width: 100%;">
                          <div class="row no-gutters">
                            <div class="col-md-4">
                            
                                <select class="form-select inputfield" aria-label="Default select example name" id="student_id" name="student_id"  required >
                                  <option class="inputlabel" value="student_id"> Choose Student</option>  
                                        @foreach($student as $key)
                                  <option value="{{ $key->id }}">{{ $key->name }}</option>  
                                        @endforeach
                                                                                                
                                </select> 
                               
                             
                              
                            </div>
                            <div class="col-md-3">
                              <img id="student-image" src="https://cdn.discordapp.com/attachments/948596391855394826/1108367985539817512/user_avtaar.png" alt="Student Image" width="200">
                          
                              </div>
                            <div class="col-md-4">
                              
                              
                                <table id="student_data">       
                                    <tbody>
                                      <tr>
                                        <th style="text-align: left;">Name : </th>
                                        <td style="text-align: left; padding-left: 10px;" id="name"></td>
                                      </tr><br>
                                      <tr>
                                        <th style="text-align: left;">Course : </th>
                                        <td style="text-align: left; padding-left: 10px;" id="course"></td>
                                      </tr>
                                      <tr>
                                        <th style="text-align: left;">Branch : </th>
                                        <td style="text-align: left; padding-left: 10px;" id="branch"></td>
                                      </tr>
                                      <tr>
                                        <th style="text-align: left;">Email id: </th>
                                        <td style="text-align: left; padding-left: 10px;" id="email"></td>
                                      </tr>
                                      <tr>
                                        <th style="text-align: left;">Mobile : </th>
                                        <td style="text-align: left; padding-left: 10px;" id="mob"></td>
                                      </tr>
                                    
                                    </tbody>
                                  </table>
                                  
                           
                          
                            </div>
                           
                          </div>
                        </div>
                        
                        </div>
                        {{-- <div class="">
                            <button class="btn AddBtn px-4"  style="margin-left:50px" data-bs-toggle="modal" data-bs-target="#exampleModal">View</button> 
                        </div>  --}}
                        <br>  
                        
                        <div class="row">
                          <div class="col-sm-4">
                            <form action="{{ route('fee-collection.store') }}" id="add_feecollection" method="POST" novalidate>
                                {{ csrf_field() }}
                                    <div class="container">
                                
                                          <table class="table table-bordered" >
                                            <thead>
                                              <tr>
                                                <th class="text-center">Fee type</th>
                                                <th class="text-center">Fee Amount</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                             
                                              <td>
                                                <select class="form-select inputfield " aria-label="Default select example name" id="fee_type1" name="fee_type1" required>
                                                    <option class="inputlabel" value="fee_type1"> Choose Fee Type</option>  
                                                        @foreach($fee_type as $key)
                                                    <option value="{{ $key->id }}">{{ $key->fee_type_name }}</option>  
                                                        @endforeach
                                                                                                                
                                                </select> 
                                              </td>
                                              <td>
                                                <input type="number" id="amount_1" name="amount_1" class="form-control mt-1 inputfield"  aria-describedby="emailHelp"  oninput="calculateTotal()">
                                             
                                              </td>
                                            </tr>
                                            <tr>
                                              
                                              <td>
                                                <select class="form-select inputfield " aria-label="Default select example name" id="fee_type2" name="fee_type2" required>
                                                    <option class="inputlabel" value="fee_type2"> Choose Fee Type</option>  
                                                        @foreach($fee_type as $key)
                                                    <option value="{{ $key->id }}">{{ $key->fee_type_name }}</option>  
                                                        @endforeach
                                                                                                                
                                                </select> 
                                            
                                              </td>
                                              <td>
                                                <input type="number" id="amount_2" name="amount_2" class="form-control mt-1 inputfield"  aria-describedby="emailHelp"  oninput="calculateTotal()">
                                             
                                              </td>
                                            </tr>
                                            <tr>
                                             
                                              <td>
                                                <select class="form-select inputfield " aria-label="Default select example name" id="fee_type3" name="fee_type3" required>
                                                    <option class="inputlabel" value="fee_type3"> Choose Fee Type</option>  
                                                        @foreach($fee_type as $key)
                                                    <option value="{{ $key->id }}">{{ $key->fee_type_name }}</option>  
                                                        @endforeach
                                                                                                                
                                                </select> 
                                            
                                              </td>
                                              <td>
                                                <input type="number" id="amount_3" name="amount_3" class="form-control mt-1 inputfield" aria-describedby="emailHelp"  oninput="calculateTotal()">
                                              
                                              </td>
                                            </tr>
                                              </tbody>
            
                                         
                                          </table>
                                       
                                        </div>
                                      </div>
                                  
                              
                               
                                      <div class="col-sm-4">
                                          
                                          <div class="input-group input-group-sm mb-3" >
                                       <div class="input-group-prepend"  >
            
                                              <span class="exampleFormControlTextarea1"><b>Total:</b></span>
            
                                                <span style="margin-left:52px; float:right" class="input-group-text">$</span>
                                              </div>
                                              <input type="number" style="float:right" class="form-control mt-1 inputfield" id="total" name="total"aria-label="Amount (to the nearest dollar)" readonly value="{{ session('total') }}">

                                            </div>
                                        
                                            <div class="input-group input-group-sm mb-3" >
                                              <div class="input-group-prepend"  >
                 
                                                     <span class="exampleFormControlTextarea1" ><b>Fine:</b></span>
                 
                                                       <span style="margin-left:60px; float:right" class="input-group-text">$</span>
                                                     </div>
                                                     <input type="number" id="fine" name="fine" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                                   </div>
                                                   <div class="input-group input-group-sm mb-3" >
                                                    <div class="input-group-prepend"  >
                       
                                                           <span class="exampleFormControlTextarea1"><b>Discount:</b></span>
                       
                                                             <span style="margin-left:25px; float:right" class="input-group-text">$</span>
                                                           </div>
                                                           <input type="number" id="discount" name="discount" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                                         </div>
                                                         {{-- <div class="input-group input-group-sm mb-3">
                                                          <span class="exampleFormControlTextarea1"><b>Tax %:</b></span>
                      
                                                          <input type="text" id="tax_percent" style="margin-left:50px" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                                          <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                          </div>
                                                        </div> --}}
                                                        <div class="input-group input-group-sm mb-3" >
                                                          <div class="input-group-prepend"  >
                             
                                                                 <span class="exampleFormControlTextarea1"><b>Tax Value:</b></span>
                             
                                                                   <span style="margin-left:25px; float:right" class="input-group-text">$</span>
                                                                 </div>
                                                                 <input type="number" style="float:right" class="form-control mt-1 inputfield" id="tax_value" name="tax_value" aria-label="Amount (to the nearest dollar)"   value="{{ session('taxValue') }}" >
                                                               </div>
                                                        <div class="input-group input-group-sm mb-3" >
                                                          <div class="input-group-prepend"  >
                             
                                                                 <span class="exampleFormControlTextarea1"><b>Subtotal:</b></span>
                             
                                                                   <span style="margin-left:32px; float:right" class="input-group-text">$</span>
                                                                 </div>
                                                                 <input type="number" style="float:right" class="form-control mt-1 inputfield" id="subtotal" name="subtotal" aria-label="Amount (to the nearest dollar)" readonly value="{{ session('subtotal') }}">
                                                               </div>
                       
                                         
                                          </div>
                                          
                                          <div class="col-sm-4">
                                            <div class="container">
                                              
                                                  <div class="form-group">
                                                      <label for="exampleFormControlTextarea1"><b>Notes:</b></label><br>
                                                      <textarea id="notes"  name="notes" class="form-control mt-1 inputfield" id="exampleFormControlTextarea1" rows="3" placeholder="Your Notes"></textarea>
                                                   
                                                    </div> <br>
                                                    <button type="submit" class="btn savebtn  px-5" >Save</button>
                             
                                             
                                              </div>
                                            </div>
                                        </form>                
                      </div>
                </div>   
            </div>
          
        </main><!-- End #main -->  

         @include('layouts.footer')
        
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         
       
        <script>


            //select student and get details



            $(document).ready(function() {
        $('#student_id').change(function() {
            var studentId = $(this).val();
            
            if (studentId !== '') {
                $.ajax({
                    url: '{{ route("studentDetails") }}',
                    type: 'POST',
                    data: { studentId: studentId },
                    success: function(response) {
                        $('#name').text(response.name);
                        $('#course').text(response.course);
                        $('#branch').text(response.branch);
                        $('#email').text(response.email);
                        $('#mob').text(response.mob_no);
                        $('#student-image').attr('src', response.photo);
                        

                        console.log(response.photo);
                    }
                });
            } else {
                // Clear the student details if no student is selected
                $('#name').text('');
                $('#course').text('');
                $('#branch').text('');
                $('#email').text('');
                $('#mob').text('');
                $('#student-image').attr('src', '');
            }
        });
    });
      
    //get student image

             

      //calculation part

      $(document).ready(function() {
  // Calculate total and update fields on input change
  $(".inputfield").on("input", function() {
    calculateTotal();
  });

  function calculateTotal() {
    var amount_1 = parseFloat($("#amount_1").val()) || 0;
    var amount_2 = parseFloat($("#amount_2").val()) || 0;
    var amount_3 = parseFloat($("#amount_3").val()) || 0;
    var fine = parseFloat($("#fine").val()) || 0;
    var discount = parseFloat($("#discount").val()) || 0;
    var taxAmount = parseFloat($("#tax_value").val()) || 0;

    var total = amount_1 + amount_2 + amount_3;
    var subtotal = amount_1 + amount_2 + amount_3 + fine - discount + taxAmount;

    $("#subtotal").val(subtotal.toFixed(2));
    $("#total").val(total.toFixed(2));
  }

  // Ajax call to update server-side data
  $(".inputfield").on("input", function() {
    $.ajax({
      url: "your_server_side_script.php", // Replace with your server-side script URL
      method: "POST", // Use appropriate HTTP method (POST/GET)
      data: {
        // Pass the input values as data to the server
        amount_1: $("#amount_1").val(),
        amount_2: $("#amount_2").val(),
        amount_3: $("#amount_3").val(),
        fine: $("#fine").val(),
        discount: $("#discount").val(),
        taxAmount: $("#tax_value").val()
      },
      success: function(response) {
        // Handle the server's response here if needed
        console.log(response);
      },
      error: function(xhr, status, error) {
        // Handle errors here if needed
        console.log(error);
      }
    });
  });
});


        //   $(document).ready(function() {
        //     // Calculate total and update fields on input change
        //     $(".inputfield").on("input", function() {
        //       calculateTotal();
        //     });
            
        //   function calculateTotal() {
        //     var amount_1 = parseFloat(document.getElementById("amount_1").value) || 0;
        //     var amount_2 = parseFloat(document.getElementById("amount_2").value) || 0;
        //     var amount_3 = parseFloat(document.getElementById("amount_3").value) || 0;
        //     var fine = parseFloat(document.getElementById("fine").value) || 0;
        //     var discount = parseFloat(document.getElementById("discount").value) || 0;
        //     var taxAmount = parseFloat(document.getElementById("tax_value").value) || 0;

        //     var total = amount_1 + amount_2 + amount_3;
        //     var subtotal = amount_1 + amount_2 + amount_3 + fine - discount + taxAmount;
        

        //     document.getElementById("subtotal").value = subtotal.toFixed(2);
        //     document.getElementById("total").value = total.toFixed(2);
        // }
         
        //   });

      
        </script> 
           


