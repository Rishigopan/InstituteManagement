<div>
    @php
        use App\Models\Staff;
        
    @endphp

    {{-- //Assign Task --}}
    <!-- task Checklist Modal -->
    <div class="modal fade addUpdateModal" wire:ignore.self id="checklist" tabindex="-1" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content cntrymodalbg">
                <div class="modal-header modelhead py-2">
                    <h6 class="modal-title" id="exampleModalLabel">Task Checklist</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul>
                        @foreach ($checklistItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    {{-- Add Task modal --}}
    <div wire:ignore.self class="modal showModal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true">
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
                                        check the taskrepetitive
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
                                    <table class="table-hover MasterTable" id="MasterTable" style="width: 100%;">
                                        <thead class=" tablehead">
                                            <tr>
                                                <th class="text-center">Si No</th>
                                                <th class="text-center">Task Checklist</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($data as $item)
                                                    <td>{{ $item['serial'] }}</td>
                                                    <td>{{ $item['task'] }}</td>


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
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="wrapper">
        <!--CONTENTS-->
        <div class="container-fluid mainContents">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-12">
                    <div class="card card-body main_card mt-2  p-3 mb-2">
                        <form wire:submit.prevent="saveTasks" class="AssignTask AddForm" id="assign_task">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xl-7 col-lg-7 col-md-7 col-12">
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="mt-2 mb-1 inputlabel">Branch</label><br>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-select inputfield"
                                                aria-label="Default select example name" id="branch"
                                                name="branch_id" wire:model="selectedBranch">
                                                <option class="inputlabel" hidden value="0">Select Branch
                                                </option>
                                                @foreach ($branches ?? [] as $branch)
                                                    <option value="{{ $branch['id'] }}">{{ $branch['branch_name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="mt-2 mb-1 inputlabel">Assign To</label><br>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-10">
                                                    <select class="form-select inputfield "
                                                        aria-label="Default select example name" id="Assignto"
                                                        name="assignTo" wire:model="SelectedassignTo">
                                                        <option class="inputlabel" hidden value="0">Assign To
                                                        </option>
                                                        @foreach ($staffs ?? [] as $Staff)
                                                            <option value="{{ $Staff['id'] }}">{{ $Staff['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    
                                                        <button class="btn savebtn  btn-primary" type="button"
                                                            data-bs-toggle="offcanvas"
                                                            data-bs-target="#offcanvasExample"
                                                            aria-controls="offcanvasExample" wire:click="scheduleTask"
                                                            wire:loading.attr="disabled"><i
                                                                class="bi bi-alarm-fill"></i></button>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="mt-2 mb-1 inputlabel">Date</label><br>
                                        </div>
                                        <div class="col-6">
                                            <input type="date" class="form-control mt-1 inputfield"
                                                wire:model="date" id="date" name="date" autofocus>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="mt-2 mb-1 inputlabel">Webpage/SheetLink</label><br>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control mt-1 inputfield" id="link"
                                                name="link" autofocus wire:model="link">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="mt-2 mb-1 inputlabel">Observers</label><br>
                                        </div>
                                        <div class="col-6">

                                            @if (!$selectedBranch)

                                                <p style="color:red">Please select the Branch</p>
                                            @else
                                                @foreach ($observerGroups as $observer)
                                                    @php
                                                        $memberIds = explode(',', $observer->members);
                                                        $members = Staff::whereIn('id', $memberIds)->get();
                                                    @endphp
                                                    <div>
                                                        <label class="inputlabel">{{ $observer->name }}</label>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        @foreach ($members as $member)
                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="observer_{{ $observer->id }}_{{ $member->id }}"
                                                                    value="{{ $observer->id }}"
                                                                    wire:click="toggleObserver('{{ $observer->id }}', '{{ $member->id }}')"
                                                                    @if (in_array($observer->id . ',' . $member->id, $selectedObserver)) checked @endif>
                                                                <label class="form-check-label"
                                                                    for="observer_{{ $observer->id }}_{{ $member->id }}">
                                                                    {{ $member->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <label class="mt-2 mb-1 inputlabel">Participants</label><br>
                                        </div>
                                        <div class="col-6">
                                            @if (!$selectedBranch)

                                                <p style="color:red">Please select the Branch</p>
                                            @else
                                                @foreach ($participantGroups as $participate)
                                                    @php
                                                        $memberIds = explode(',', $participate->members);
                                                        $members = Staff::whereIn('id', $memberIds)->get();
                                                    @endphp
                                                    <div>
                                                        <label class="inputlabel">{{ $participate->name }}</label>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        @foreach ($members as $member)
                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="participant_{{ $participate->id }}_{{ $member->id }}"
                                                                    value="{{ $participate->id }}"
                                                                    wire:click="toggleParticipant('{{ $participate->id }}', '{{ $member->id }}')"
                                                                    @if (in_array($participate->id . ',' . $member->id, $selectedParticipants)) checked @endif>
                                                                <label class="form-check-label"
                                                                    for="participant_{{ $participate->id }}_{{ $member->id }}">
                                                                    {{ $member->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-5 d-md-flex d-none justify-content-center">
                                    <img class="mt-4" src="{{ url('assets/images/assigntaskavathar.png') }}"
                                        style="width:200px; height:150px;">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-12 ">
                                    <label class="mt-2 mb-1 inputlabel">Task</label> <i
                                        class="bi bi-clipboard-plus-fill ml-auto" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"></i><br>
                                    <select class="form-select inputfield " aria-label="Default select example name"
                                        id="task" name="task" wire:model="selectedTask">
                                        <option class="inputlabel" hidden value="0"> Select Task</option>
                                        @foreach ($tasks ?? [] as $task)
                                            <option value="{{ $task['id'] }}">{{ $task['task_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-xl-2 col-lg-2 col-md-3 col-6">
                                    <label class="mt-2 mb-1 inputlabel">Starting Time</label><br>
                                    <input type="time" class="form-control mt-1 inputfield" id="start_time"
                                        name="startTime" autofocus wire:model="startTime">
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-3 col-6">
                                    <label class="mt-2 mb-1 inputlabel">Ending Time</label><br>
                                    <input type="time" class="form-control mt-1 inputfield" id="end_time"
                                        name="endTime" autofocus wire:model="endTime">
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                    <label class="mt-2 mb-1 inputlabel">Upload File</label><br>
                                    <input type="file" class="form-control mt-1 inputfield"
                                        wire:model="selectedFile" id="file" name="file"autofocus>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 text-center mt-2">
                                    <!-- <button type="submit" class="btn savebtn mt-4" wire:click.prevent="addTasks">Add Task</button> -->
                                    <button type="submit" class="btn savebtn mt-4" wire:click.prevent="addTasks"
                                        wire:loading.attr="disabled" wire:target="addTasks"
                                        @if (!$this->selectedTask) disabled @endif>
                                        Add Task
                                    </button>
                                </div>

                            </div>
                    </div>

                    <div class="card card-body main_card mt-2  p-3 mb-2">
                        <div class="row">
                            @if (!empty($addedTasks))
                                @foreach ($addedTasks as $taskData)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 p-1">
                                        <div class="taskcard" id="{{ $taskData['id'] }}">
                                            <div class="p-2">
                                                <h6 class=""><b>{{ $this->getTaskName($taskData['task']) }}</b>
                                                </h6>
                                            </div>
                                            <p class="ms-2 tasktime mb-1">
                                                {{ date('h:i A', strtotime($taskData['start_time'])) }} To
                                                {{ date('h:i A', strtotime($taskData['end_time'])) }}</p>
                                            <hr class="my-0">
                                            </hr>
                                            <div class="p-2 d-flex justify-content-between">
                                                <i class="ri-eye-line ms-2"
                                                    wire:click="showChecklist('{{ $taskData['task'] }}')"
                                                    data-bs-toggle="modal" data-bs-target="#checklist"></i>
                                                <i class="ri-delete-bin-6-line me-2"
                                                    wire:click="deleteCard('{{ $taskData['id'] }}')"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <p>No tasks added yet.</p>
                                </div>
                            @endif

                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn savebtn px-5 py-2 mt-4 fs-5"><b>Save</b></button>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-12">
                    <div class="card card-body main_card mt-2  p-3 mb-2">
                        <section>
                            <h5 class="text-center">Observers</h5>
                            <hr>
                            </hr>
                            <ul class="list-unstyled">
                                @foreach ($selectedObserver as $selected)
                                    @php
                                        [$observerId, $memberId] = explode(',', $selected);
                                        $observer = $observerGroups->firstWhere('id', $observerId);
                                        $member = $members->firstWhere('id', $memberId);
                                    @endphp

                                    <li>
                                        <div class="d-flex justify-content-between taskbg mt-2">
                                            <div>
                                                <img class="me-2" src="{{ url('assets/images/two.png') }}"
                                                    style="width:30px; height:25px;">{{ $member->name }}
                                            </div>
                                            <div>
                                                <i class="ri-close-line me-2"
                                                    wire:click="removeObserver('{{ $observerId }}', '{{ $memberId }}')">
                                                </i>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                        <section>
                            <h5 class="text-center">Participants</h5>
                            <hr>
                            <hr>
                            <ul class="list-unstyled">
                                @foreach ($selectedParticipants as $selected)
                                    @php
                                        [$participantId, $memberId] = explode(',', $selected);
                                        $participant = $participantGroups->firstWhere('id', $participantId);
                                        $member = $members->firstWhere('id', $memberId);
                                    @endphp

                                    <li>
                                        <div class="d-flex justify-content-between taskbg mt-2">
                                            <div>
                                                <img class="me-2" src="{{ url('assets/images/two.png') }}"
                                                    style="width:30px; height:25px;">{{ $member->name }}
                                            </div>
                                            <div>
                                                <i class="ri-close-line me-2"
                                                    wire:click="removeParticipant('{{ $participantId }}', '{{ $memberId }}')">
                                                </i>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </section>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel" wire:ignore.self>
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"> Pending Works </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @if ($errors->has('SelectedassignTo'))
                <div class="alert alert-danger">{{ $errors->first('SelectedassignTo') }}</div>
            @elseif ($pendingTasks && count($pendingTasks) > 0)
                <div class="table-responsive">
                    <table class="table  table-hover MasterTable" id="MasterTable" style="width: 100%;">
                        <thead class=" tablehead">
                            <tr>

                                <th class="text-center">Task Name</th>
                                <th class="text-center">Assigned Date</th>
                                <th class="text-center">Assigned StartTime</th>
                                <th class="text-center">Assigned EndTime</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingTasks as $task)
                                <tr>
                                    <td style="color: red"> {{ $task->task_name }}</td>
                                    <td style="color: red"> {{ $task->date }}</td>
                                    <td style="color: red"> {{ $task->starttime }}</td>
                                    <td style="color: red"> {{ $task->endtime }}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            @else
                <p>No pending tasks found for the selected staff.</p>
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script>
        Livewire.on('showPendingTasks', function(pendingTasks) {
            // Display the off-canvas here and populate it with the pendingTasks data
            // Example code to show the pending tasks in a list
            let offCanvas = document.getElementById('off-canvas');
            let list = document.createElement('ul');

            pendingTasks.forEach(task => {
                let listItem = document.createElement('li');
                listItem.textContent = task.task_name;
                list.appendChild(listItem);
            });

            offCanvas.innerHTML = '';
            offCanvas.appendChild(list);
            // Show the off-canvas
            // ...
        });
    </script>
@endpush
