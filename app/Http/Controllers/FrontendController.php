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
        $fotografia = Fotografia::all()->sortByDesc('idfotografia')->take(8);

        foreach($fotografia  as $secciones){  
            $noticia = Noticia::where('idnoticia', $secciones->noticia_id)->select('nombrenoticia', 'fecha')->first();        
            $secciones->nombre = $noticia->nombrenoticia; 
            $secciones->fecha = $noticia->fecha; 
        } 
        
        $noticia = DB::table('noticia')        
        ->select('noticia.*')       
        ->get()->take(5);

        foreach($noticia  as $secciones){  
            $foto = Fotografia::where('noticia_id', $secciones->idnoticia)->pluck('nombrefotografia')->first();        
            $secciones->nombrefotografia = $foto; 
        }         
       
        return view('frontend.index',compact(['slider','programa','servicio','noticia','fotografia']));
    }


}
