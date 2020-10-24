<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use  App\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'     => 'required|max:55',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if($validator->fails()) {
            return response([
                'message' => 'failed',
                'error' => $validator->errors()
            ], 400);
        }
        
        $data['password'] = bcrypt($request->password);
        
        $user = User::create($data);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user'         => $user,
            'access_token' => $accessToken
        ]);

    }

    public function login(Request $request) {
        
        $data = $request->all();
        $validator = Validator::make($data, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response([
                'message' => 'failed',
                'error' => $validator->errors()
            ], 400);
        }

        if(!auth()->attempt($data)) {
            return response(['message' => 'Invalid Credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'user'         => auth()->user(),
            'access_token' => $accessToken
        ]);
    }
}
