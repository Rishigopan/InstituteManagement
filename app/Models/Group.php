<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['id','name','members','branch_id','created_by','updated_by'];
    public function members()
    {
        return $this->belongsToMany(Staff::class, 'groupmembers', 'group_id', 'staff_id');
    }
}
 