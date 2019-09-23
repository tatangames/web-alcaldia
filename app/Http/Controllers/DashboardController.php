<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Programa;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

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
        $conteoSlider = Slider::count();
        $conteoPrograma = Programa::count();
        $conteoServicio = Servicio::count();
        return view('backend.paginas.inicio',compact(['conteoSlider','conteoPrograma','conteoServicio']));
    }
}
