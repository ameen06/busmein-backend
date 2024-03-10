<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        try{
            $destinations = Destination::select('slug','name','type')->get();

            return response()->json([
                'status' => true,
                'destinations' => $destinations
            ], 200);
        }catch(Exception $error){
            return response()->json([
                'status' => false,
                'message' => $error->getMessage()
            ], 500);
        }
    }
}
