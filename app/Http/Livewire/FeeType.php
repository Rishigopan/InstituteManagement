<?php

namespace App\Http\Livewire;

use App\Models\Feetyp;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class FeeType extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $fee_type_name;
    public $remark;
    public $feetype;
    public $selectedStatus;

    protected $listeners = ['delete'];

    public string $designTemplate ='bootstrap';

    public function render()
    {
        $this->feetype = Feetyp::select('id', 'fee_type_name', 'remark')->get();
        $this->designTemplate;
        return view('livewire.fee-type');
    }

      /**
     * List of add/edit form rules
     */
    public $rules = [
        'fee_type_name' => 'required|alpha',
        'remark' => 'required',
        // 'selectedStatus' => 'required',

    ];

    // * Reseting all input fields
// * @return void
// */


public function resetFields(){
    $this->fee_type_name = '';
    $this->remark = '';
 }
 
     //close modal

public function closeModals()
{
    $this->updateMode = false;
}


     //save data

     public function saveData()
     {
        
        $this->validate();

         $fee_typ = new Feetyp;
         $fee_typ->fee_type_name=$this->fee_type_name;
         $fee_typ->remark=$this->remark;
         $fee_typ->save();
     }

     public function alertSuccess()
{
    $this->validate();

    $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Fee Type Added Successfully!', 
            'text' => ''
        ]);
}



//edit fee type

     public function editfeetype($id)
     {

        $fee_typ = Feetyp::findOrFail($id);
        
                $this->fee_type_name = $fee_typ->fee_type_name;
                $this->remark = $fee_typ->remark;
                $this->fee_typId = $fee_typ->id;
                $this->updateFeetyp = true;
                $this->addFeetyp = false;
      
    }

 //update fee type

 public function updateData()
 {

     $validatedData = $this->validate([
         'fee_type_name' => 'required|alpha',
         'remark' => 'required',
     ]);

     $fee_typ = Feetyp::find($this->fee_typId);
     $fee_typ->update([
         'fee_type_name' => $this->fee_type_name,
         'remark' => $this->remark,
     ]);

     
     $this->updateMode = false;

     session()->flash('message', 'Post Updated Successfully.');

     $this->resetFields();
     
 }



 //view fee type

 public function viewfeetype($id)
 {

    $fee_typ = Feetyp::findOrFail($id);

    $this->fee_type_name = $fee_typ->fee_type_name;
    $this->remark = $fee_typ->remark;

    
    
 }




//delete fee type
 
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
        
        Feetyp::where('id', $id)->delete();

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Fee Type Deleted Successfully!', 
                'text' => ''
            
            ]);
    }
 
   
   
}
