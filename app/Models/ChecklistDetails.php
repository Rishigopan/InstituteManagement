<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistDetails extends Model
{
    use HasFactory;
    protected $table='_checklist_details';
    protected $fillable=[
        'id', 
        'assigntask_id',
        'task_id', 
        'checklist_id', 
        'checklist_name',
        'starttime', 
        'endtime',
        'total_time',
        'completed_status', 
        'created_at',
        'updated_at'

    ];
    public function assignTask()
    {
        return $this->belongsTo(AssignTask::class, 'task_id');
    }
    
}
