<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = ['visitor_id', 'status'];

    // Relationship with visitor
    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}