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
        'expected_departure_time',
        'departure_time',
        'is_pre_registered',
        'status',
        'pass_id',
        'notes',
    ];
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('visit_date', now()->toDateString());
    }
}

class Visitor extends Model
{
    protected $table = 'visitors';
    
    protected $fillable = [
        'name', 'phone', 'status', 'email', 'id_number'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}

class Resident extends Model
{
    protected $table = 'residents';
    
    protected $fillable = [
        'name', 'phone', 'email', 'apartment_id'
    ];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}

class Apartment extends Model
{
    protected $table = 'apartments';
    
    protected $fillable = [
        'apartment_number', 'floor', 'building'
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

}
