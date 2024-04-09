<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Passenger;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Str;

class BookingController extends Controller
{
    public function index(Request $request){
        try{
            $bookings = Booking::with(['passengers','bus','boarding','dropping'])
                ->where([
                    'user_id' => $request->user()->id,
                    'status' => $request->query('filter')
                ])
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'Bookings fetched successfully',
                'bookings' => $bookings
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function create(Request $request){
        try{
            DB::beginTransaction();

            $booking = new Booking();
            $booking->user_id = $request->user_id;
            $booking->route_id = $request->route_id;
            $booking->service_id = $request->service_id;
            $booking->bus_id = $request->bus_id;
            $booking->ticket_number = 'BTKT' . rand(1000, 9999);
            $booking->booking_id = Str::random(8);
            $booking->status = 'active';
            $booking->boarding_point = $request->boarding_point;
            $booking->boarding_time = Carbon::createFromFormat('D, d M - H:i', $request->boarding_time)->format('Y-m-d H:i:s');
            $booking->dropping_point = $request->dropping_point;
            $booking->dropping_time = Carbon::createFromFormat('D, d M - H:i', $request->dropping_time)->format('Y-m-d H:i:s');
            $booking->total_passangers = $request->total_passangers;
            $booking->total_price = $request->total_price;
            $booking->discount = 0;
            $booking->platform_fee = 5;
            $booking->tax = (8/$request->total_price*100);
            $booking->billing_email = $request->billing_email;
            $booking->billing_phone = $request->billing_phone;
            $booking->save();

            if(count($request->passengers)){
                info(json_encode($request->passengers));
                foreach($request->passengers as $index => $passanger){
                    info(json_encode($passanger));
                    Passenger::create([
                        'booking_id' => $booking->id,
                        'seat_number' => $passanger['seat'],
                        'name' => $passanger['name'],
                        'age' => $passanger['age'],
                        'gender' => $passanger['gender'],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Booked successfully',
            ], 200);
        }catch(Exception $error){
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}
