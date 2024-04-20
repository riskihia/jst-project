<?php

namespace App\Http\Controllers;

use App\Models\Jst_model;
use App\Models\Pola;
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
        
        $model_exists = false;

        if($user->jst_model != null){
            $model_exists = true;
            $model_name = $user->jst_model->name;
            return view('home', compact('username', 'model_exists', 'model_name'));
        }
        return view('home', compact('username', 'model_exists'));
    }

    // model
    public function store_model(Request $request)
    {
        $model_name= $request->input('model_name');

        $model = new Jst_model();
        $model->user_id = Auth::id();
        $model->name = $model_name;
        $model->save();

        return redirect('/home');
    }

    public function prediksi(Request $request)
    {
        $allx = [];

        $allx[] = $request->input('box1') == null ? -1 : 1;
        $allx[] = $request->input('box2') == null ? -1 : 1;
        $allx[] = $request->input('box3') == null ? -1 : 1;
        $allx[] = $request->input('box4') == null ? -1 : 1;
        $allx[] = $request->input('box5') == null ? -1 : 1;
        $allx[] = $request->input('box6') == null ? -1 : 1;
        $allx[] = $request->input('box7') == null ? -1 : 1;
        $allx[] = $request->input('box8') == null ? -1 : 1;
        $allx[] = $request->input('box9') == null ? -1 : 1;


        $user = Auth::user();
        $polas = Pola::where('tabel_id', $user->jst_model->tabel->id)->where('is_locked', 1)->get();
        
        $hasil_prediksi = null;

        foreach($polas as $pola){
            $cell = $pola->cell;

            $temp_pola = [];
            for($i=1; $i<=9; $i++){
                $temp_pola[] = $cell['x'.$i];
            }
            if($temp_pola == $allx){
                $hasil_prediksi = $pola->name;
            }
        }

        if($hasil_prediksi == null){
            $hasil_prediksi = "Pola tidak dikenali";
        }
        
        return redirect('/home')->with("hasil_prediksi", $hasil_prediksi);
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
