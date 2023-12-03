<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseReq extends Model
{
    use HasFactory;
    protected $table='course_requirmenttable';
    protected $fillable=['id','requirment_id','Requirement','course_id'];
}
