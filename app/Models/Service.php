<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'bus_id',
        'route_id',
        'start_time',
        'day',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function prices()
    {
        return $this->hasMany(ServicePrice::class);
    }
}
