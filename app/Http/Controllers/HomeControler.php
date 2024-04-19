<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeControler extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $username = $user->name;
        return view('home', compact('username'));
    }

    // login
    public function login()
    {
        return view('login');
    }

    public function store_login(Request $request)
    {
        $username = $request->username;
        
        $user = User::where('name', $username)->first();

        if($user){
            Auth::login($user);
            return redirect('/home');
        }

        $user = new User();
        $user->name = $username;
        $user->save();
        Auth::login($user);

        return redirect('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
