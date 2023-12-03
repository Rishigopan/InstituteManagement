<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;
    protected $table='course_types';
    protected $fillable = ['name','remarks','created_by','updated_by'];
}
?>
