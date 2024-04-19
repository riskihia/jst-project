<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tabel extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tabels';

    protected $fillable = [
        'jst_model_id',
        'name',
    ];

    public function cells()
    {
        return $this->hasMany(Cell::class);
    }
    
    public function polas()
    {
        return $this->hasMany(Pola::class);
    }

    public function jst_model()
    {
        return $this->belongsTo(Jst_model::class);
    }

}
