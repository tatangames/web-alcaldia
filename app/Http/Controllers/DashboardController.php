<?php

namespace App\Http\Controllers;

use App\Noticia;
use App\Programa;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Visitors;

class DashboardController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        $idusuario =  auth()->user()->id;
        $usuario =  DB::table('users')->where('id', $idusuario)->first();
        return view('backend.index',compact('usuario'));
    }

    public function getInicio(){
        $conteoPrograma = Programa::count();
        $conteoServicio = Servicio::count();
        $conteoNoticia = Noticia::count();
        $visitas =  DB::table('visitors')->distinct('ip')->count();
        $downloads =  DB::table('visitors')->sum('downloads');
        return view('backend.paginas.inicio',compact(['conteoNoticia','conteoPrograma','conteoServicio','visitas','downloads']));
    }
}
