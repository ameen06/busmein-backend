<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request){
        try{
            $bookings = Booking::with(['passengers','bus'])
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
}
