<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;
    protected $table='_stream';
    protected $fillable=['id','qualification_id','stream','created_by','updated_by'];
}
