<?php

namespace App\Http\Controllers;

use App\Fotografia;
use App\Linkucp;
use App\Noticia;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
//para ver el archivo log nada mas por el error de los saltos de linea
use Log;

class NoticiaController extends Controller
{
    // retornar vista
    public function index(){
        return view('backend.paginas.ListarNoticia');
    }

    // retornar vista tabla con los datos
    public function getNoticiaTabla(){
        $noticia = Noticia::all();


        return view('backend.paginas.tablas.tablaNoticia',compact('noticia'));
    }

    // agregar nueva noticia
    public function nuevaNoticia(Request $request){

        if($request->isMethod('post')){

            $regla = array(
                'nombre' => 'required|max:450',
                'fecha' => 'required',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpg,jpeg',
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'nombre.required' => 'Nombre programa es requerio',
                'nombre.max' => 'Maximo 450 caracteres',

                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .jpeg .jpg',
                'imagen.*.required' => 'Array de imagenes requeridos',
                'imagen.*.mimes' => 'Array de imagenes formato valido .jpg .jpeg',
                'descorta.required' => 'Descripcion corta es requeria',
                'deslarga.required' => 'Descripcion larga es requeria',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails())
            {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            $slug = Str::slug($request->nombre, '-');

            if(Noticia::where('slug', $slug)->first()){
                 return [
                     'success' => 4,
                     'message' => 'El slug del servicio ya existe'
                 ];
            }

            $idnoticia = Noticia::insertGetId([
                  'nombrenoticia'=>$request->nombre,
                  'fecha'=>$request->fecha,
                  'descorta'=>$request->descorta,
                  'deslarga'=>$request->deslarga,
                  'slug' => $slug ]);

            foreach($request->file('imagen') as $img){

                $cadena = Str::random(15);
                $tiempo = microtime();
                $union = $cadena.$tiempo;
                $nombre = str_replace(' ', '_', $union);

                $ancho = Image::make($img)->width(); //obtener ancho de cada imagen

                $extension = '.'.$img->getClientOriginalExtension();
                $nombreFoto = $nombre.$extension;

                if($img->getSize() <= 1000000 || $ancho <= 1280){
                   Storage::disk('noticia')->put($nombreFoto, \File::get($img));
                }else{
                   $image = Image::make($img)->resize(1280, 900);
                   Storage::disk('noticia')->put($nombreFoto, (string) $image->encode());
                }

                // insertar nombre fotografia
                Fotografia::create(['noticia_id'=>$idnoticia,
                                    'nombrefotografia'=>$nombreFoto]);
            }

            return [
                'success' => 1
            ];
        }
    }

    // obtener datos de noticia para editar
    public function infoNoticia(Request $request){
        if($request->isMethod('post')){

            $regla = array(
                'id' => 'required'
            );

            $mensaje = array(
                'id.required' => 'ID es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails())
            {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            if($datos = Noticia::where('idnoticia', $request->id)->first()){
                return [
                    'success' => 1,
                    'noticia' => $datos
                ];
            }else{
                return [
                    'success' => 2 // noticia no encontrado
                ];
            }
        }
    }

    // editar la noticia
    public function editarNoticia(Request $request){

        if($request->isMethod('post')){
           //para ver el archivo log nada mas por el error de los saltos de linea
            //Log::info($request->all());
            $regla = array(
                'idnoticia' => 'required',
                'nombre' => 'required|max:450',
                'descorta' => 'required',
                'deslarga' => 'required',
                'fecha' => 'required',
            );

            $mensaje = array(
                'idnoticia.required' => 'ID es requerio',
                'nombre.required' => 'Nombre programa es requerio',
                'nombre.max' => 'Maximo 450 caracteres',
                'descorta.required' => 'Descripcion corta es requeria',
                'deslarga.required' => 'Descripcion larga es requeria',
                'fecha.required' => 'Fecha es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails())
            {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            $slug = Str::slug($request->nombre, '-');


            if(Noticia::where('slug', $slug)->where('idnoticia', '!=', $request->idnoticia)->first()){
                 return [
                     'success' => 4,
                     'message' => 'El slug del servicio ya existe'
                 ];
            }

            // encontrar noticia a modificar
            if(Noticia::where('idnoticia', $request->idnoticia)->first()){

                Noticia::where('idnoticia', '=', $request->idnoticia)->update(['nombrenoticia' => $request->nombre,
                'fecha'=> $request->fecha, 'descorta' => $request->descorta, 'deslarga' => $request->deslarga, 'slug' => $slug]);

                return [
                    'success' => 1 // datos guardados correctamente
                ];

            }else{
                return [
                    'success' => 2 // noticia no encontrado
                ];
            }
        }
    }

    // eliminar una noticia y todos los datos en tabla fotografia
    public function eliminarNoticia(Request $request){
        if($request->isMethod('post')){
            $regla = array(
                'id' => 'required'
            );

            $mensaje = array(
                'id.required' => 'ID es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails())
            {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            if(Noticia::where('idnoticia', $request->id)->first()){

                // borrar imagen
                $ruta = Fotografia::where('noticia_id', $request->id)->get();

                foreach($ruta as $dato){

                    if(Storage::disk('noticia')->exists($dato->nombrefotografia)){
                        Storage::disk('noticia')->delete($dato->nombrefotografia);
                    }
                }

                // borrar datos de tabla
                Fotografia::where('noticia_id', $request->id)->delete();

                // borrar noticia
                Noticia::where('idnoticia', $request->id)->delete();

                return [
                    'success' => 1 // noticia eliminado
                ];
            }else{
                return [
                    'success' => 2 // noticia no encontrado
                ];
            }
        }
    }


    public function indexUCP(){

        $info = Linkucp::where('id', 1)->first();

        return view('backend.paginas.ucp.vistaucp', compact('info'));
    }


    public function actualizarLinkUcp(Request $request){

        Linkucp::where('id', 1)->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'linkucp' => $request->linkurl,
            'activo' => $request->toggle
        ]);

        return ['success' => 1];
    }





    // ******************************************************************************










}
