<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jst_model extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'jst_models';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tabel()
    {
        return $this->hasOne(Tabel::class);
    }
}
