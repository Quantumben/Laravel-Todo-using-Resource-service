<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(RegisterUserRequest $req)
    {


        $user = User::create([
            'name' =>$req['name'],
            'email' =>$req['email'],
            'password' => bcrypt($req['password'])
        ]);

        //Create Token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(UpdateUserRequest $requ)
    {


         //Check Email
         $user = User::where('email', $requ['email'])->first();
         //Check Password
         if(!$user || !Hash::check($requ['password'], $user->password))
         {
            return response([

                'message' => 'Bad creds'
            ], 401);
         }

        //Create Token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [

            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        //User::tokens()->delete();

        return [
            'message' => 'Logged Out'
        ];
    }
}
