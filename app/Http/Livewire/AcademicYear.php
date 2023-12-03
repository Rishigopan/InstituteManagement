<?php

namespace App\Http\Livewire;

use App\Models\Year;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

use Livewire\Component;


class AcademicYear extends Component
{

    use WithPagination;

    
    protected $paginationTheme = 'bootstrap';

    public $year;
    public $remark;

    protected $listeners = ['delete'];
    
    public function render()
    {
        $this->years = Year::select('id', 'year', 'remark')->get();
        return view('livewire.academic-year');
    }

    
      /**
     * List of add/edit form rules
     */
    public $rules = [
        'year' => 'required',
        'remark' => 'required',

    ];

     //close modal

public function closeModals()
{
    $this->updateMode = false;
}

 //save data

 public function saveData()
 {
     $year = new Year;
     $year->year=$this->year;
     $year->remark=$this->remark;
     $year->save();
 
     return redirect('Academic_year');
 }

 public function alertSuccess()
 {
     $this->dispatchBrowserEvent('swal:modal', [
             'type' => 'success',  
             'message' => 'Year Added Successfully!', 
             'text' => 'It will list on users table soon.'
         ]);
 }

 //edit year

 public function edityear($id){
    try {
        $year = Year::findOrFail($id);
        if( !$year) {
            session()->flash('error','Post not found');
        } else {
            $this->year = $year->year;
            $this->remark = $year->remark;
            $this->yearId = $year->id;
            $this->updateYear = true;
            $this->addYear = false;
        }
    } catch (\Exception $ex) {
        session()->flash('error','Something goes wrong!!');
    }
    
}

//update year

public function updateData()
 {

     $validatedData = $this->validate([
         'year' => 'required|',
         'remark' => 'required',
     ]);

     $year = Year::find($this->yearId);
     $year->update([
         'year' => $this->year,
         'remark' => $this->remark,
     ]);

     
     $this->updateMode = false;

     session()->flash('message', 'Year Updated Successfully.');

     $this->resetFields();
     
 }



// * Reseting all input fields
// * @return void
// */


public function resetFields(){
    $this->year = '';
    $this->remark = '';
 }

 //delete fee type
 
// public function alertConfirm($id)
// {
//     $this->dispatchBrowserEvent('swal:confirm', [
//             'type' => 'warning',  
//             'message' => 'Are you sure?', 
//             'text' => 'If deleted, you will not be able to recover this imaginary file!',
//             'id' => $id,
//         ]);
// }





//delete academic year
 
public function alertConfirm($id)
{

    $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',  
            'message' => 'Are you sure?', 
            'text' => 'If deleted, you will not be able to recover this imaginary file!',
            'id' => $id,
        ]);
}



    

public function delete($id)
{
    /* Write Delete Logic */
    
    Year::where('id', $id)->delete();

    $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Fee Type Deleted Successfully!', 
            'text' => ''
        
        ]);
}

}
