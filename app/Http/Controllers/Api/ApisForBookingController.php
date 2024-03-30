<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ApisForBookingController extends Controller
{
    public function getBusForRoute(Request $request)
    {
        try{
            $buses = [
                [
                    'bus' => [
                        'id' => 2,
                        'bus_name' => 'Cochin Express',
                        'subtext' => 'Volvo Multi Axle Semi Sleeper',
                        'total_seats' => 40,
                        'badge' => 'moderate',
                        'rating' => 4.3
                    ],
                    'boarding_time' => '6:00',
                    'dropping_time' => '11:35',
                    'total_hours' => '5h 35m',
                    'price' => 250
                ],
                [
                    'bus' => [
                        'id' => 1,
                        'bus_name' => 'Emerald Travels',
                        'subtext' => 'Volvo Multi Axle Semi Sleeper AC',
                        'total_seats' => 40,
                        'badge' => 'moderate',
                        'rating' => 4.6
                    ],
                    'boarding_time' => '13:00',
                    'dropping_time' => '18:00',
                    'total_hours' => '5h 00m',
                    'price' => 260
                ],
                [
                    'bus' => [
                        'id' => 1,
                        'bus_name' => 'Sonia Travels',
                        'subtext' => 'Semi Sleeper AC',
                        'total_seats' => 40,
                        'badge' => 'cheapest',
                        'rating' => 3.2
                    ],
                    'boarding_time' => '20:00',
                    'dropping_time' => '1:00',
                    'total_hours' => '5h 00m',
                    'price' => 220
                ]
            ];

            shuffle($buses);

            return response()->json([
                'status' => true,
                'message' => 'Buses fetched successfully',
                'buses' => $buses
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function getBoardingPoints()
    {
        try{
            $points = [
                [
                    'place_name' => 'Kalpetta',
                    'place_address' => 'Kalpetta, My Location, Near Bar, 874569',
                    'boarding_time' => '6:00',
                    'date' => '17 Jan',
                ],
                [
                    'place_name' => 'Vythiri',
                    'place_address' => 'Vythiri, Bus Station, Opposite Shopping Complex, 741236',
                    'boarding_time' => '7:00',
                    'date' => '17 Jan',
                ],
                [
                    'place_name' => 'Laddiki',
                    'place_address' => 'Lakkidi, Bus stop, Some street, 234523',
                    'boarding_time' => '8:00',
                    'date' => '17 Jan',
                ],
            ];

            return response()->json([
                'status' => true,
                'message' => 'Boarding Points fetched successfully',
                'boarding_points' => $points
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
            $points = [
                (object)[
                    'place_name' => 'Kalpetta',
                    'place_address' => 'Kalpetta, My Location, Near Bar, 874569',
                    'boarding_time' => '6:00',
                    'date' => '17 Jan',
                ],
                (object)[
                    'place_name' => 'Vythiri',
                    'place_address' => 'Vythiri, Bus Station, Opposite Shopping Complex, 741236',
                    'boarding_time' => '7:00',
                    'date' => '17 Jan',
                ],
                (object)[
                    'place_name' => 'Laddiki',
                    'place_address' => 'Lakkidi, Bus stop, Some street, 234523',
                    'boarding_time' => '8:00',
                    'date' => '17 Jan',
                ],
                (object)[
                    'place_name' => 'Kozhikode',
                    'place_address' => 'Kozhikode, Main Bus Stand, 465213',
                    'boarding_time' => '9:00',
                    'date' => '17 Jan',
                ],
            ];

            return response()->json([
                'status' => true,
                'message' => 'Dropping Points fetched successfully',
                'boarding' => request()->query('boarding'),
                'dropping_points' => $this->findAndSliceObjects($points, request()->query('boarding'))
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    function findAndSliceObjects($objects, $targetName) {
        $targetIndex = null;
      
        foreach ($objects as $index => $object) {
          if (isset($object->place_name) && $object->place_name == $targetName) {
            $targetIndex = $index + 1;
            break;
          }
        }

        info($targetIndex);
      
        return $targetIndex !== null ? array_slice($objects, $targetIndex) : [];
    }
}
