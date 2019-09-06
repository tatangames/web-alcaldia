<?php

namespace App\Http\Controllers;

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
        return view('backend.paginas.inicio');
    }

    public function getSlider(){
        return view('backend.paginas.ListarSlider');
    }
    public function getPrograma(){
        return view('backend.paginas.ListarPrograma');
    }
    public function getServicio(){
        return view('backend.paginas.ListarServicio');
    }
    public function getNoticia(){
        return view('backend.paginas.ListarNoticia');
    }
}
