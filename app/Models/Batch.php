<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;
    protected $table = 'batches';
    protected $fillable = ['id', 'branch_id', 'academic_year', 'course_provider_id', 'course_name', 'batch_name', 'batch_no', 'batch_type_id', 'seat', 'duration', 'period', 'session','startdate', 'created_by', 'updated_by', 'created_at', 'updated_at' ];

}
