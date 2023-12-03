<div>
    <!-- Response Modal -->
    <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-3 py-5">
                <div class="text-center mb-4" id="ResponseImage">
 
                </div>
                <h4 id="ResponseText" class="text-center mb-3"></h4>
                <div class="text-center">
                    <button type="button" id="btnConfirm" style="display: none;"
                        class="btn btn_save mt-4 px-5 py-2" data-bs-dismiss="modal">Proceed</button>
                    <button type="button" id="btnClose" class="btn btn_save responsebtn mt-4 px-5 py-2"
                        data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>
 </div>
 <div class="container-fluid px-4 ">
   <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Academic Year</h4>
 </div>
 <div class="wrapper">
     <!--CONTENTS-->
     <div class="container-fluid mainContents">
         <div class="card card-body main_card mt-2 p-3 mb-2">                           
             <div class="main_heading d-flex justify-content-between mb-2  p-2 ">
                 {{-- <div id="exportbtns"class="exportbtns">
                     <!-- export buttons -->
                     <div class="dt-buttons btn-group flex-wrap">   
                         <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="MasterTable" type="button">
                             <span>Excel</span></button> 
                             <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="MasterTable" type="button">
                                 <span>PDF</span></button> 
                                 <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="MasterTable" type="button">
                                     <span>Print</span>
                                 </button> 
                     </div>
                 </div> --}}
                 <div>
                     <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                 </div>
                 
                 <div class="">
                     <button class="btn AddBtn px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">+  Add</button> 
                 </div>
             </div>
             <div class="admintoolbar">
             </div>
             <div class="table-responsive">
                 <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                     <thead class=" tablehead">
                         <tr>
                             <th class="text-center">Sl.No</th>
                             <th class="text-center">Academic Year</th>
                             <th class="text-center">Remarks</th>
                             <th class="text-center">Actions</th>
                             
                         </tr>                                           
                     </thead>
                     <tbody>
                         @foreach($years as $year)
                         <tr>
                             <td class="text-center"></td>
                             <td class="text-center">{{ $year->year }}</td>
                             <td class="text-center">{{ $year->remark }}</td>
                             <td class="text-center">
                                 
                                 <i class="bi bi-pencil" data-bs-toggle="modal"  data-bs-target="#openUpdateModal" wire:click="edityear({{ $year->id }})" style="color: #010409;"></i>
 
                                 <i class="bi bi-trash3" data-bs-toggle="modal" data-bs-target="delModal" wire:click="alertConfirm({{ $year->id }})" ></i>
 
                             </td>
                             
                         </tr>
                       @endforeach
                     </tbody>
                    
                 </table>
                
             </div>
             <div class="bottom"><div class="dataTables_info" id="MasterTable_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div><div class="dataTables_paginate paging_simple_numbers" id="MasterTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="MasterTable_previous"><a aria-controls="MasterTable" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link"><i class="bi bi-caret-left-fill"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="MasterTable" aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="MasterTable_next"><a aria-controls="MasterTable" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link"><i class="bi bi-caret-right-fill"></i></a></li></ul></div></div>
         </div>
     </div>
 </div>
 {{-- <==========add modal==============> --}}
 
 <form wire:submit.prevent="saveData">
     <div wire:loading wire:target="saveData" class="text-center">Saving...</div>
     <div wire:ignore.self class="modal showModal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" data-bs-backdrop="static"data-bs-keyboard="false" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header modelhead py-2">
                     <h6 class="modal-title" id="exampleModalLabel">Add Fee Type</h6>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                         wire:click="closeModals"></button>
                 </div>
                 <div class="modal-body">
     <div class="row">
         <div class=" col-12">
             <label class="mt-2 mb-1 inputlabel">Academic Year<span  style="color:red; font-size:15px" > *</span></label><br>
             <input type="text" class="form-control mt-1 inputfield" wire:model="year" id="year" name="year" placeholder="Enter Academic Year" autofocus required>
          
         </div>                           
         <div class=" col-12">
             <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
             <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" wire:model="remark" id="remark" name="remark" placeholder="Enter Remarks"></textarea>
      
         </div>                            
     </div>
     <div class=" text-end mt-3">
         <button type="submit" wire:click="alertSuccess" class="btn savebtn  px-5 ">Save</button>
     </div>
                 </div>
 </div>
 </div>
 </div>
 </form> 
 {{-- <========================edit modal=============> --}}
 
 <form wire:submit.prevent="updateData">
     <div wire:loading wire:target="updateData" class="text-center">Saving...</div>
         <div wire:ignore.self class="modal fade" id="openUpdateModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
             aria-hidden="true" style="display: ">
 
             <div class="modal-dialog modal-dialog-centered" role="document">
                 <div class="modal-content">
                     <div class="modal-header modelhead py-2">
                         <h6 class="modal-title" id="exampleModalLabel">Edit Academic Year</h6>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                             wire:click="closeModals"></button>
                     </div>
                     <div class="modal-body">
         <div class="row">
             <div class=" col-12">
                 <input type="hidden"  id="update_year_id" >
                 <label class="mt-2 mb-1 inputlabel">Academic Year<span  style="color:red; font-size:15px" > *</span></label><br>
                 <input type="text" class="form-control mt-1 inputfield" id="update_year" wire:model="year" name="year"  autofocus required>
             </div>                           
             <div class=" col-12">
                 <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                 <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="remark" wire:model="remark" name="remark" ></textarea>
             </div>      
             <input type="hidden"  id="updated_by" value="0" >
 
         </div>
         <div class=" text-end mt-3">
             <button type="submit" class="btn savebtn  px-5 ">Update</button>
         </div>
                     </div>
     </div>
 </div>
 </div>
     </form> 

    