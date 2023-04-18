<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    public $timestamps = false;
    protected $fillable = ['nombreslider','estado', 'posicion', 'fotografia','link'];
}
