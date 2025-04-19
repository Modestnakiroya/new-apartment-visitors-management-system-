<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'id_number',
        'purpose',
        'resident_id',
        'visit_date',
        'visit_time',
        'status',
        'pre_registered',
        'pass_id',
    ];

    // Define the 'active' scope
    public function scopeActive($query)
    {
        return $query->whereNull('exit_time'); // Assumes active visitors have no exit_time
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }
}
