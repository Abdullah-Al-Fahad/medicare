<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weight',
        'oxygen',
        'sugar',
        'sleep',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
