<div>
   




    {{-- <div wire:loading wire:target="saveData" class="text-center">Saving...</div> --}}

    <div wire:ignore.self class="modal showModal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true" wire:model="showModal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content cntrymodalbg">

                <div class="modal-header modelhead py-2">

                    <h6 class="modal-title" id="exampleModalLabel"> Task Template</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveData">
                        <div class="row">
                            <div class=" col-xl-6 col-lg-12 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Category</label><br>
                                <select class="form-select inputfield " wire:model="selectedTaskCategory"
                                    aria-label="Default select example name" id="task_category_id"
                                    name="task_category_id">

                                    <option class="inputlabel" hidden value="0"> Select Task Category
                                    </option>
                                    @foreach ($taskcatagory as $Category)
                                        <option value="{{ $Category['id'] }}">{{ $Category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Name</label><br>
                                <input type="text" class="form-control inputfield" id="task_name" name="taskName"
                                    placeholder="Enter Task Name" wire:model="taskName" autofocus required>
                                @error('taskName')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <input class="form-check-input mt-4" type="checkbox" value="" id="is_repeat"
                                        name="IsRepeat" wire:model="isChecked">

                                    <label class="form-check-label inputlabel mt-4 mx-2" for="is_repeat">
                                        check if the task repetitive
                                    </label>
                                </div>
                                <div class=" col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Repeat Cycle </label><br>
                                    <select class="form-select inputfield " aria-label="Default select example name"
                                        id="repetcycle" name="Repetcycle" wire:model="Repetcycle"
                                        @if (!$isChecked) disabled @endif>
                                        <option class="inputlabel" hidden value="0" hidden> Select Repeat Cycle
                                        </option>
                                        <option class="inputlabel" value="1">Monthly</option>
                                        <option class="inputlabel" value="2">Yearly</option>
                                        <option class="inputlabel" value="3">Quarterly</option>
                                        <option class="inputlabel" value="4">Daily</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="mt-3 mb-1 inputlabel">Task Description </label><br>
                                <textarea cols="30" rows="3" class="form-control mt-1 inputfield" id="task_desc" name="Description"
                                    placeholder="Enter Task Description" wire:model="Description"></textarea>
                                @error('Description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Task Checklist</label><br>
                                    <input type="text" class="form-control mt-1 inputfield checkList"
                                        id="task_checklist" name="TaskChecklist" placeholder="Enter Task Checklist"
                                        wire:model="checkList">

                                    <div class="text-center">
                                        <button type="button" class="btn savebtn px-3 mt-2 text-center"
                                            wire:click="addData">Add</button>
                                    </div>
                                </div>

                                <div class="table-responsive col-xl-6 col-lg-6 col-12 mt-4">
                                    <div style="max-height: 300px; overflow-y: scroll;">
                                        <table class="table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                            <thead class=" tablehead">
                                                <tr>
                                                    <th class="text-center">Si No</th>
                                                    <th class="text-center">Task Checklist</th>
                                                    {{-- <th class="text-center">Edit</th>
                                                <th class="text-center">Delete</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @foreach ($data as $item)
                                                        <td>{{ $item['serial'] }}</td>
                                                        <td>{{ $item['task'] }}</td>
                                                        {{-- <td><span wire:click="editData({{ $item['id'] }})">
                                                            <i class="ri-pencil-line" aria-hidden="true"></i></span>
                                                    </td>
                                                    <td><i class="bi bi-trash3" data-bs-toggle="modal"
                                                            data-bs-target="delModal"
                                                            wire:click="alertConfirm({{ $item['id'] }})"></i></td> --}}

                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class=" text-end mt-3">
                                <button type="submit" class="btn btn-success btn-lg refresh px-5 ">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>



    {{-- <----------------UpdateForm----------------> --}}
    <form wire:submit.prevent="updateData">
        <div wire:loading wire:target="updateData" class="text-center">Saving...</div>

        <div wire:ignore.self class="modal fade" id="openUpdateModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true"
            style="display: {{ $exampleModal ? 'block' : 'none' }}">
            <div class="modal-dialog modal-dialog-centered modal-lg">

                <div class="modal-content cntrymodalbg">

                    <div class="modal-header modelhead py-2">

                        <h6 class="modal-title" id="exampleModalLabel"> Task Tempalate</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeModals"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="update_department_id">
                            <div class=" col-xl-6 col-lg-12 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Category</label><br>
                                <select class="form-select inputfield " wire:model="selectedTaskCategory"
                                    aria-label="Default select example name" id="task_category_id"
                                    name="task_category_id">

                                    <option class="inputlabel" hidden value="0"> Select Task Category
                                    </option>
                                    @foreach ($taskcatagory as $Category)
                                        <option value="{{ $Category['id'] }}">{{ $Category['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" col-xl-6 col-lg-6 col-12">
                                <label class="mt-2 mb-1 inputlabel"> Task Name</label><br>
                                <input type="text" class="form-control inputfield" id="task_name" name="taskName"
                                    placeholder="Enter Task Name" wire:model="taskName" autofocus required>
                                @error('taskName')
                                    <span class="error">{{ $message }}</span>
                                @enderror


                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <input class="form-check-input mt-2" type="checkbox" value=""
                                        id="is_repeat" name="IsRepeat" wire:model="isChecked" checked>

                                    <label class="form-check-label inputlabel mt-2 mx-2" for="is_repeat">
                                        check if the task repetitive
                                    </label>
                                </div>
                                <div class=" col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Repeat Cycle </label><br>
                                    <select class="form-select inputfield " aria-label="Default select example name"
                                        id="repetcycle" name="Repetcycle" wire:model="Repetcycle"
                                        @if (!$isChecked) disabled @endif>
                                        <option class="inputlabel" hidden value="0" hidden> Select Repeat Cycle
                                        </option>
                                        <option class="inputlabel" value="1">Monthly</option>
                                        <option class="inputlabel" value="2">Yearly</option>
                                        <option class="inputlabel" value="3">Quarterly</option>
                                        <option class="inputlabel" value="4">Daily</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="mt-3 mb-1 inputlabel">Task Description </label><br>
                                <textarea cols="30" rows="3" class="form-control mt-1 inputfield" id="task_desc" name="Description"
                                    placeholder="Enter Task Description" wire:model="Description"></textarea>
                                @error('Description')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel"> Task Checklist</label><br>
                                    <input type="text" class="form-control mt-1 inputfield checkList"
                                        id="task_checklist" name="TaskChecklist" placeholder="Enter Task Checklist"
                                        wire:model.defer="checkList">

                                    <div class="text-center">


                                        <button type="button" class="btn savebtn px-3 mt-2 text-center"
                                            wire:click="addData">Add</button>

                                    </div>
                                </div>

                                <div class="table-responsive col-xl-6 col-lg-6 col-12 mt-4">
                                    <table class="table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                        <thead class=" tablehead">
                                            <tr>
                                                <th class="text-center">Si No</th>
                                                <th class="text-center">Task Checklist</th>
                                                
                                                <th class="text-center">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($data as $item)
                                                    <td>{{ $item['serial'] }}</td>
                                                    <td>{{ $item['task'] }}</td>
                                                    {{-- <td><span wire:click="updateChecklist({{ $item['id'] }})">
                                                            <i class="ri-pencil-line" aria-hidden="true"></i></span>
                                                    </td> --}}
                                                    <td><span wire:click="deletchecklist({{ $item['id'] }})">
                                                            <i class="ri-delete-bin-6-line"></i></span></td>

                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>

                                </div>
                            </div>

                            <div class=" text-end mt-3">
                                <button type="submit" class="btn btn-success btn-lg refresh px-5 ">Save</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </form>

    <!-- Modal -->
    <div class="modal fade delModal" id="delModal" tabindex="-1" data-bs-backdrop="static"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalLabel">Delete Confirmation</h5>
                </div>
                <div class="modal-body">
                    <h4 class="text-center">Do you want to delete this Task ?</h4>
                    <div class="text-center mt-3">
                        <button type="button" id="confirmYes" class="btn btn-primary me-5"
                            wire:click="deleteTask">Yes</button>
                        <button type="button" id="confirmNo" class="btn btn-secondary ms-5"
                            data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    {{-- ------------------------------modal---------------------------------------------- --}}
   <!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancelDelete">Cancel</button>
                <button type="button" class="btn btn-danger" wire:click="deleteTask">Delete</button>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid px-4 ">
        <h4 class="mt-4 d-flex justify-content-center py-1 contitle">Task Template</h4>
    </div>
    <div class="wrapper">
        <!--CONTENTS-->
        <div class="container-fluid mainContents">
            <div class="card card-body main_card mt-2 shadow-lg p-3 mb-2">
                <div class="main_heading d-flex justify-content-between mb-2 shadow p-2 subheading">
                    <div>
                        <input type="text" class="form-control text-center" id="SearchBar" placeholder="Search">
                    </div>
                    <div class="">
                        <button type="button" class="btn savebtn px-3 mt-2 text-center" wire:click="resetForm"
                            data-bs-toggle="modal" data-bs-target="#exampleModal">Add</button>
                        {{-- <button class="me-3 exporticons"><i class="material-icons">file_upload</i></button> --}}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-hover MasterTable" id="MasterTable" style="width: 100%;">
                        <thead class=" tablehead">
                            <tr>
                                <th class="text-center">Si No</th>
                                <th class="text-center">Task Name</th>
                                <th class="text-center">Task Category</th>
                                <th class="text-center">Task Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>

                                    <td class="text-center">{{ $task->id }}</td>
                                    <td class="text-center">{{ $task->task_name }}</td>
                                    <td class="text-center">{{ $task->TaskCatName }}</td>

                                    <td class="text-center">{{ $task->task_description }}</td>
                                    <td class="text-center">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#openUpdateModal"
                                            wire:click="editTask({{ $task->id }})" class="btn ri-pencil-line"
                                            style="color: gray">

                                        </button>
                                        <button type="button" wire:click="alertConfirm({{ $task->id }})" class="btn ri-delete-bin-6-line"></button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <script>
                        document.addEventListener('livewire:load', function() {
                            Livewire.on('taskDeleted', () => {
                                // Task deleted successfully, show success alert or perform any other action
                                Swal.fire('Deleted!', 'The task has been deleted.', 'success');
                            });

                            Livewire.on('swal:confirm', eventData => {
                                Swal.fire({
                                    icon: 'warning',
                                    title: eventData.message,
                                    text: eventData.text,
                                    showCancelButton: true,
                                    confirmButtonText: 'Delete',
                                    cancelButtonText: 'Cancel',
                                    reverseButtons: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        Livewire.emit('deleteTask', eventData.taskId);
                                    }
                                });
                            });

                            Livewire.on('swal:task-in-use', eventData => {
                                Swal.fire({
                                    icon: 'warning',
                                    title: eventData.message,
                                    text: eventData.text,
                                    confirmButtonText: 'OK',
                                });
                            });
                        });
                    </script>
                    <div class="text-end">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>


    </div>


</div>
