<?php

namespace App\Http\Controllers;
use App\Slider;
use App\Programa;
use App\Servicio;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $slider = Slider::all()->sortBy('posicion');
        $programa = Programa::all()->sortByDesc('idprograma')->take(4);
        $servicio = Servicio::all()->sortByDesc('idservicio')->take(6);
        return view('frontend.index',compact(['slider','programa','servicio']));
    }
}
