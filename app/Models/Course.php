<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table='courses';
    protected $fillable=[
        'id', 
        'course_provider_id',
        'code', 
        'course_name', 
        'printable_name',
        'batch_course', 
        'department_id',
        'course_category_id',
        'course_type_id', 
        'zonal_discount'
    ];
}
