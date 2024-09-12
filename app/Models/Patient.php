<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'patient';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'location',
        'dob',
        'sex',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
    
    public function user()
    {
        return $this->hasOne(Patient::class, 'user_id', 'id');
    }
    
}
