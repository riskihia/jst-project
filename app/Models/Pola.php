<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pola extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'polas';

    protected $fillable = [
        'name',
        'cell_id',
        'tabel_id',
        'target',
        'bias',
    ];

    public function tabel()
    {
        return $this->belongsTo(Tabel::class);
    }

    public function cell()
    {
        return $this->belongsTo(Cell::class);
    }
}
