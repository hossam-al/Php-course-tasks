<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Authcontroller extends Controller
{
    public function regiser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'data' => $user,
            'message' => 'User registered successfully',
            'Token' => $token,
            'status' => 201,
        ];
        Mail::to($user->email)->send(new WelcomeMail($user, $data['password']));

        return response($response, 201);
    }
    public function login(Request $request)
    {
        $data = $request->validate([

            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where("email", '=', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            $response = [

                'message' => 'can not login',

                'status' => 20,
            ];
        } else {
            $token = $user->createToken('mytoken')->plainTextToken;
            $response = [
                'data' => $user,
                'message' => 'Login successfully',
                'Token' => $token,
                'status' => 201,
            ];
        }
        Mail::to($user->email)->send(new WelcomeMail($user,$data['password']));

        return response($response, 201);

    }
    public function logout(){
        Auth::user()->tokens()->delete();
        $response = [

            'message' => 'Logout successfully',

            'status' => 201,
        ];


    return response($response, 201);
    }
}
