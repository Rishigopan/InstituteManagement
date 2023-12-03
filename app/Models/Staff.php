<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table='staff';
    protected $fillable=['id','name','email','password','confirm_password','mobile_no','remarks','department_id','branch_id','created_by','updated_by'];
}
