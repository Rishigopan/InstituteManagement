<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $table='admissions';

    protected $fillable=[
                        'student_id',
                        'academic_year',
                        'admission_no',
                        'course_id',
                        'batch_id',
                        'join_date',
                        'complete_date',
                        'id_no',
                        'reg_no','
                        roll_no','
                        email',
                        'fee_plan',
                        'special_discount',
                        'created_by',
                        'updated_by',
                        'created_at',
                        'updated_at'
                    ];
}
