<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';
    public $timestamps = false;
    protected $fillable = ['nombreservicio','estado', 'logo', 'descorta', 'deslarga', 'imagen'];
}
