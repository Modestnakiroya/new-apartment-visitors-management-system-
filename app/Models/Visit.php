<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visitor_id',
        'resident_id',
        'purpose',
        'check_in_time',
        'purpose_details',
        'visit_date',
        'expected_arrival_time',
        'actual_arrival_time',
        'departure_time',
        'is_pre_registered',
        'status',
        'pass_id',
        'notes',
    ];
}
