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
    <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Fee Type</h4>
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
                <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                    <thead class="tablehead">
                        <tr>
                            <th class="text-center">Id</th>
                            <th class="text-center">Fee Type</th>
                            <th class="text-center">Remarks</th>
                            <th class="text-center">Actions</th>
                           
                        </tr>                                           
                    </thead>
                    <tbody>
                        @foreach($feetype as $feetyp)
                        <tr>
                            <td class="text-center">{{ $feetyp->id }}</td>
                            <td class="text-center">{{ $feetyp->fee_type_name }}</td>
                            <td class="text-center">{{ $feetyp->remark }}</td>
                            <td class="text-center">
                    
                                <i class="ri-eye-line ms-2" data-bs-toggle="modal"data-bs-target="#viewfeetype" wire:click="viewfeetype({{ $feetyp->id }})" style="color: #010409;"></i>                                
                                <i class="bi bi-pencil" data-bs-toggle="modal"  data-bs-target="#openUpdateModal" wire:click="editfeetype({{ $feetyp->id }})" style="color: #010409;"></i>
                                <i class="bi bi-trash3" data-bs-toggle="modal" data-bs-target="delModal" wire:click="alertConfirm({{ $feetyp->id }})"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                   
                </table>
            </div>
        </div>
    </div>
</div> 


{{-- <==========add modal==============> --}}
<div class="modal-dialog modal-dialog-centered modal-md">


    <div wire:loading wire:target="saveData" class="text-center">Saving...</div>
    <div wire:ignore.self class="modal showModal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" data-bs-backdrop="static" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modelhead py-2">
                    <h6 class="modal-title" id="exampleModalLabel">Add Fee Type</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                <form wire:submit.prevent="saveData" >
    <div class="row">
        <div class=" col-12">
            <label class="mt-2 mb-1 inputlabel">Fee Category<span  style="color:red; font-size:15px" > *</span></label><br>
            <input type="text" class="form-control mt-1 inputfield" wire:model="fee_type_name" id="type_name" name="fee_type_name" placeholder="Enter Fee Type Name" autofocus required>
            @error('fee_type_name')
            <span class="error">{{ $message }}</span>
        @enderror
        </div>                           
        <div class=" col-12">
            <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
            <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" wire:model="remark" id="remark" name="remark" placeholder="Enter Remarks"></textarea>
            @error('remark')
            <span class="error">{{ $message }}</span>
        @enderror
        </div>                            
    </div>
    <div class=" text-end mt-3">
        <button type="submit" wire:click="alertSuccess" class="btn savebtn  px-5 ">Save</button>
    </div>
</form> 
                </div>
</div>
</div>
</div>

</div>
{{-- <========================edit modal=============> --}}

<form wire:submit.prevent="updateData">
    <div wire:loading wire:target="updateData" class="text-center">Saving...</div>
        <div wire:ignore.self class="modal fade" id="openUpdateModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
            aria-hidden="true" style="display: ">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header modelhead py-2">
                        <h6 class="modal-title" id="exampleModalLabel">Edit Fee Type</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeModals"></button>
                    </div>
                    <div class="modal-body">
        <div class="row">
            <div class=" col-12">
                <input type="hidden"  id="update_fee_category_id" >
                <label class="mt-2 mb-1 inputlabel">Fee Type<span  style="color:red; font-size:15px" > *</span></label><br>
                <input type="text" class="form-control mt-1 inputfield" id="update_fee_type_name" wire:model="fee_type_name" name="fee_type_name"  autofocus required>
            </div>                           
            <div class=" col-12">
                <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="update_remark" wire:model="remark" name="remark" placeholder="Enter Remarks"></textarea>
            </div>      
            <input type="hidden"  id="updated_by" value="0" >

        </div>
        <div class=" text-end mt-3">
            <button type="submit" class="btn savebtn  px-5 " wire:click="closeModals">Update</button>
        </div>
                    </div>
    </div>
</div>
</div>
    </form> 



    {{-- <--------------------view modal--------------------------> --}}
        <form wire:submit.prevent="viewData">
            <div wire:loading wire:target="viewData" class="text-center">Saving...</div>
                <div wire:ignore.self class="modal fade" id="viewfeetype" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-hidden="true" style="display: ">
        
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header modelhead py-2">
                                <h6 class="modal-title" id="exampleModalLabel">View Fee Type</h6>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    wire:click="closeModals"></button>
                            </div>
                            <div class="modal-body">
                <div class="row">
                    <div class=" col-12">
                        <input type="hidden"  id="update_fee_category_id" >
                        <label class="mt-2 mb-1 inputlabel">Fee Type<span  style="color:red; font-size:15px" > *</span></label><br>
                        <input type="text" class="form-control mt-1 inputfield" id="update_fee_type_name" wire:model="fee_type_name" name="fee_type_name"  autofocus required readonly>
                    </div>                           
                    <div class=" col-12">
                        <label class="mt-3 mb-1 inputlabel">Remarks </label><br>
                        <textarea  cols="30" rows="2" class="form-control mt-1 inputfield" id="remark" wire:model="remark" name="remark" readonly></textarea>
                    </div>      
                    <input type="hidden"  id="updated_by" value="0" >
        
                </div>
                            </div>
                            <div class=" text-end mt-3">
                                <button type="button" class="btn savebtn  px-5 "data-bs-dismiss="modal" aria-label="Close">Close</button>
                            </div> 
            </div>
        </div>
        </div>
            </form> 

</div>

</div>
