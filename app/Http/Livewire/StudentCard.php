<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use App\Models\Enquiry;
use App\Models\Course;
use App\Models\Admission;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;


use Livewire\Component;

class StudentCard extends Component
{
    use WithPagination; 

    public $students;
    public $student;
    public $course_id;
    public $course_provider_id;
    public $course_name;
    public $Course;
    public $studentid;
    public $name;
  
    public $selectedStudent = NULL;
    public $selectedCourse = NULL;
    public $courses = NULL;

    public function render()
    {
        $students = Enquiry::all();

        return view('livewire.student-card');
    }

    public function mount()
    {
        $this->students = Enquiry::all();
        $this->courses = collect();
    }


    public function updatedselectedStudent($student_id)
    {
        // if (!is_null($student)) {
            $this->courses = Course::where('id', $student_id)->get();
            // $this->students = Enquiry::all();

        // }
    }

 
}
