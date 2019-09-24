<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    protected $table = 'visitors';
    public $timestamps = false;
    protected $fillable = ['id','ip', 'visited_date', 'hits'];
}
