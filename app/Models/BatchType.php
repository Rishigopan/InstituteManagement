<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BatchType extends Model
{
    use HasFactory;
    protected $table = 'batch_types';
    protected $fillable = ['name','remarks','created_by','updated_by'];
}
