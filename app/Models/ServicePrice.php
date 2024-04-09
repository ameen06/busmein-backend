<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'route_id',
        'service_id',
        'stop_id',
        'price'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function stop()
    {
        return $this->belongsTo(RouteStop::class);
    }
}
