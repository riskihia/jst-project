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
        $is_valid_model = false;

        if($user->jst_model->tabel != null){
            $tabel_exists = true;
            $tabel_name = $user->jst_model->tabel->name;
            return view('model', compact('user', 'username','is_valid_model', 'tabel_exists', 'tabel_name'));
        }

        return view('model', compact('user', 'username', 'tabel_exists','is_valid_model'));
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

        if($user->jst_model->tabel == null){
            return redirect('/model')->with("message", "Tabel tidak ada");
        }

        $target = $request->input('target');
        $bias = $request->input('bias');
        $nama_pola = $request->input('nama_pola');
        $x1 = $request->input('box1');
        $x2 = $request->input('box2');
        $x3 = $request->input('box3');
        $x4 = $request->input('box4');
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

        $pola = Pola::create([
            "tabel_id" => $user->jst_model->tabel->id,
            "cell_id" => $cell->id,
            "target" => $target,
            "bias" => $bias,
            "name" => $nama_pola,
        ]);

        return redirect('/model');
    }

    public function train_pola(Request $request)
    {
        $polas = $request->input('pola');
        $delta = [[]];
        $weight = [[]];
        $target_array = [];
        if(count($polas) < 2){
            return redirect('/model')->with('error', 'Pilih pola lebih dari 1 terlebih dahulu');
        }

        //mencari nilai delta dan weight
        for($x=0; $x < count($polas); $x++) {
            if($x == 0){
                $pola = Pola::find($polas[$x]);
                $cell = $pola->cell;
                $bias = $pola->bias;
                $target = $pola->target;

                // collect target for last step
                $target_array[$x] = $target;
    
                for($i=1; $i<=9; $i++){
                    $delta[$x]['w'.$i] = $cell['x'.$i] * $target;
                }
                $delta[$x]['bias'] = $bias * $target;

                //create weight array
                for($i=1; $i<=9; $i++){
                    $weight[$x]['weight'.$i] = $delta[$x]['w'.$i];
                }
                $weight[$x]['bias'] = $delta[$x]['bias'];

                continue;
            }

            $pola = Pola::find($polas[$x]);
            $cell = $pola->cell;
            $bias = $pola->bias;
            $target = $pola->target;

            // collect target
            $target_array[$x] = $target;

            for($i=1; $i<=9; $i++){
                $delta[$x]['w'.$i] = $cell['x'.$i] * $target;
            }
            $delta[$x]['bias'] = $bias * $target;

            //create weight array
            for($i=1; $i<=9; $i++){
                $weight[$x]['weight'.$i] = $delta[$x]['w'.$i] + $weight[$x-1]['weight'.$i];
            }
            $weight[$x]['bias'] = $delta[$x]['bias'] + $delta[$x-1]['bias'];
        }

        // menghitung nilai NET
        $net = [];

        for($x = 0; $x < count($polas); $x++){
            $fix_weight = $weight[count($delta) - 1];
            $temp_net = 0;

            $pola = Pola::find($polas[$x]);
            $cell = $pola->cell;
            for($i=1; $i<=9; $i++){
                $temp_net += $fix_weight['weight'.$i] * $cell['x'.$i];
                
                if($i == 9){
                    $temp_net += $fix_weight['bias'];
                }
            }
            $net[$x] = $temp_net;
        }

        // periksa nilai NET
        $net_result = [];
        foreach($net as $index => $net_item){
            if($net_item >= 0){
                $net_result[$index] = 1;
            }else{
                $net_result[$index] = -1;
            }
        }

        // periksa hasil net dengan target. apakah sama?
        $is_valid_model = true;
        $final_result = [];
        foreach($target_array as $index => $target){
            $final_result[$index] = $target == $net_result[$index] ? "Pola ".$index." VALID" : "Pola ".$index." NOT VALID";
        }

        foreach($final_result as $result){
            if(strpos($result, "NOT VALID") !== false){
                $is_valid_model = false;
            }
        }
        $locked_pola_id = [];
        if($is_valid_model){
            foreach($polas as $pola){
                $locked_pola_id[] = $pola;
            }
        }

        $user = Auth::user();
        $tabel_exists = Auth::user()->jst_model->tabel != null ? true : false;
        $tabel_name = Auth::user()->jst_model->tabel->name;
        
        session()->flash('final_result', $final_result);
        return view('model', compact('user', 'is_valid_model','locked_pola_id', 'tabel_exists', 'tabel_name'));
        // return redirect('/model')->with('final_result', $final_result);
        
    }

    public function save_model(Request $request)
    {
        $pola_ids = $request->input('pola_ids');
        $polas = Pola::all();
        foreach($polas as $pola){
            $pola->is_locked = false;
            $pola->save();
        }
        foreach($pola_ids as $pola_id){
            $pola = Pola::where('id', $pola_id)->first();
            $pola->is_locked = true;
            $pola->save();
        }

        return redirect('/model')->with('success', 'Model berhasil disimpan');
    }
}
