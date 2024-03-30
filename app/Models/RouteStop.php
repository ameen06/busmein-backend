<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_id',
        'stop',
        'time_it_takes'
    ];

    public function route(){
        $this->belongsTo(Route::class);
    }

    public function stop(){
        $this->belongsTo(Destination::class, 'stop');
    }
}
