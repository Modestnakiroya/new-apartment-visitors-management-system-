<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isSecurity()
    {
        return $this->role === 'security' || $this->role === 'askari';
    }

    public function isResident()
    {
        return $this->role === 'resident';
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }

        return $this->role === $roles;
    }

    public function resident()
    {
        return $this->hasOne(Resident::class);
    }
    public function createdVisitors()
    {
        return $this->hasMany(Visitor::class, 'created_by');
    }
    public function isLandlord(): bool
    {
        return $this->role === 'landlord';
    }
}
