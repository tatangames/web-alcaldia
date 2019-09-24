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
        $anio = date("Y");
        //Para Visitas mensuales
        $visene =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-01-01',$anio.'-01-31'))->count();
        $visfeb =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-02-01',$anio.'-02-28'))->count();
        $vismar =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-03-01',$anio.'-03-31'))->count();
        $visabr =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-04-01',$anio.'-04-30'))->count();
        $vismay =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-05-01',$anio.'-05-31'))->count();
        $visjun =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-06-01',$anio.'-06-30'))->count();
        $visjul =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-07-01',$anio.'-07-31'))->count();
        $visago =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-08-01',$anio.'-08-31'))->count();
        $vissep =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-09-01',$anio.'-09-30'))->count();
        $visoct =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-10-01',$anio.'-10-31'))->count();
        $visnov =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-11-01',$anio.'-11-30'))->count();
        $visdic =  DB::table('visitors')->distinct('ip')->whereBetween('visited_date', array($anio.'-12-01',$anio.'-12-31'))->count();
        //Para descargas mensuales
        $dowene =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-01-01',$anio.'-01-31'))->sum('downloads');
        $dowfeb =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-02-01',$anio.'-02-28'))->sum('downloads');
        $dowmar =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-03-01',$anio.'-03-31'))->sum('downloads');
        $dowabr =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-04-01',$anio.'-04-30'))->sum('downloads');
        $dowmay =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-05-01',$anio.'-05-31'))->sum('downloads');
        $dowjun =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-06-01',$anio.'-06-30'))->sum('downloads');
        $dowjul =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-07-01',$anio.'-07-31'))->sum('downloads');
        $dowago =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-08-01',$anio.'-08-31'))->sum('downloads');
        $dowsep =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-09-01',$anio.'-09-30'))->sum('downloads');
        $dowoct =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-10-01',$anio.'-10-31'))->sum('downloads');
        $downov =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-11-01',$anio.'-11-30'))->sum('downloads');
        $dowdic =  DB::table('visitors')->whereBetween('visited_date', array($anio.'-12-01',$anio.'-12-31'))->sum('downloads');

        return view('backend.paginas.inicio',compact(['conteoNoticia','conteoPrograma','conteoServicio',
        'visene','visfeb','vismar','visabr','vismay','visjun','visjul','visago','vissep','visoct','visnov','visdic',
        'dowene','dowfeb','dowmar','dowabr','dowmay','dowjun','dowjul','dowago','dowsep','dowoct','downov','dowdic']));
    }
}
