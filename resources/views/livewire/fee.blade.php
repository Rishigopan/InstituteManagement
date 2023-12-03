<div>
  <div class="container-fluid px-4 ">
      <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Fee Invoice</h4>
  </div>
  
  @livewire('student-card')
  <div class="wrapper">
     
      <!--CONTENTS-->
      <div class="container-fluid mainContents">
        
        <div class="card card-body main_card mt-2 p-3 mb-2">  
          <div class="container">
              {{-- <div class="row"> --}}
              
                <div class="">
                    <button class="btn AddBtn px-4"  style="margin-left:50px" data-bs-toggle="modal" data-bs-target="#exampleModal">View</button> 
                </div> 
                
               
         
                   
                    {{-- <div class="col-xl-4 col-lg-4 col-md-4 col-6 mt-2" >
                <select  wire:model="selectedCourse" class="form-select assigndrop staffDrop " id="course" name="Course">
                    <option hidden value="">Select Course</option>
                    @if(!is_null($selectedStudent))
                    @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    @endif
                </select>
                        </div> --}}
               
               
         
           
               
              {{-- </div> --}}
          
                                
              <div class="main_heading d-flex justify-content-between mb-2  p-2 ">
            
                  
           
              <div class="admintoolbar">
              </div>
            
              </div>
         
                <br>  
            <div class="row">
              <div class="col-sm-4">
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
                                    <select class="form-select branchDrop" wire:model="fee_type">
                                      <option selected="selected">Select Fee Type</option>
                                      <option>Tuition Fee</option>
                                      <option>Processing Fee</option>
                                    </select>
                                  @error('fee_type')
                                    <span class="error">{{ $message }}</span>
                                 @enderror 
                                  </td>
                                  <td>
                                    <input type="text" wire:model="amount" class="form-control mt-1 inputfield" id="input_1" aria-describedby="emailHelp">
                                  @error('amount')
                                    <span class="error">{{ $message }}</span>
                                 @enderror 
                                  </td>
                                </tr>
                                <tr>
                                  
                                  <td>
                                    <select class="form-select branchDrop" wire:model="fee_type">
                                      <option selected="selected">Select Fee Type</option>
                                      <option>Tuition Fee</option>
                                      <option>Processing Fee</option>
                                    </select>
                                  @error('fee_type')
                                    <span class="error">{{ $message }}</span>
                                 @enderror 
                                  </td>
                                  <td>
                                    <input type="text" wire:model="amount" class="form-control mt-1 inputfield" id="input_2" aria-describedby="emailHelp">
                                  @error('amount')
                                    <span class="error">{{ $message }}</span>
                                 @enderror 
                                  </td>
                                </tr>
                                <tr>
                                 
                                  <td>
                                    <select class="form-select branchDrop" wire:model="fee_type">
                                      <option selected="selected">Select Fee Type</option>
                                      <option>Tuition Fee</option>
                                      <option>Processing Fee</option>
                                    </select>
                                  @error('fee_type')
                                    <span class="error">{{ $message }}</span>
                                 @enderror 
                                  </td>
                                  <td>
                                    <input type="text" wire:model="amount" class="form-control mt-1 inputfield" id="input_3" aria-describedby="emailHelp">
                                  @error('amount')
                                    <span class="error">{{ $message }}</span>
                                 @enderror 
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
                                  <input type="text" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                </div>
                            
                                <div class="input-group input-group-sm mb-3" >
                                  <div class="input-group-prepend"  >
     
                                         <span class="exampleFormControlTextarea1" ><b>Fine:</b></span>
     
                                           <span style="margin-left:60px; float:right" class="input-group-text">$</span>
                                         </div>
                                         <input type="text" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                       </div>
                                       <div class="input-group input-group-sm mb-3" >
                                        <div class="input-group-prepend"  >
           
                                               <span class="exampleFormControlTextarea1"><b>Discount:</b></span>
           
                                                 <span style="margin-left:25px; float:right" class="input-group-text">$</span>
                                               </div>
                                               <input type="text" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                             </div>
                                             <div class="input-group input-group-sm mb-3">
                                              <span class="exampleFormControlTextarea1"><b>Tax %:</b></span>
          
                                              <input type="text" style="margin-left:50px" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                              <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                              </div>
                                            </div>
                                            <div class="input-group input-group-sm mb-3" >
                                              <div class="input-group-prepend"  >
                 
                                                     <span class="exampleFormControlTextarea1"><b>Tax Value:</b></span>
                 
                                                       <span style="margin-left:25px; float:right" class="input-group-text">$</span>
                                                     </div>
                                                     <input type="text" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                                   </div>
                                            <div class="input-group input-group-sm mb-3" >
                                              <div class="input-group-prepend"  >
                 
                                                     <span class="exampleFormControlTextarea1"><b>Subtotal:</b></span>
                 
                                                       <span style="margin-left:32px; float:right" class="input-group-text">$</span>
                                                     </div>
                                                     <input type="text" style="float:right" class="form-control mt-1 inputfield" aria-label="Amount (to the nearest dollar)">
                                                   </div>
           
                             
                              </div>
                              
                              <div class="col-sm-4">
                                <div class="container">
                                  
                                      <div class="form-group">
                                          <label for="exampleFormControlTextarea1"><b>Notes:</b></label><br>
                                          <textarea class="form-control mt-1 inputfield" wire:model="notes" id="exampleFormControlTextarea1" rows="3" placeholder="Your Notes"></textarea>
                                        @error('notes')
                                          <span class="error">{{ $message }}</span>
                                       @enderror 
                                        </div> <br>
                                        <button type="submit" class="btn savebtn  px-5" >Save</button>
                 
                                 
                                  </div>
                                </div>
                           
                             
                
                   
          </div>
                 
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(".js-example-tags").select2({
tags: true
});
</script>