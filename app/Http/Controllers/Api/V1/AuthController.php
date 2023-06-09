<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'token' => $request->user()->createToken($request->email)->plainTextToken,
                'message' => 'Success',                
                'id'=> $request->user()->id,
                'name' => $request->user()->name,
                'email'=> $request->user()->email,
                'is_admin'=> $request->user()->is_admin,
            ]);
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);

    }
}
