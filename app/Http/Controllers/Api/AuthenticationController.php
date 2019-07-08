<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:jwt', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|string|max:191',
            'username' => 'required|max:191|min:8|string',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'email' => $request->input('email'),
            'name' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'role_id' => 1,
        ]);
        if ($user) {
            return $this->login($request);

        }
        return response()->json([
            'status' => Response::HTTP_EXPECTATION_FAILED,
            'message' => 'Something Went Wrong'
        ]);


    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' =>60
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }


}
