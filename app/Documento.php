<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    public $timestamps = false;
    protected $fillable = ['servicio_id','nombre', 'url'];
}
