<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) ) {
            $request->session()->regenerate();
            return response()->json(['redirect'=>route('dashboard'),'status'=>200]);
        }
        else{
            return response()->json(['redirect'=>redirect('/'),'status'=>401]);
 
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // $request->session()->regenerate();
        return redirect('/');
    }
}
