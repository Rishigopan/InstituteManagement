<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    use HasFactory;
    protected $table='followup';
    protected $fillable =['id','enquiry_id', 'feedback_id', 'remarks', 'followup','staff_id', 'created_at', 'updated_at'];
    public function Feedback()
    {
        return $this->belongsTo(Feedback::class, 'feedback_id');
    }
   
}
