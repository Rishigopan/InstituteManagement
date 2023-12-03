<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTask extends Model
{
    use HasFactory;
    protected $table = 'assigntask';
    protected $fillable = ['id', 'branch_id', 'staff_id', 'task_id', 'starttime', 'endtime', 'date', 'file', 'remarks', 'created_by', 'updated_by', 'created_at', 'updated_at'];
    public function checklistDetails()
    {
        return $this->hasMany(ChecklistDetails::class, 'assigntask_id');
    }
    public function observers()
    {
        return $this->hasMany(ObserverOrParticipate::class, 'assigntask_id')->where('type', 'observer');
    }

    public function participants()
    {
        return $this->hasMany(ObserverOrParticipate::class, 'assigntask_id')->where('type', 'participant');
    }

    public function observerStaff()
    {
        return $this->hasManyThrough(Staff::class, ObserverOrParticipate::class, 'assigntask_id', 'id', 'id', 'observer_id')->where('type', 'observer');
    }

    public function participantStaff()
    {
        return $this->hasManyThrough(Staff::class, ObserverOrParticipate::class, 'assigntask_id', 'id', 'id', 'participate_id')->where('type', 'participant');
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
