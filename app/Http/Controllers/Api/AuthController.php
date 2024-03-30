<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            $request->validate([
                'phone' => 'required'
            ]);

            $user = User::where('phone', $request->phone)->first();
            
            if(!$user){
                return response([
                    'status' => false,
                    'message' => "User does not exist",
                ], 401);
            }

            $payload = [
                'To' => '+' . $request->phone,
                'Channel' => 'sms',
            ];

            $response = Http::withBasicAuth('ACbcfb96793d2a45f5c4b357b44a1c5abb', '6edc3a54ba41571daa99735697894ac2')->asForm()->post('https://verify.twilio.com/v2/Services/VA433267c1ff373fa13aa0c79c3aeb86f3/Verifications', $payload);
    
            $response = $response->object();

            if(isset($response->status) && $response->status == "pending"){
                return response([
                    'status' => true,
                    'message' => "OTP send successfully!",
                ], 200);
            }else{
                info(json_encode($response));
                return response([
                    'status' => false,
                    'message' => "Something went wrong when sending otp",
                    'response' => $response
                ], 500);
            }

            return response([
                'status' => false,
                'message' => "Something went wrong"
            ], 500);
        }catch(Exception $error){
            return response([
                'status' => false,
                'message' => $error->getMessage(),
            ], 500);
        }   
    }

    public function verify(Request $request)
    {
        try{
            $request->validate([
                'phone' => 'required',
                'code' => 'required'
            ]);

            $user = User::where('phone', $request->phone)->first();
            
            if(!$user){
                return response([
                    'status' => false,
                    'message' => "User does not exist",
                ], 400);
            }

            $payload = [
                'To' => '+' . $request->phone,
                'Code' => $request->code,
            ];

            $response = Http::withBasicAuth('ACbcfb96793d2a45f5c4b357b44a1c5abb', '6edc3a54ba41571daa99735697894ac2')->asForm()->post('https://verify.twilio.com/v2/Services/VA433267c1ff373fa13aa0c79c3aeb86f3/VerificationCheck', $payload);
    
            $response = $response->object();

            if(
                isset($response->status) &&
                $response->status == "approved" &&
                isset($response->valid) &&
                $response->valid == true
            ){
                $token = $user->createToken('token')->plainTextToken;

                $user_data = [
                    "full_name" => $user->name,
                    "phone_number" => $user->phone,
                    "email" => $user->email,
                    "user_id" => $user->id,
                    "auth_token" => $token,
                ];

                return response([
                    'status' => true,
                    'message' => "OTP verified successfully!",
                    'user' => $user_data
                ], 200);
            }else{
                return response([
                    'status' => false,
                    'message' => "Something went wrong verifying OTP",
                    'response' => $response
                ], 500);
            }

            return response([
                'status' => false,
                'message' => "Something went wrong"
            ], 500);
        }catch(Exception $error){
            return response([
                'status' => false,
                'message' => $error->getMessage(),
            ], 500);
        }   
    }

    public function register(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|string|email|max:255|unique:users',
                'phone' => 'required|numeric|min_digits:10|max_digits:16|unique:users',
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            
            $payload = [
                'To' => '+' . $user->phone,
                'Channel' => 'sms',
            ];
    
            $response = Http::withBasicAuth('ACbcfb96793d2a45f5c4b357b44a1c5abb', '6edc3a54ba41571daa99735697894ac2')->asForm()->post('https://verify.twilio.com/v2/Services/VA433267c1ff373fa13aa0c79c3aeb86f3/Verifications', $payload);
    
            $response = $response->object();
    
            if(isset($response->status) && $response->status == "pending"){
                return response([
                    'status' => true,
                    'message' => "OTP send successfully!",
                ], 200);
            }else{
                info(json_encode($response));
                return response([
                    'status' => false,
                    'message' => "Something went wrong when sending otp",
                    'response' => $response
                ], 500);
            }
    
            return response([
                'status' => false,
                'message' => "Something went wrong"
            ], 500);
        }catch(Exception $error){
            return response([
                'status' => false,
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request) {
        try{
            $request->user()->currentAccessToken()->delete();
    
            return response([
                'status' => true,
                'message' => 'Logout Successful',
            ]);
        }catch(Exception $error){
            return response([
                'status' => false,
                'message' => $error->getMessage(),
            ], 500);
        }
    }
}
