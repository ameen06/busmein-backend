<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RouteStop;
use App\Models\Service;
use App\Models\ServicePrice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class ApisForBookingController extends Controller
{
    public function getBusForRoute(Request $request)
    {
        try{
            $boarding_point = $request->boarding_point;
            $dropping_point = $request->dropping_point;

            $serices = Service::with([
                'bus:id,bus_name,subtext,badge,rating',
            ])
            ->select(
                'services.id',
                'services.title',
                'bus_id',
                'services.start_time',
                'services.day',
                'route_id',
            )
            ->whereHas('route', function($query) use ($boarding_point, $dropping_point) {
                $query->whereHas('stops', function($query) use ($boarding_point, $dropping_point) {
                    $query->whereHas('stop', function($q) use ($boarding_point, $dropping_point) {
                        $q->whereIn('slug', [$boarding_point, $dropping_point]);
                    });
                }, '=', 2);
            })
            ->where('services.day', Carbon::createFromFormat('Y-m-d',$request->date)->toArray()['dayOfWeek']-1)
            ->get();

            info(json_encode($serices));

            $serices = $serices->map(function($service) use ($boarding_point, $dropping_point){
                // Time Calculation
                $boarding_time = RouteStop::whereHas('stop', function($query) use ($boarding_point, $service){
                    $query->where(['slug' => $boarding_point, 'route_id' => $service->route_id]);
                })->first()->time_it_takes;

                $dropping_time = RouteStop::whereHas('stop', function($query) use ($dropping_point, $service){
                    $query->where(['slug' => $dropping_point, 'route_id' => $service->route_id]);
                })->first()->time_it_takes;

                info(json_encode($dropping_time));

                $drop_time = $dropping_time - $boarding_time;

                info($drop_time ."=". $dropping_time ."-". $boarding_time);

                $service->boarding_time = Carbon::parse($service->start_time)->addMinutes($boarding_time);
                $service->dropping_time = Carbon::parse($service->boarding_time)->addMinutes($drop_time);

                $service->total_hours = $service->boarding_time->floatDiffInHours($service->dropping_time);
                $hours = floor($service->total_hours);
                $minutes = round(($service->total_hours - $hours) * 60);
                $service->total_hours = $hours . "h " . $minutes . "m";

                $service->boarding_time = $service->boarding_time->format('H:i');
                $service->dropping_time = $service->dropping_time->format('H:i');

                // price calculation
                $boarding_price = ServicePrice::where(['bus_id' => $service->bus_id, 'service_id' => $service->id])
                ->whereHas('stop', function($query) use ($boarding_point){
                    $query->whereHas('stop', function($q) use ($boarding_point) {
                        $q->where('slug', $boarding_point);
                    });
                })->first()->price;

                $dropping_price = ServicePrice::where(['bus_id' => $service->bus_id, 'service_id' => $service->id])
                ->whereHas('stop', function($query) use ($dropping_point){
                    $query->whereHas('stop', function($q) use ($dropping_point) {
                        $q->where('slug', $dropping_point);
                    });
                })->first()->price;

                $service->price = $dropping_price - $boarding_price;

                return $service;
            });

            return response()->json([
                'status' => true,
                'message' => 'Buses fetched successfully',
                'buses' => $serices,
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function getBoardingPoints(Request $request)
    {
        try{
            $boarding_point = $request->boarding_point;
            $dropping_point = $request->dropping_point;
            $service_id = $request->service_id;
            $date = $request->date;

            $service = Service::find($service_id);

            $stops = RouteStop::query()
            ->select(
                'route_stops.id',
                'destinations.id as stop_id',
                'destinations.name as place_name',
                'destinations.slug as place_slug',
                'destinations.address as place_address',
                'destinations.landmark as place_landmark',
                'route_stops.time_it_takes',
            )
            ->leftJoin('destinations', 'destinations.id', 'route_stops.stop_id')
            ->where('route_stops.route_id', $service->route_id)
            ->whereIn('destinations.type', ['Boarding Point','Both'])
            ->orderBy('route_stops.id')
            ->get();

            $stops = $stops->map(function($stop) use ($date, $service){
                $start_date_time = Carbon::parse($date . $service->start_time)->addMinutes($stop->time_it_takes);
                $stop->boarding_time = $start_date_time->format('H:i');
                $stop->date = $start_date_time->format('d M');
                $stop->date_full = $start_date_time->format('D, d M - H:i');
                $stop->place_address = $stop->place_address . ". landmark:" . $stop->place_landmark;
                return $stop;
            });

            // get only places between boarding and dropping point
            $itemsBetween = $stops->reduce(function ($carry, $item) use ($boarding_point, $dropping_point) {
                if ($item['place_slug'] === $boarding_point) {
                    $carry['collect'] = true;
                }
                if ($carry['collect'] && $item['place_slug'] !== $dropping_point) {
                    $carry['result'][] = $item;
                }
                if ($item['place_slug'] === $dropping_point) {
                    $carry['collect'] = false;
                }
                return $carry;
            }, ['collect' => false, 'result' => []]);
            $filteredItems = collect($itemsBetween['result']);
            $filteredItems->values()->all();

            return response()->json([
                'status' => true,
                'message' => 'Boarding Points fetched successfully',
                'boarding_points' => $filteredItems
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function getDroppingPoints(Request $request)
    {
        try{
            $boarding_point = $request->boarding_point;
            $dropping_point = $request->dropping_point;
            $service_id = $request->service_id;
            $date = $request->date;
            $boarding = $request->boarding;

            $service = Service::find($service_id);

            $stops = RouteStop::query()
            ->select(
                'route_stops.id',
                'destinations.id as stop_id',
                'destinations.name as place_name',
                'destinations.slug as place_slug',
                'destinations.type as place_type',
                'destinations.address as place_address',
                'destinations.landmark as place_landmark',
                'route_stops.time_it_takes',
            )
            ->leftJoin('destinations', 'destinations.id', 'route_stops.stop_id')
            ->where('route_stops.route_id', $service->route_id)
            ->orderBy('route_stops.id')
            ->get();

            info(json_encode($stops));

            $stops = $stops->map(function($stop) use ($date, $service){
                $start_date_time = Carbon::parse($date . $service->start_time)->addMinutes($stop->time_it_takes);
                $stop->dropping_time = $start_date_time->format('H:i');
                $stop->date = $start_date_time->format('d M');
                $stop->date_full = $start_date_time->format('D, d M - H:i');
                $stop->place_address = $stop->place_address . ". landmark:" . $stop->place_landmark;
                return $stop;
            });

            info(json_encode($stops));

            // get only places between boarding and dropping point
            $itemsBetween = $stops->reduce(function ($carry, $item) use ($boarding, $dropping_point) {
                if ($item['place_slug'] === $boarding) {
                    $carry['collect'] = true;
                }
                if ($carry['collect'] && $item['place_slug'] !== $boarding && $item['place_type'] !== "Boarding Point") {
                    $carry['result'][] = $item;
                }
                if ($item['place_slug'] === $dropping_point) {
                    $carry['collect'] = false;
                }
                return $carry;
            }, ['collect' => false, 'result' => []]);
            $filteredItems = collect($itemsBetween['result']);
            $filteredItems->values()->all();

            return response()->json([
                'status' => true,
                'message' => 'Dropping Points fetched successfully',
                'boarding' => $request->boarding,
                'dropping_points' => $filteredItems
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}