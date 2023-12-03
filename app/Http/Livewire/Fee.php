<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Enquiry;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class Fee extends Component
{
    use WithPagination;

    public $student_name;
    public $fee_type;
    public $amount;
    public $notes;
    
    public $students;
    public $student;
    public $course_id;
    public $course_provider_id;
    public $course_name;
    public $Course;
  
    public $selectedStudent = NULL;
    public $selectedCourse = NULL;
    public $courses = NULL;
  


    public function render()
    {
        $students = Enquiry::all();
        $this->invoices = Invoice::select('student_name', 'course_name','fee_type', 'amount', 'notes', 'fine', 'discount', 'tax', 'subtotal')->get();
        return view('livewire.fee',[
            'students' => Fee::all(),
        ]
    );
    }

      /**
     * List of add/edit form rules
     */
    public $rules = [
        'student_name' => 'required',
        'fee_type' => 'required',
        'amount' => 'required',

    ];

    // public function mount()
    // {
        
    //     $this->students = Enquiry::all();
    //     $this->courses = collect();
    // }

    public function updatedselectedStudent($student)
    {
        if (!is_null($student)) {
            $this->courses = Course::where('id', $student)->get();

        }
    }
 

}
