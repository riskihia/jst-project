<?php

namespace App\Http\Controllers;

use App\Models\Cell;
use App\Models\Pola;
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

    public function store_pola(Request $request)
    {
        $user = Auth::user();

        $target = $request->input('target');
        $bias = $request->input('bias');
        $nama_pola = $request->input('nama_pola');
        $x1 = $request->input('box1');
        $x2 = $request->input('box2');
        $x3 = $request->input('box3');
        $x4 = $request->input('box4');

        // dd([$x1, $x2, $x3, $x4]);

        $x5 = $request->input('box5');
        $x6 = $request->input('box6');
        $x7 = $request->input('box7');
        $x8 = $request->input('box8');
        $x9 = $request->input('box9');

        $cell = Cell::create([
            "tabel_id" => $user->jst_model->tabel->id,
            "x1" => $x1 == null ? -1 : 1,
            "x2" => $x2 == null ? -1 : 1,
            "x3" => $x3 == null ? -1 : 1,
            "x4" => $x4 == null ? -1 : 1,
            "x5" => $x5 == null ? -1 : 1,
            "x6" => $x6 == null ? -1 : 1,
            "x7" => $x7 == null ? -1 : 1,
            "x8" => $x8 == null ? -1 : 1,
            "x9" => $x9 == null ? -1 : 1,
        ]);

        dd($cell);
    }
}
