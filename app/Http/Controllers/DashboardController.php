<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Programa;
use App\Servicio;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        return view('backend.index');
    }

    public function getInicio(){
        $conteoSlider = Slider::count();
        $conteoPrograma = Programa::count();
        $conteoServicio = Servicio::count();
        return view('backend.paginas.inicio',compact(['conteoSlider','conteoPrograma','conteoServicio']));
    }
}
