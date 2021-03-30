<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function rooms()
    {
        return view('rooms');
    }

    public function contactUs()
    {
        return view('contact');
    }

    public function login()
    {
        if(auth()->check()){
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function register()
    {
        if(auth()->check()){
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function resetPassword()
    {
        if(auth()->check()){
            return redirect()->route('home');
        }
        return view('auth.reset-password');
    }
}
