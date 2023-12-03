<?php

namespace App\Http\Livewire;

use App\Models\Fee;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;


class FeeCategory extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $category_name;
    public $remark;
    public $fee;
    public $selectedStatus;
    public bool $isActive;
    public Model $model;
    public $fee_id;

    public string $designTemplate ='bootstrap';

    protected $listeners = ['delete'];
    

   

    
public function render()
{
   
    $this->fee = Fee::select('id', 'category_name', 'remark','isActive', 'isDefault')->get();
    $this->designTemplate;
    return view('livewire.fee-category');
}
    /**
     * List of add/edit form rules
     */
    public $rules = [
        'category_name' => 'required|alpha',
        'remark' => 'required',

    ];

    // * Reseting all input fields
// * @return void
// */


public function resetFields(){
    $this->category_name = '';
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

    $fee_cat = new Fee;
    $fee_cat->category_name=$this->category_name;
    $fee_cat->remark=$this->remark;
    $fee_cat->save();

    $this->resetFields();

}

public function alertSuccess()
{
    $this->validate();

    $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Fee Category Added Successfully!', 
            'text' => ''
        ]);
}


//edit fee category

public function editFeecategory($id){

    
        $fee_cat = Fee::findOrFail($id);
       
            $this->category_name = $fee_cat->category_name;
            $this->remark = $fee_cat->remark;
            $this->fee_catId = $fee_cat->id;
            $this->updateFee = true;
            $this->addFee = false;
   

}


   //update fee category

   public function updateCategory()
   {

       $validatedData = $this->validate([
           'category_name' => 'required|alpha',
           'remark' => 'required',
       ]);
 
       $fee = Fee::find($this->fee_catId);
       $fee->update([
           'category_name' => $this->category_name,
           'remark' => $this->remark,
       ]);
 
       
       $this->updateMode = false;
 
       session()->flash('message', 'Post Updated Successfully.');

       $this->resetFields();
   }
  


  //view fee category

  public function viewFeecategory($id)
  {
 
     $fee_cat = Fee::findOrFail($id);
 
     $this->category_name = $fee_cat->category_name;
     $this->remark = $fee_cat->remark;
 
    
  }
 
     
  //delete fee category

public function alertConfirm($id)
{

        $this->dispatchBrowserEvent(
            'swal:confirm', [
                         'type' => 'warning',  
                         'message' => 'Are you sure?', 
                        'text' => 'If deleted, you will not be able to recover this imaginary file!',
                        'id' => $id,
                    ]);
  
   
}


public function delete($id)
{

    /* Write Delete Logic */

    Fee::where('id', $id)->delete();

    $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'Fee Category Deleted Successfully!', 
            'text' => ''
        ]);

    }

   
}