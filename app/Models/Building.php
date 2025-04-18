<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'name',
        'address',
        'security_phone',
        'visiting_hours_start',
        'visiting_hours_end',
    ];

}
