<?php

namespace App\Http\Controllers;

use App\Models\Jst_model;
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

        $model = Jst_model::all();
        $model_exists = false;
        if($model){
            $model_exists = true;
            $model_name = $model->first()->name;
            return view('home', compact('username', 'model_exists', 'model_name'));
        }
        return view('home', compact('username', 'model_exists'));
    }

    // model
    public function store_model(Request $request)
    {
        $model_name= request('model_name');

        $model = new Jst_model();
        $model->user_id = Auth::id();
        $model->name = $model_name;
        $model->save();

        return redirect('/home')->with('message', 'Model created : '.$model_name);
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
