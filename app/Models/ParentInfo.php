<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentInfo extends Model
{
    use HasFactory;
    protected $table = 'parent_infos';
    protected $fillable = ['father_name','mother_name','primary_mobile_no','secondary_mobile_no','primary_email',
    'secondary_email','permanent_address','permanent_mobile_no','permanent_lan_line_no','permanent_email','permanent_post_office',
    'permanent_lan_mark','communication_address','communication_mobile_no','communication_lan_line_no','communication_email',
    'communication_post_office','communication_lan_mark','father_occupation','mother_occupation','country','state','location',
    'user_name','password','created_by','updated_by'];


}
