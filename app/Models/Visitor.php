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
        'reason',
        'resident_id',
        'entry_time',
        'expected_exit_time',
        'visit_type',
        'created_by',
        'actual_exit_time'
    ];

    protected $dates = [
        'entry_time',
        'expected_exit_time',
        'actual_exit_time',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'entry_time' => 'datetime',
        'expected_exit_time' => 'datetime',
        'actual_exit_time' => 'datetime',
    ];

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isActive()
    {
        return is_null($this->actual_exit_time);
    }
    public function scopeActive($query)
    {
        return $query->whereNull('actual_exit_time');
    }
}
