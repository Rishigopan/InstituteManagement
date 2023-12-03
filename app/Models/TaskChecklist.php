<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskChecklist extends Model
{
    use HasFactory;
    protected $table = 'task_checklists';
    protected $fillable = ['id', 'task_id', 'checklist', 'created_by', 'updated_by'];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
