<?php

namespace App\Http\Controllers;

use App\Programa;
use App\Servicio;
use App\Slider;
use App\Noticia;
use App\Fotografia;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $slider = Slider::all()->sortBy('posicion');
        $programa = Programa::all()->sortByDesc('idprograma')->take(4);
        $servicio = Servicio::all()->sortByDesc('idservicio')->take(6);
        // $noticia = Noticia::all()->sortByDesc('fecha')->take(3);
        $fotografia = Fotografia::all()->sortByDesc('idfotografia')->take(8);
        $noticia = DB::table('noticia')
            ->join('fotografia', 'noticia.idnoticia', '=', 'fotografia.noticia_id')
            ->select('noticia.*', 'fotografia.*')
            ->groupBy('noticia.idnoticia')
            ->get()->sortByDesc('noticia.fecha');
            
        return view('frontend.index',compact(['slider','programa','servicio','noticia','fotografia']));
    }


}
