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
   <h4 class="mt-1 d-flex justify-content-center py-1 contitle">Fee Category</h4>
</div>

<div class="wrapper">
    <!--CONTENTS-->
    <div class="container-fluid mainContents">
        <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">                           
            <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                {{-- <div id="exportbtns"class="exportbtns">
                    <!-- export buttons -->
                    <div class="dt-buttons btn-group flex-wrap">   
                        <button class="btn btn-secondary buttons-excel buttons-html5" wire:loading.attr="disabled" tabindex="0" aria-controls="MasterTable" type="button">
                            <span>Excel</span></button> 
                            <button class="btn btn-secondary buttons-pdf buttons-html5"  tabindex="0" aria-controls="MasterTable" type="button">
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
                    {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                </div>
            </div>
            
            
            <div class="table-responsive">
                <table class="table  table-hover MasterTable" id="MasterTable" >
                    <thead class="tablehead">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Fee Category</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Active</th>                                  
                            <th class="text-center">Default</th>
                            <th class="text-center">Actions</th>

                        </tr>                                           
                    </thead>
                    <tbody>
                        @foreach ($fee as $fee_cat)
                        <tr>
                            <td class="text-center">{{ $fee_cat->id }}</td>
                            <td class="text-center">{{ $fee_cat->category_name }}</td>
                            <td class="text-center">{{ $fee_cat->remark }}</td>
                          
                            <td class="text-center">
                             @livewire('toggle-switch', ['model' => $fee_cat, 'field' => 'isActive'], key($fee_cat->id))
                            </td>
                            <td class="text-center">
                             @livewire('toggle-switch', ['model' => $fee_cat,  'field' => 'isDefault'], key($fee_cat->id))
                         
                            </td>
                            <td class="text-center">
                                <i class="ri-eye-line ms-2" data-bs-toggle="modal"data-bs-target="#viewfeecategory" wire:click="viewFeecategory({{ $fee_cat->id }})" style="color: #010409;"></i>                                
    
                                   <i class="bi bi-pencil" data-bs-toggle="modal"  data-bs-target="#openUpdateModal" wire:click="editFeecategory({{ $fee_cat->id }})" style="color: #010409;"></i>
    
                                   <i class="bi bi-trash3" data-bs-toggle="modal" data-bs-target="delModal" 
                                   wire:click="alertConfirm({{ $fee_cat->id }})"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   
                </table>
                <div class="bottom"><div class="dataTables_info" id="MasterTable_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div><div class="dataTables_paginate paging_simple_numbers" id="MasterTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="MasterTable_previous"><a aria-controls="MasterTable" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link"><i class="bi bi-caret-left-fill"></i></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="MasterTable" aria-role="link" aria-current="page" data-dt-idx="0" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="MasterTable_next"><a aria-controls="MasterTable" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link"><i class="bi bi-caret-right-fill"></i></a></li></ul></div>
            </div>
            </div>
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
                   <h6 class="modal-title" id="exampleModalLabel">Add Fee Category</h6>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                       wire:click="closeModals"></button>
               </div>
               <div class="modal-body">
   <div class="row">
       <div class=" col-12">
           <label class="mt-2 mb-1 inputlabel">Fee Category<span  style="color:red; font-size:15px" > *</span></label><br>
           <input type="text" class="form-control mt-1 inputfield" wire:model="category_name" id="category_name" name="category_name" placeholder="Enter Fee Category Name" autofocus required>
           @error('category_name')
           <span class="error">{{ $message }}</span>
       @enderror
       </div> 
                              
       <div class=" col-12">
           <label class="mt-3 mb-1 inputlabel">Remarks</label><br>
           <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" wire:model="remark" id="remark" name="remark" placeholder="Enter Remarks" autofocus></textarea>
           @error('remark')
           <span class="error">{{ $message }}</span>
       @enderror
       </div>   
       <input type="hidden"  id="updated_by" value="0" >
                         
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


   <div wire:loading wire:target="updateCategory" class="text-center">Saving...</div>
       <div wire:ignore.self class="modal fade" id="openUpdateModal" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
           aria-hidden="true" style="display: ">

           <div class="modal-dialog modal-dialog-centered" class="text-center" role="document">
               <div class="modal-content">
                   <div class="modal-header modelhead py-2">
                       <h6 class="modal-title" id="exampleModalLabel">Edit Fee Category</h6>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                           wire:click="closeModals"></button>
                   </div>
                   <div class="modal-body">
                    <form wire:submit.prevent="updateCategory">
       <div class="row">
           <div class=" col-12">
               <input type="hidden"  id="update_fee_category_id" >
               <label class="mt-2 mb-1 inputlabel">Fee Category<span  style="color:red; font-size:15px" > *</span></label><br>
               <input type="text" class="form-control mt-1 inputfield" id="update_category_name" wire:model="category_name" name="category_name"  autofocus required>
           </div>                           
           <div class=" col-12">
               <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
               <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="remark" wire:model="remark" name="remark" ></textarea>
           </div>      
           <input type="hidden"  id="updated_by" value="0" >

       </div>
       <div class=" text-end mt-3">
           <button type="submit" class="btn savebtn px-5 " wire:click="closeModals">Update</button>
       </div>
    </form>
                   </div>
   </div>
</div>
</div>
    

 

   
    {{-- <--------------------view modal--------------------------> --}}
        <form wire:submit.prevent="viewData">
            <div wire:loading wire:target="viewData" class="text-center">Saving...</div>
                <div wire:ignore.self class="modal fade" id="viewfeecategory" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-hidden="true" style="display: ">
        
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header modelhead py-2">
                                <h6 class="modal-title" id="exampleModalLabel">View Fee Category</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    wire:click="closeModals"></button>
                            </div>
                            <div class="modal-body">
                <div class="row">
                    <div class=" col-12">
                        <input type="hidden"  id="view_fee_category_id" >
                        <label class="mt-2 mb-1 inputlabel">Fee Category<span  style="color:red; font-size:15px" > *</span></label><br>
                        <input type="text" class="form-control mt-1 inputfield" id="view_category_name" wire:model="category_name" name="category_name"  autofocus required readonly>
                    </div>                           
                    <div class=" col-12">
                        <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                        <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="remark" wire:model="remark" name="remark" readonly></textarea>
                    </div>      
                    <input type="hidden"  id="updated_by" value="0" >
        
                </div>
                            </div>
            </div>
        </div>
        </div>
            </form> 
 
</div>

