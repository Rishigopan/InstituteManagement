<?php

namespace App\Http\Livewire;

use App\Models\AssignTask;
use App\Models\Task as ModelsTask;
use App\Models\TaskCategory;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TaskChecklist;
use Illuminate\Support\Facades\DB;



class Task extends Component
{


    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $taskName;
    public $Repetcycle;
    public $Description;
    public $isChecked = false;
    public $selectValue = '';
    public $checkList;
    public $data = []; //TaskchecklistData
    public $counter = 1;
    public $taskcatagory = [];
    public $selectedTaskCategory; //dropdown
    public $exampleModal = false;

    public $selectedTaskId;
    // public $showModal = true;
    public $updateMode = false;
    public $confirmingDelete = false;
    public $taskIdToDelete;
    public $showModal = false;


    protected $listeners = [
        'showUpdateModal' => 'openUpdateModal',
    ];

 
    //Edit Task
    public function editTask($taskId)
    {
        $this->selectedTaskId = $taskId;
        $this->exampleModal = true;

        // Retrieve the task data from the database based on the task ID
        $task = ModelsTask::findOrFail($taskId);

        // Set the form fields with the retrieved task data
        $this->taskName = $task->task_name;
        $this->selectedTaskCategory = $task->task_category_id;
        $this->Repetcycle = $task->repeat_cycle;
        $this->Description = $task->task_description;

        // Retrieve the associated checklists for the task
        $checklists = TaskChecklist::where('task_id', $taskId)->get();

        // Populate the $data array with the retrieved checklists
        $this->data = $checklists->map(function ($checklist) {
            return [
                'id' => $checklist->id,
                'serial' => $checklist->id, // or any other value you want to assign as the serial
                'task' => $checklist->checklist,
            ];
        })->toArray();
        $this->updateMode = true;
    }
    public function handleEnterKey()
    {
        $this->isChecked = true;
    }


    public function closeModals()
    {

        $this->updateMode = false;
    }
   
    //delete
   

  
  
    public $rules = [
        'taskName' => 'required',
        'Description' => 'required',
        'taskcatagory' => 'required',
    ];

    public function mount()
    {
        $taskCategories = TaskCategory::all();
        $this->taskcatagory = $taskCategories->toArray();
    }


    public function updatedIsChecked()
    {
        if ($this->isChecked) {
            $this->selectValue = '';
        }
    }
    public function resetModal()
    {
        $this->taskName = '';
        $this->Repetcycle = '';
        $this->Description = '';
        $this->selectedTaskCategory = null;
        $this->data = [];
        $this->exampleModal = false;
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
    public function updateData()
    {
        $this->validate();

        DB::beginTransaction();

        try {
            $task = ModelsTask::findOrFail($this->selectedTaskId);

            ModelsTask::where('id', $this->selectedTaskId)->update([
                'task_name' => $this->taskName,
                'task_category_id' => $this->selectedTaskCategory,
                'repeat_cycle' => $this->Repetcycle,
                'task_description' => $this->Description,
            ]);

            TaskChecklist::where('task_id', $this->selectedTaskId)->delete();

            foreach ($this->data as $item) {
                TaskChecklist::create([
                    'task_id' => $this->selectedTaskId,
                    'checklist' => $item['task'],
                ]);
            }

            DB::commit();

            $this->resetForm();
            $this->emit('taskUpdated'); // Emit an event to notify the component that the task is updated
        } catch (\Exception $e) {
            DB::rollback();

            // Handle the error or display a message to the user
        }

        $this->closeModals();
    }
    public function alertConfirm($taskId)
{

    $this->emit('confirmDelete', $taskId);
}
public function deleteConfirmed($taskId)
{
    // Find the task and its associated checklists
    $task = ModelsTask::findOrFail($taskId);
    $checklists = TaskChecklist::where('task_id', $taskId)->get();

    // Delete the checklists
    foreach ($checklists as $checklist) {
        $checklist->delete();
    }

    // Delete the task
    $task->delete();

    // Show Swal success modal and close the modal
    $this->dispatchBrowserEvent('swal:modal', [
        'type' => 'success',
        'title' => 'Success',
        'text' => 'Data deleted successfully.',
        'timer' => 3000,
    ]);

    // Emit an event to notify the JavaScript code of the success
    $this->emit('deleteSuccess');
}

public function delete($taskId)
{
    $this->emit('confirmDelete', $taskId);
}

    public function resetForm() //rest the form after save and update
    {
        $this->taskName = '';
        $this->Repetcycle = '';
        $this->Description = '';
        $this->selectedTaskCategory = null;
        $this->isChecked = false;
        $this->checkList = '';
        $this->data = [];
        $this->counter = 1;
    }

    public function deletchecklist($checklistId)
    {
        $checklist = TaskChecklist::findOrFail($checklistId);
        $checklist->delete();
        $this->emit('checklistDeleted');
    }


    public function render()
    {
        if ($this->updateMode) {
            $this->exampleModal = true;
        }

        $tasks = DB::table('tasks')
            ->select('tasks.id', 'tasks.task_name', 'task_categories.name AS TaskCatName', 'tasks.task_description')
            ->leftJoin('task_categories', 'tasks.task_category_id', '=', 'task_categories.id')

            ->orderBy('id')->paginate(10);

        if ($this->updateMode) {
            $this->exampleModal = true;
        }
        return view('livewire.task', [
            'tasks' => $tasks,
        ]);
    }
}
