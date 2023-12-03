<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feetyp extends Model
{
    use HasFactory;

    protected $table = 'feetypes';
    protected $fillable = [
        'id',
        'fee_type_name',
        'remark',
        'isActive',
    ];
}
