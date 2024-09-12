<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    // Define the relationships with Doctor and Patient models
    public function doctor()
    {
        return $this->hasOne(doctor::class, 'id');
   
    }

    public function patient()
    {
        return $this->hasOne(Patient::class, 'id');
    }


    public function isPatient()
    {
        return $this->role === 'patient';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function currentRoom(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'current_room_id');
    }
}
