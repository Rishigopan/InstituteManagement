<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObserverOrParticipate extends Model
{
    use HasFactory;
    protected $table = 'observerorparticipate';
    protected $fillable = ['id', 'assigntask_id', 'type', 'observer_id', 'participate_id', 'created_at', 'updated_at'];
}
