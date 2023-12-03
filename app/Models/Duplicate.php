<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duplicate extends Model
{
    use HasFactory;
    protected $table='duplicatedatatable';
    protected $fillable=['name','gender','dob','parent_info_id','religion_id',
    'caste_id','education','streem','branch_id','colg_schl','photo','country','state',
    'location','address','pincode','mob_no','email','enq_date','enq_taken_by',
    'course_id','discount','enq_source','enq_stage','remarks','next_folow_up','created_by','updated_by'];

}
