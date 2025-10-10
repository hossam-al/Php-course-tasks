<?php

namespace App\Http\Controllers\API;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class AuthCotroler extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:20',
                'regex:/^[0-9+\-\s]+$/',
                'unique:users,phone',
            ],
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken("mytoken")->plainTextToken;

        return response([
            'data' => $user,
            'message' => 'User registered successfully',
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken("mytoken")->plainTextToken;

        return response([
            'status' => true,
            'data' => $user,
            'message' => 'Login successful',
            'token' => $token,

        ], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response([
            'message' => 'Logout successful'
        ], 200);
    }

    public function deleteUser()
    {
        $user = Auth::user();

        if ($user) {
            $user->delete();
            return response([
                'message' => 'User deleted successfully'
            ], 200);
        }

        return response([
            'message' => 'Error: User not found'
        ], 404);
    }
}
