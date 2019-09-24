<?php

namespace App\Http\Controllers;

use App\Documento;
use App\Programa;
use App\Servicio;
use App\Slider;
use App\Noticia;
use App\Fotografia;
use App\Visitors;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
  public function AddVisitor($descarga = NULL){
    $ip =  \Request::getClientIp(true);
    $visited_date = Date("Y-m-d");
    $vistor = Visitors::firstOrCreate(['ip' => $ip, 'visited_date' => $visited_date]);
    if($descarga != NULL){
      $vistor->increment('downloads');  
    }
    $vistor->increment('hits');
  }
    // Metodo para cargar informacion en pagina Index Publica
    public function index(){
        $this->AddVisitor();
        $slider = Slider::all()->sortBy('posicion');
        $programas = Programa::all()->sortByDesc('idprograma')->take(4);
        $servicios = Servicio::all()->sortByDesc('idservicio')->take(6);
        $fotografia = Fotografia::all()->sortByDesc('idfotografia')->take(8);
        $serviciosMenu = $this->getServiciosMenu(); 
        
        foreach($fotografia  as $secciones){  
            $noticia = Noticia::where('idnoticia', $secciones->noticia_id)->select('nombrenoticia', 'fecha')->first();        
            $secciones->nombre = $noticia->nombrenoticia; 
            $secciones->fecha = $noticia->fecha; 
        } 
        
        $noticia = $this->getRecentNew(5);        
       
        return view('frontend.index',compact(['slider','programas','servicios','noticia','fotografia','serviciosMenu']));
    }
    //Metodo para obtener las noticias recientes, usado en index y en noticiaselect
  public function getRecentNew($filtro){
    $noticiaReciente = DB::table('noticia')
      ->select('noticia.*')
      ->get()
      ->sortByDesc('fecha')
      ->take($filtro);

    foreach ($noticiaReciente  as $secciones) {
        $foto = Fotografia::where('noticia_id', $secciones->idnoticia)->pluck('nombrefotografia')->first();
        $secciones->nombrefotografia = $foto;
        }
    return $noticiaReciente;  
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
    public function getServicioByname($slug){        
        $servicio =  DB::table('servicios')->where('slug', $slug)->first();
        $serviciosMenu = $this->getServiciosMenu(); 
        $documentos = Documento::where('servicio_id', $servicio->idservicio)->get();
        return view('frontend.paginas.servicio',compact(['servicio','serviciosMenu','documentos']));
    }

    //Metodo para pagina de Programa Individual
    public function getProgramaByname($slug){        
        $programa =  DB::table('programas')->where('slug', $slug)->first();
        $serviciosMenu = $this->getServiciosMenu(); 
        return view('frontend.paginas.programa',compact(['programa','serviciosMenu']));
    }


  //Metodo para pagina de Galerias
  public function getAllFotografias(Request $request)
  {

      $fotografias = Fotografia::paginate(6);
      $serviciosMenu = $this->getServiciosMenu(); 
      return view('frontend.paginas.galeria', compact(['fotografias','serviciosMenu']));
  }

  //Metodo para obtener todas las noticias 
  public function getNoticias(){
        $noticias = Noticia::paginate(3);
        foreach($noticias  as $new){  
            $foto = Fotografia::where('noticia_id', $new->idnoticia)->pluck('nombrefotografia')->first();        
            $new->nombrefotografia = $foto; 
        }  
        $serviciosMenu = $this->getServiciosMenu(); 
        return view('frontend.paginas.noticias', compact(['serviciosMenu','noticias']));
  }

  //Metodo para obtener una noticia por su nombre
  public function getNoticiaByName($slug){
    $noticia =  DB::table('noticia')->where('slug', $slug)->first();
    $fotoInicial = Fotografia::where('noticia_id', $noticia->idnoticia)->pluck('nombrefotografia')->first(); 
    $fotografias = Fotografia::where('noticia_id', $noticia->idnoticia)->get()->forget(0);
    $noticia->nombrefotografia = $fotoInicial; 
    $noticiaReciente = $this->getRecentNew(3);
    $serviciosMenu = $this->getServiciosMenu(); 
    return view('frontend.paginas.noticiaSelect',compact(['noticia','serviciosMenu','noticiaReciente','fotografias']));
  }

  //Metodo para devolver vista de historia de tu alcaldia
  public function getHistoriaPage(){
    $serviciosMenu = $this->getServiciosMenu(); 
    return view('frontend.paginas.historia',compact('serviciosMenu'));
  }
//Metodo para devolver vista de gobierno municipal de tu alcaldia
  public function getGobiernoPage(){
    $serviciosMenu = $this->getServiciosMenu(); 
    return view('frontend.paginas.gob',compact('serviciosMenu'));
  }
  //Metodo para descargar un archivo
  public function getFile($nameFile)
{
    $this->AddVisitor(1);
    $file="storage/servicio/".$nameFile;
    $headers = array('Content-Type: application/pdf',);
    return response()->download($file, $nameFile, $headers);
}


}
