<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller{
    public function index(){
        return view('register.index', [
            "title" => 'Register Page',
            "active" => 'register'
        ]);
    }

    // Cara Satu:
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'phone_number' => 'required|min:10|unique:users',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'min:8', 'max:255', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%]).*$/'],
            'role' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration success');
          
    }
}
