<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cell extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cells';

    protected $fillable = [
        'tabel_id',
        'x1',
        'x2',
        'x3',
        'x4',
        'x5',
        'x6',
        'x7',
        'x8',
        'x9',
    ];

    public function tabel()
    {
        return $this->belongsTo(Tabel::class);
    }

    public function polas()
    {
        return $this->hasOne(Pola::class);
    }
}
