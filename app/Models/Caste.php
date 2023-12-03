<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caste extends Model
{
    use HasFactory;
    protected $table = 'castes';
    protected $fillable = ['name','religion_id','caste_category_id','remarks','created_by','updated_by'];
}
