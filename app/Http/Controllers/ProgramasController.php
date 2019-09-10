<?php

namespace App\Http\Controllers;

use App\Programa;
use Illuminate\Http\Request;

class ProgramasController extends Controller
{
   // retornar vista 
   public function index(){
    return view('backend.paginas.ListarPrograma');
}

    // retornar vista tabla con los datos
    public function getProgramaTabla(){        
        $programa = Programa::all();

        return view('backend.paginas.tablas.tablaPrograma',compact('programa'));
    }

}
