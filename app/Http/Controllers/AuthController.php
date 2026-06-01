<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Added this import line

class AuthController extends Controller
{
    public function showRegister(){
        return view('register');
    }

    public function register(Request $request){

        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email already exists');
        }   

        if($request->password !== $request->confirmpassword){
            return back()->with('error', 'Passwords do not match');
        }

        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
        ]);

        return back()->with('success', 'Account successfully created');
    }

    public function showlogin(){
        return view('login');
    }

    public function login(Request $request){

        // 1. Validate form input data values
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Use official Laravel Auth attempt to check password against phpMyAdmin BCRYPT/password_hash
        if (Auth::attempt($credentials)) {
            
            // CRITICAL: This generates the secure session cookie link we were missing!
            $request->session()->regenerate();

            // Direct route to your protected system dashboard view layout
            return redirect()->intended('dashboard')->with('success', 'Login successfully');
        }

        // 3. If it fails, bounce back with an error banner alert
        return back()->with('error', 'Invalid Credentials');
    }
}