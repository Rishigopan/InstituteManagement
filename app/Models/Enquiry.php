<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory; 
    protected $table='enquiries';
    protected $fillable=['name','gender','dob','parent_info_id','religion_id',
    'caste_id','education','streem','branch_id','colg_schl','photo','country','state',
    'location','address','pincode','mob_no','email','enq_date','enq_taken_by','Assignedto',
    'course_id','discount','enq_source','enq_stage','leaddata','remarks','next_folow_up','feedback','created_by','updated_by'];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'Assignedto');
    }
    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback');
    }
}
