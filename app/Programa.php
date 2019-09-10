<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $table = 'programas';
    public $timestamps = false;
    protected $fillable = ['nombreprograma','estado', 'logo', 'descorta', 'deslarga'];
}
