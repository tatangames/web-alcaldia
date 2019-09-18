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
    // Metodo para cargar informacion en pagina Index Publica
    public function index(){
        $slider = Slider::all()->sortBy('posicion');
        $programa = Programa::all()->sortByDesc('idprograma')->take(4);
        $servicios = Servicio::all()->sortByDesc('idservicio')->take(6);
        $fotografia = Fotografia::all()->sortByDesc('idfotografia')->take(8);
        $serviciosMenu = $this->getServiciosMenu(); 
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
       
        return view('frontend.index',compact(['slider','programa','servicios','noticia','fotografia','serviciosMenu']));
    }
    //Metodo para la pagina de servicios para listarlos todos
    public function getAllServicios(){
        $servicios = Servicio::all();
        $serviciosMenu = $this->getServiciosMenu(); 
        return view('frontend.paginas.servicios',compact('servicios','serviciosMenu'));
    }
    //Metodo para obtener los servicios del Menu para navbar
    public function getServiciosMenu(){
        $servicios = Servicio::all()->sortByDesc('idservicio')->take(6);
        return $servicios;
    }
    //Metodo para pagina de Servicio Individual
    public function getServicioByname($nombre){        
        $servicio =  DB::table('servicios')->where('nombreservicio', $nombre)->first();
        $serviciosMenu = $this->getServiciosMenu(); 
        return view('frontend.paginas.servicio',compact(['servicio','serviciosMenu']));
    }
    //Metodo para pagina de Programa Individual
    public function getProgramaByname($nombre){        
        $programa =  DB::table('programas')->where('nombreprograma', $nombre)->first();
        $serviciosMenu = $this->getServiciosMenu(); 
        return view('frontend.paginas.programa',compact(['programa','serviciosMenu']));
    }
    //Metodo para pagina de Galerias
  public function getAllFotografias()
  {
      $fotografias = Fotografia::all()->sortByDesc('idfotografia')->take(100);
      $serviciosMenu = $this->getServiciosMenu(); 
      return view('frontend.paginas.galeria', compact(['fotografias','serviciosMenu']));
  }
}
