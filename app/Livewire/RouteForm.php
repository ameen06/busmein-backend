<?php

namespace App\Livewire;

use Livewire\Attributes\Validate; 
use App\Models\Destination;
use App\Models\Route;
use App\Models\RouteStop;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RouteForm extends Component
{
    public $edit_route;
    public $boarding_points = [];
    public $dropping_points = [];
    public $all_points = [];
    #[Validate('required')] 
    public $title = '';
    #[Validate('required')] 
    public $starting_point;
    #[Validate('required')] 
    public $ending_point;
    #[Validate('required|min:1|integer')] 
    public $total_time = 1;
    #[Validate('required|min:1|integer')] 
    public $total_distance = 1;

    #[Validate([
        'route_stops.*.*' => [
            'required',
            'min:1',
        ],
    ])]
    public $route_stops = [
        [
            'stop_id' => '',
            'time' => 1
        ]
    ];

    public function __construct()
    {
        $this->edit_route = request()->route('route');
    }

    public function mount(){
        $this->boarding_points = Destination::whereIn('type', ['Boarding Point', 'Both'])->get();
        $this->dropping_points = Destination::whereIn('type', ['Dropping Point', 'Both'])->get();
        $this->all_points = Destination::all();

        if($this->edit_route){
            $route = Route::find($this->edit_route);
            $this->title = $route->title;
            $this->starting_point = $route->starting_point;
            $this->ending_point = $route->ending_point;
            $this->total_time = $route->total_time;
            $this->total_distance = $route->total_distance;

            $stops = RouteStop::where('route_id', $this->edit_route)->select('id','stop_id','time_it_takes as time')->get()->toArray();
            array_splice($stops, 0, 1);
            array_splice($stops, (count($stops) - 1), 1);
            $this->route_stops = $stops;
        }
    }

    public function addRouteStop(){
        $this->route_stops[] = [
            'stop' => '',
            'time' => 1
        ];
    }

    public function removeRouteStop($index){
        array_splice($this->route_stops, $index, 1);
    }

    public function createRoute(){
        $this->validate(); 

        try {
            DB::beginTransaction();
    
            $route = Route::create(
                $this->only(['title', 'starting_point', 'ending_point', 'total_time', 'total_distance'])
            );

            RouteStop::create([
                'route_id' => $route->id,
                'stop_id' => $this->starting_point,
                'time_it_takes' => 0,
            ]);

            if(count($this->route_stops) > 0){
                foreach($this->route_stops as $stop){
                    RouteStop::create([
                        'route_id' => $route->id,
                        'stop_id' => $stop['stop_id'],
                        'time_it_takes' => $stop['time'],
                    ]);
                }
            }

            RouteStop::create([
                'route_id' => $route->id,
                'stop_id' => $this->ending_point,
                'time_it_takes' => $this->total_time,
            ]);
     
            DB::commit();
            
            return $this->redirect(route('routes.index'));
        } catch(Exception $error) {
            DB::rollBack();
            return redirect()->back()->withInput()->with(['alert' => true, 'alertColor' => 'red', 'message' => $error->getMessage()]);
        }
    }

    public function updateRoute(){
        $this->validate(); 

        try {
            DB::beginTransaction();
    
            Route::where('id', $this->edit_route)->update(
                $this->only(['title', 'starting_point', 'ending_point', 'total_time', 'total_distance'])
            );

            RouteStop::where('route_id', $this->edit_route)->delete();

            RouteStop::create([
                'route_id' => $this->edit_route,
                'stop_id' => $this->starting_point,
                'time_it_takes' => 0,
            ]);

            if(count($this->route_stops) > 0){
                foreach($this->route_stops as $stop){
                    RouteStop::create([
                        'route_id' => $this->edit_route,
                        'stop_id' => $stop['stop_id'],
                        'time_it_takes' => $stop['time'],
                    ]);
                }
            }

            RouteStop::create([
                'route_id' => $this->edit_route,
                'stop_id' => $this->ending_point,
                'time_it_takes' => $this->total_time,
            ]);
     
            DB::commit();
            
            return $this->redirect(route('routes.index'));
        } catch(Exception $error) {
            DB::rollBack();
            return $this->addError('error', $error->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.route-form');
    }
}
