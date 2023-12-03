<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'id', 'task_name', 'task_category_id', 'repeat_cycle',
        'task_description', 'repeat_status', 'created_by', 'updated_by'
    ];

    public function checklists()
    {
        return $this->hasMany(TaskChecklist::class, 'task_id');
    }
}
