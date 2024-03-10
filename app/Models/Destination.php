<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'address',
        'landmark',
        'image',
        'has_return',
        'type'
    ];
    
    protected $casts = [
        'has_return' => 'boolean'
    ];
}
