<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fruta extends Model
{
    protected $fillable = [
        'nome',
        'quantidade',
        'data_validade'
    ];
}
