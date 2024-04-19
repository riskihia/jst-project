<?php

namespace App\Http\Controllers;

use App\Models\Tabel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelControler extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $username = $user->name;
        
        $tabel_exists = false;

        if($user->jst_model->tabel != null){
            $tabel_exists = true;
            $tabel_name = $user->jst_model->tabel->name;
            return view('model', compact('username', 'tabel_exists', 'tabel_name'));
        }
        
        return view('model', compact('username', 'tabel_exists'));
    }
    public function store_tabel(Request $request)
    {
        $user = Auth::user();
        $tabel_name= $request->input('tabel_name');

        $tabel = new Tabel();
        $tabel->jst_model_id = $user->jst_model->id;
        $tabel->name = $tabel_name;
        $tabel->save();

        return redirect('/model');
    }
}
