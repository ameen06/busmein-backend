<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_name',
        'subtext',
        'rating',
        'badge',
        'total_seats',
        'seats_left',
        'seats_right',
    ];
}
