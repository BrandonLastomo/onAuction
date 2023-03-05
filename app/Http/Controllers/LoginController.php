<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

    public function index(){
        return view('login.index', [
            "title" => 'Login Page', 
            "active" => 'login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'login gagal!');

    }

    public function logout(Request $request){
        Auth::logout();

        // membuat session tidak bisa dipakai lagi (mengakhiri session)
        $request->session()->invalidate();
        // membuat token baru agar tidak mudah kena hack
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    
}
