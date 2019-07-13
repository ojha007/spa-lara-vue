<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthenticationController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function logout()
    {

    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $email = $request->input('email');
        $password = $request->input('password');
        $check = User::where('email', $email)->first();
        if (!$check) {
            return 'No Email Found';
        }
        if (Hash::check($check->password, $password)) {
            return response()->json([
                'token'
            ],200);
        }

    }


}
