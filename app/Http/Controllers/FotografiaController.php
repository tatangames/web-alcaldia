<?php

namespace App\Http\Controllers;

use App\Fotografia;
use Illuminate\Http\Request;

class FotografiaController extends Controller
{
    // retornar vista tabla con los datos
    public function getFotografiaTabla($id){
        $fotografia = Fotografia::all();

        return view('backend.paginas.tablas.tablaFotografia',compact('fotografia'));
    }
}
