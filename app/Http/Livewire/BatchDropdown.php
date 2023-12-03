<?php

namespace App\Http\Livewire;

use App\Models\BatchType;
use App\Models\Branch;
use Livewire\Component;
use App\Models\CourseProvider;
use App\Models\Course;

class BatchDropdown extends Component
{
    public $selectedCourseProvider;
    public $selectedCourse;
    public $Course;
    public $CourseName;

    public function mount()
    {
        $this->Course = CourseProvider::all();
        $this->CourseName =  Course::where('course_provider_id', $this->Course->first()->id)->get();
        
    }

    public function getCourse($value)
    {
        if($value) {
            $this->Course = $value;
           
        $this->CourseName  = Course::where('course_provider_id',  $this->Course)->get();
        }
       
        
    }
    public function render()
    {
        return view('livewire.batch-dropdown');
    }

}

  