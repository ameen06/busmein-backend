<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function boarding()
    {
        return $this->belongsTo(Destination::class, 'boarding_point');
    }
    public function dropping()
    {
        return $this->belongsTo(Destination::class, 'dropping_point');
    }
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
}
