<?php

namespace App\Http\Controllers;

use App\Programa;
use App\Servicio;
use App\Slider;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $slider = Slider::all()->sortBy('posicion');
        return view('frontend.index',compact('slider'));

    }
}
