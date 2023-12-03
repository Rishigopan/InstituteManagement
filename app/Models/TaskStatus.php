<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $table = 'taskstatus';
    protected $fillable = [
        'id', 'taskstatus', 'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}
