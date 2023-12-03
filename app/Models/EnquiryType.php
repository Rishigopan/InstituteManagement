<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryType extends Model
{
    use HasFactory;
    protected $table='enquiry_types';
    protected $primarykey='id';
    protected $fillable=['name','remarks','created_by','updated_by'];
}
?>
