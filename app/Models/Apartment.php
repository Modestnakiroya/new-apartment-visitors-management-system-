<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'number',
        'floor',
    ];
    public function residents()
    {
        return $this->hasMany(Resident::class);
    }
}
