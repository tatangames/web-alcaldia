<?php

namespace App\Http\Controllers;

use App\Programa;
use App\Servicio;
use App\Slider;
use App\Noticia;
use App\Fotografia;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $slider = Slider::all()->sortBy('posicion');
        $programa = Programa::all()->sortByDesc('idprograma')->take(4);
        $servicio = Servicio::all()->sortByDesc('idservicio')->take(6);
        $noticia = Noticia::all()->sortByDesc('fecha')->take(3);
        $fotografia = Fotografia::all()->sortByDesc('idfotografia')->take(8);
        return view('frontend.index',compact(['slider','programa','servicio','noticia','fotografia']));
    }


}
