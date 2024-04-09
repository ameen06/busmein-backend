<?php

namespace App\Livewire\Service;

use App\Models\Route;
use App\Models\RouteStop;
use App\Models\Service;
use App\Models\ServicePrice;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ServiceCreateForm extends Component
{
    public $bus;
    #[Validate('required')]
    public $title = '';
    #[Validate('required|integer')]
    public $day = '';
    #[Validate('required')]
    public $start_time;
    #[Validate('required')]
    public $route;
    #[Validate([
        'route_prices.*.*' => [
            'required',
        ],
    ])]
    public $route_prices = [];

    public function mount(){
        $this->bus = request()->route('bus');
    }

    public function updatedRoute($value){
        $this->route_prices = RouteStop::with('stop')
            ->where('route_id', $value)
            ->get()
            ->map(function($stop){
                return [
                    'stop_id' => $stop->id,
                    'stop_name' => $stop->stop->name,
                    'price' => 0
                ];
            })
            ->toArray();
    }

    public function createService(){
        $this->validate(); 

        try {
            DB::beginTransaction();
    
            $service = Service::create([
                'title' => $this->title,
                'day' => $this->day,
                'start_time' => Carbon::parse($this->start_time)->format('H:i:s'),
                'bus_id' => $this->bus->id,
                'route_id' => $this->route,
            ]);

            if(count($this->route_prices) > 0){
                foreach($this->route_prices as $price){
                    ServicePrice::create([
                        'bus_id' => $this->bus->id,
                        'route_id' => $this->route,
                        'service_id' => $service->id,
                        'stop_id' => $price['stop_id'],
                        'price' => $price['price'],
                    ]);
                }
            }
     
            DB::commit();
            
            return $this->redirect(route('buses.services.index', $this->bus->id));
        } catch(Exception $error) {
            DB::rollBack();
            return $this->addError('error', $error->getMessage());
        }
    }

    public function render()
    {
        $routes = Route::all();
        return view('livewire.service.service-create-form', ['routes' => $routes]);
    }
}
