<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotografia extends Model
{
    protected $table = 'fotografia';
    public $timestamps = false;
    protected $fillable = ['noticia_id','nombrefotografia'];
}
