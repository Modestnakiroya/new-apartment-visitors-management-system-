<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_name',
        'apartment_number',
        'floor',
        'number_of_rooms',
        'status',
        'description'
    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }

    public function getFullNumberAttribute()
    {
        return "Floor {$this->floor} - {$this->number}";
    }
}
