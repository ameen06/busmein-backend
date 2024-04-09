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

class ServiceEditForm extends Component
{
    public $bus;
    public $service;
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
        $service = Service::with(['route', 'bus'])->where('id', request()->route('service'))->first();

        $this->service = $service->id;
        $this->title = $service->title;
        $this->day = $service->day;
        $this->start_time = $service->start_time;
        $this->route = $service->route_id;

        $this->route_prices = RouteStop::with('stop')
            ->where('route_id', $service->route_id)
            ->get()
            ->map(function($stop) use ($service) {
                return [
                    'stop_id' => $stop->id,
                    'stop_name' => $stop->stop->name,
                    'price' => round(ServicePrice::where(['service_id' => $service->id, 'stop_id' => $stop->id])->first()->price),
                ];
            })
            ->toArray();
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

    public function updateService(){
        $this->validate(); 

        info('sdfsdf');

        // try {
            DB::beginTransaction();
    
            Service::where('id', $this->service)->update([
                'title' => $this->title,
                'day' => $this->day,
                'start_time' => Carbon::parse($this->start_time)->format('H:i:s'),
                'bus_id' => $this->bus,
                'route_id' => $this->route,
            ]);

            info(' $this->service ' .  $this->service);
            info(' $this->bus ' .  $this->bus);

            ServicePrice::where(['bus_id' => $this->bus, 'service_id' => $this->service])->delete();

            if(count($this->route_prices) > 0){
                info('there are services' . json_encode($this->route_prices));
                foreach($this->route_prices as $price){
                    ServicePrice::create([
                        'bus_id' => $this->bus,
                        'route_id' => $this->route,
                        'service_id' => $this->service,
                        'stop_id' => $price['stop_id'],
                        'price' => $price['price'],
                    ]);
                }
            }
     
            DB::commit();

            info('updated bus ' . json_encode($this->bus));
            
        //     return $this->redirect(route('buses.services.index', $this->bus));
        // } catch(Exception $error) {
        //     DB::rollBack();
        //     info('eror ' . $error->getMessage());
        //     return $this->addError('error', $error->getMessage());
        // }
    }

    public function render()
    {
        $routes = Route::all();
        return view('livewire.service.service-edit-form', ['routes' => $routes]);
    }
}
