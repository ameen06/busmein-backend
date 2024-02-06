<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // public function auth(Request $request){
    //     try{
    //         $user = User::where('email', $request->email)->first();

    //         if (!$user || !Hash::check($request->password, $user->password)) {
    //             return response([
    //                 'status' => false,
    //                 'message' => 'Invalid credentials'
    //             ], Response::HTTP_UNAUTHORIZED);
    //         }
            
    //         $token = $user->createToken('token')->plainTextToken;
    
    //         $myUser = [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'email' => $user->email
    //         ];
    
    //         return response([
    //             'myToken' => $token,
    //             'user' => $myUser
    //         ]);
    //     }catch(Exception $error){
    //         return response([
    //             'status' => false,
    //             'message' => $error->getMessage()
    //         ]);
    //     }
    // }
}
