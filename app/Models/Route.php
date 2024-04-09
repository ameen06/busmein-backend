<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'starting_point',
        'ending_point',
        'total_time',
        'total_distance',
    ];

    public function starting_point()
    {
        return $this->belongsTo(Destination::class, 'starting_point', 'id');
    }

    public function ending_point()
    {
        return $this->belongsTo(Destination::class, 'ending_point', 'id');
    }

    public function stops(){
        return $this->hasMany(RouteStop::class);
    }
}
