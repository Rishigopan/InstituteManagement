<?php

namespace App\Http\Livewire;

use App\Models\AssignTask as ModelsAssignTask;
use App\Models\Branch;
use App\Models\Group;
use App\Models\ObserverOrParticipate;
use App\Models\Staff;
use App\Models\Task as ModelsTask;
use App\Models\TaskChecklist;
use App\Models\TaskCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssignTask extends Component
{
    use WithFileUploads;
    public $branches;
    public $staffs;
    public $file;
    public $date;
    public $tasks;
    public $selectedBranch;
    public $SelectedassignTo;
    public $startTime;
    public $endTime;
    public $selectedTask;
    public $SelectedObserver = [];
    public $SelectedParticipants = [];
    public $selectedFile;
    public $Observer = [];
    public $Participants = [];
    public $selectedObserver = [];
    public $selectedParticipants = [];
    public $subtasks = [];
    public $addedTasks = [];
    public $taskCounter = 0;
    public $checklistItems = [];
    public $checklist_id;
    public $checklist_name;

    //add data(task)
    public $AddTasks = [];
    public $showChecklistModal;
    public $link;
    //task 
    public $taskName;
    public $Repetcycle;
    public $Description;
    public $isChecked = false;
    public $selectValue = '';
    public $checkList;
    public $selectedTaskCategory; //dropdown
    public $data = []; //TaskchecklistData
    public $counter = 1;
    public $taskcatagory = [];
    public $updateMode = false;
    public $showScheduleOffcanvas = false;
    public $pendingTasks;
    public $selectedStaffName;
     public $showModal=false;

    public function closeModals()
    {

        $this->updateMode = false;
    }

    public function scheduleTask()
    {
        if (empty($this->SelectedassignTo)) {
            $this->addError('SelectedassignTo', 'Please select a staff.');
            return;
        }
        $selectedStaffId = $this->SelectedassignTo;
        $pendingTasks = ModelsAssignTask::join('tasks', 'assigntask.task_id', '=', 'tasks.id')
            ->where('assigntask.staff_id', $selectedStaffId)
            ->where('assigntask.completed_status', 1)
            ->get(['assigntask.*', 'tasks.*']);

        $this->pendingTasks = $pendingTasks ?? [];

        $this->pendingTasks = $pendingTasks ?? [];
        $this->showScheduleOffcanvas = true; // Set the flag to show the offcanvas
    }





    public function toggleObserver($observerId, $memberId)
    {
        $selected = $observerId . ',' . $memberId;

        if (in_array($selected, $this->selectedObserver)) {
            $this->selectedObserver = array_diff($this->selectedObserver, [$selected]);
        } else {
            $this->selectedObserver[] = $selected;
        }
    }

    public function toggleParticipant($participantId, $memberId)
    {
        $selected = $participantId . ',' . $memberId;

        if (in_array($selected, $this->selectedParticipants)) {
            $this->selectedParticipants = array_diff($this->selectedParticipants, [$selected]);
        } else {
            $this->selectedParticipants[] = $selected;
        }
    }

    public $rules = [
        'selectedBranch' => 'required',
        'SelectedassignTo' => 'required',
        'date' => 'required',
        'SelectedObserver' => 'required',
        'SelectedParticipants' => 'required',
        'SelectedTask' => 'required',
    ];
    public function mount()
    {
        $this->branches = Branch::all();
        //$this->staffs = Staff::all();
        $this->tasks = ModelsTask::all();
        $this->selectedObserver = [];
        $this->selectedParticipants = [];
        $taskCategories = TaskCategory::all();
        $this->taskcatagory = $taskCategories->toArray();
        
        $this->staffs = [];

        // Fetch the staff for the selected branch
        $this->fetchStaffByBranch($this->selectedBranch);
    }
    public function fetchStaffByBranch($branchId)
    {
        $this->staffs = Staff::where('branch_id', $branchId)->get();
        
    }
   //Add Task
   public function addData()
   {
       if ($this->checkList !== '') {
           $taskExists = false;
           foreach ($this->data as $task) {
               if ($task['task'] === $this->checkList) {
                   $taskExists = true;
                   break;
               }
           }

           if (!$taskExists) {
               $task = [
                   'id' => $this->counter,
                   'serial' => $this->counter,
                   'task' => $this->checkList,
               ];

               $this->data[] = $task; // TaskchecklistData
               $this->counter++;
           }
       }

       $this->checkList = '';
   }



   //Save the Data
   public function saveData()
   {
       $existingTask = ModelsTask::where('task_name', $this->taskName)->first();

       if ($existingTask) {
           // Task with the same name already exists, show a message or perform any other action
           session()->flash('taskExists', 'The task already exists.');
           $this->closeModals();
           return;
       }
       DB::beginTransaction();

       try {
           // Create a new task
           $task = DB::table('tasks')->insertGetId([
               'task_name' => $this->taskName,
               'task_category_id' => $this->selectedTaskCategory,
               'repeat_cycle' => $this->Repetcycle,
               'task_description' => $this->Description,
               // Add other task fields here
           ]);

           foreach ($this->data as $item) {
               DB::table('task_checklists')->insert([
                   'task_id' => $task,
                   'checklist' => $item['task'],
               ]);
           }

           DB::commit();


           $this->resetForm();
           $this->emit('taskSaved');
            // Show Swal success modal and close the modal
            $this->dispatchBrowserEvent('swal:modal', [
               'type' => 'success',
               'title' => 'Success',
               'text' => 'Data saved successfully.',
               'timeout' => 3000,
           ]);
           $this->showModal = false;
           // Perform any additional logic or redirection after saving the data
       } catch (\Exception $e) {
           DB::rollback();

           // Handle the error or display a message to the user
       }
      
   }


    public function updatedSelectedBranch($branchId)
    {
        // Update the staff list when the selected branch changes
        $this->fetchStaffByBranch($branchId);
        $this->selectedStaffName = null;
    }

    public function addTasks()
    {
        $this->taskCounter++;

        $taskData = [
            'id' => 'task_' . $this->taskCounter,
            'branch' => $this->selectedBranch,
            'assignTo' => $this->SelectedassignTo,
            'date' => $this->date,
            'observers' => $this->selectedObserver,
            'participants' => $this->selectedParticipants,
            'task' => $this->selectedTask,
            'start_time' => date('h:i A', strtotime($this->startTime)),
            'end_time' => date('h:i A', strtotime($this->endTime)),
            'file' => $this->selectedFile ? $this->selectedFile->store('files') : null,
        ];

        $this->addedTasks[] = $taskData;

        // Reset the form fields
        // $this->selectedBranch = null;
        // $this->SelectedassignTo = null;
        // $this->date = null;
        $this->selectedObserver = [];
        $this->selectedParticipants = [];
        $this->selectedTask = null;
        $this->startTime = null;
        $this->endTime = null;
        $this->selectedFile = null;
        $this->file = null;
    }

    //Get task name in card
    public function getTaskName($taskId)
    {
        // Retrieve the task name from your data source based on the task ID
        $task = ModelsTask::find($taskId);
        return $task->task_name ?? '';
    }

    //Show checklist in modal 
    public function showChecklist($taskId)
    {
        // Fetch the checklist items based on the selected task ID
        $checklist = TaskChecklist::where('task_id', $taskId)->get();

        // If the checklist exists, set the modal checklist items
        if ($checklist) {
            $this->checklistItems = $checklist->pluck('checklist')->toArray();
        } else {
            $this->checklistItems = [];
        }

        $this->showChecklistModal = true;
    }

    //Save Data
    public function saveTasks()
    {

        foreach ($this->addedTasks as $taskData) {
            $filePath = $taskData['file'];

            $starttime = date('H:i:s', strtotime($taskData['start_time']));
            $endtime = date('H:i:s', strtotime($taskData['end_time']));

            DB::transaction(function () use ($taskData, $filePath, $starttime, $endtime) {
                $assignTaskId = DB::table('assigntask')->insertGetId([
                    'branch_id' => $taskData['branch'],
                    'staff_id' => $taskData['assignTo'],
                    'task_id' => $taskData['task'],
                    'starttime' => $starttime,
                    'endtime' => $endtime,
                    'date' => $taskData['date'],
                    'file' => $filePath,
                    'link' => $this->link,
                ]);

                // Clear the file after saving
                if ($filePath) {
                    Storage::delete($filePath);
                }

                foreach ($taskData['observers'] as $observer) {
                    list($observerId, $memberId) = explode(',', $observer);
                    DB::table('observerorparticipate')->insert([
                        'assigntask_id' => $assignTaskId,
                        'type' => 'observer',
                        'observer_id' => (int) $memberId,
                        'participate_id' => null,
                    ]);
                }

                foreach ($taskData['participants'] as $participant) {
                    list($participantId, $memberId) = explode(',', $participant);

                    DB::table('observerorparticipate')->insert([
                        'assigntask_id' => $assignTaskId,
                        'type' => 'participant',
                        'observer_id' => null,
                        'participate_id' => (int) $memberId,
                    ]);
                }

                $checklists = DB::table('task_checklists')
                    ->where('task_id', $taskData['task'])
                    ->get();

                //Save the ubtasks for each task
                foreach ($checklists as $checklist) {
                    DB::table('_checklist_details')->insert([
                        'assigntask_id' => $assignTaskId,
                        'task_id' => $taskData['task'],
                        'checklist_id' => $checklist->id,
                        'checklist_name' => $checklist->checklist,
                    ]);
                }
            });
        }

        // Clear the addedTasks array
        $this->addedTasks = [];

        // Reset the form fields
        $this->reset();
        return redirect()->to('/assigntask');
    }

    //Delete Card 
    public function deleteCard($taskId)
    {
        // Find the index of the task with ID
        $index = array_search($taskId, array_column($this->addedTasks, 'id'));
        if ($index !== false) {
            // Remove the task from  $addedTasks
            array_splice($this->addedTasks, $index, 1);
        }
    }

    //code for remove observer
    public function removeObserver($observerId, $memberId)
    {
        $key = array_search($observerId . ',' . $memberId, $this->selectedObserver);
        if ($key !== false) {
            unset($this->selectedObserver[$key]);
            $this->selectedObserver = array_values($this->selectedObserver);
        }
    }

    //code for remove participant
    public function removeParticipant($participantId, $memberId)
    {
        $key = array_search($participantId . ',' . $memberId, $this->selectedParticipants);
        if ($key !== false) {
            unset($this->selectedParticipants[$key]);
            $this->selectedParticipants = array_values($this->selectedParticipants);
        }
    }

    public function render()
    {
        //$observerGroups = Group::all();
        //$participantGroups = Group::all();
        // Get the selected branch ID
    $selectedBranchId = $this->selectedBranch;
    // Retrieve observers based on the selected branch
    $observerGroups = Group::where('branch_id', $selectedBranchId)->get();

    // Retrieve participants based on the selected branch
    $participantGroups = Group::where('branch_id', $selectedBranchId)->get();

    // Fetch the pending tasks
      
        // Fetch the pending tasks
        $selectedStaffId = $this->SelectedassignTo;
        $pendingTasks = ModelsAssignTask::join('tasks', 'assigntask.task_id', '=', 'tasks.id')
            ->where('assigntask.staff_id', $selectedStaffId)
            ->where('assigntask.completed_status', 1)
            ->get(['assigntask.*', 'tasks.*']);

        return view('livewire.assign-task', compact('observerGroups', 'participantGroups', 'pendingTasks'));
    }
}
