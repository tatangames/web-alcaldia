<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Servicio;

class ServiciosController extends Controller
{
    // retornar vista 
   public function index(){
    return view('backend.paginas.ListarServicio');
        }
        // retornar vista tabla con los datos
    public function getServicioTabla(){        
        $servicio = Servicio::all();

        return view('backend.paginas.tablas.tablaServicio',compact('servicio'));
    }
}
