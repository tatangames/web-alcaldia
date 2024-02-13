<?php

namespace App\Http\Controllers;

use App\Compras;
use App\Finanzas;
use App\Linkucp;
use App\Programa;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    // agregar nuevo programa
    public function nuevoPrograma(Request $request){
        if($request->isMethod('post')){

            $regla = array(
                'nombre' => 'required|max:450',
                'imagen' => 'required|image|mimes:png',
                'slide' => 'required|image|mimes:jpeg',
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'nombre.required' => 'Nombre programa es requerio',
                'nombre.max' => 'Maximo 450 caracteres',
                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .png',
                'slide.image' => 'El archivo debe ser una imagen',
                'slide.mimes' => 'Formato validos .jpg',
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

            if(Programa::where('slug', $slug)->first()){
                return [
                    'success' => 4,
                    'message' => 'El slug del programa ya existe'
                ];
            }

           // generar nombre para la imagen
           $cadena = Str::random(15);
           $tiempo = microtime();
           $union = $cadena.$tiempo;
           // quitar espacios vacios
           $nombre = str_replace(' ', '_', $union);

           // guardar imagen en disco
           $extension = '.'.$request->imagen->getClientOriginalExtension();
           $extension2 = '.'.$request->slide->getClientOriginalExtension();
           $nombreFoto = $nombre.$extension;
           $nombreSlide = $nombre.'slide'.$extension2;
           $avatar = $request->file('imagen');
           $avatar2 = $request->file('slide');
           $upload = Storage::disk('programa')->put($nombreFoto, \File::get($avatar));
           $upload2 = Storage::disk('programa')->put($nombreSlide, \File::get($avatar2));

           if($upload && $upload2){

               $programa = new Programa();
               $programa->nombreprograma = $request->nombre;
               $programa->logo = $nombreFoto;
               $programa->imagen = $nombreSlide;
               $programa->descorta = $request->descorta;
               $programa->deslarga = $request->deslarga;
               $programa->slug = $slug;

               if($programa->save()){
                   return [
                       'success' => 1 // programa agregado
                   ];
               }else{
                   return [
                       'success' => 2 // no guardo los datos
                   ];
               }

           }else{
               return [
                   'success' => 3 // no subio imagen
               ];
           }
        }
    }

     // obtener informacion del programa para actualizarla
     public function infoPrograma(Request $request){
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

            if($datos = Programa::where('idprograma', $request->id)->first()){
                return [
                    'success' => 1,
                    'programa' => $datos
                ];
            }else{
                return [
                    'success' => 2 // programa no encontrado
                ];
            }
        }
    }

     // editar un programa
    public function editarPrograma(Request $request){

        if($request->isMethod('post')){

            $regla = array(
                'idprograma' => 'required',
                'nombre' => 'required|max:450',
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'idprograma.required' => 'Id es requerido',
                'nombre.required' => 'Nombre programa es requerio',
                'nombre.max' => 'Maximo 450 caracteres',
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
            // validar solamente si mando el slide
            if($request->hasFile('slide')){

                // validaciones para los datos
                $regla2 = array(
                    'slide' => 'required|image|mimes:jpeg',
                );

                $mensaje2 = array(
                    'slide.required' => 'La imagen es requerida',
                    'slide.image' => 'El archivo debe ser una imagen',
                    'slide.mimes' => 'Formato validos .jpg',
                    );

                $validar2 = Validator::make($request->all(), $regla2, $mensaje2 );

                if ( $validar2->fails())
                {
                    return [
                        'success' => 0,
                        'message' => $validar2->errors()->all()
                    ];
                }
            }
            // validar solamente si mando la imagen
            if($request->hasFile('imagen')){

                // validaciones para los datos
                $regla3 = array(
                    'imagen' => 'required|image|mimes:png',
                );

                $mensaje3 = array(
                    'imagen.required' => 'La imagen es requerida',
                    'imagen.image' => 'El archivo debe ser una imagen',
                    'imagen.mimes' => 'Formato validos .png',
                    );

                $validar3 = Validator::make($request->all(), $regla3, $mensaje3 );

                if ( $validar3->fails())
                {
                    return [
                        'success' => 0,
                        'message' => $validar3->errors()->all()
                    ];
                }
            }

            $slug = Str::slug($request->nombre, '-');

            if(Programa::where('slug', $slug)->where('idprograma', '!=', $request->idprograma)->first()){
                return [
                    'success' => 4,
                    'message' => 'El slug del programa ya existe'
                ];
            }

            // encontrar programa a modificar
            if($programa = Programa::where('idprograma', $request->idprograma)->first()){

                    $cadena = Str::random(15);
                    $tiempo = microtime();
                    $union = $cadena.$tiempo;
                    // quitar espacios vacios
                    $nombre = str_replace(' ', '_', $union);

                    $imagenOld = $programa->logo;
                    $slideOld = $programa->imagen;

                    $array = ['nombreprograma' => $request->nombre,
                              'descorta' => $request->descorta,
                              'deslarga' => $request->deslarga,
                              'slug' => $slug];

                if($request->hasFile('imagen')){ // editara programa y su imagen
                    // guardar imagen en disco
                    $extension = '.'.$request->imagen->getClientOriginalExtension();
                    $nombreFoto = $nombre.$extension;
                    $avatar = $request->file('imagen');
                    $upload = Storage::disk('programa')->put($nombreFoto, \File::get($avatar));

                    if($upload){
                        if(Storage::disk('programa')->exists($imagenOld)){
                            Storage::disk('programa')->delete($imagenOld);
                        }
                        $array['logo'] = $nombreFoto;
                    }else{
                        return [
                            'success' => 2 // imagen no se subio al servidor
                        ];
                    }
                }
                if($request->hasFile('slide')){ // editara programa y su imagen
                    // guardar imagen en disco
                    $extensionSlide = '.'.$request->slide->getClientOriginalExtension();
                    $nombreSlide = $nombre.'slide'.$extensionSlide;
                    $avatarSlide = $request->file('slide');
                    $uploadSlide = Storage::disk('programa')->put($nombreSlide, \File::get($avatarSlide));

                    if($uploadSlide){

                        if(Storage::disk('programa')->exists($slideOld)){
                            Storage::disk('programa')->delete($slideOld);
                        }
                        $array['imagen'] = $nombreSlide;
                    }else{
                        return [
                            'success' => 2 // Slide no se subio al servidor
                        ];
                    }
                }

                    if(Programa::where('idprograma', '=', $request->idprograma)->update($array)){
                        return [
                            'success' => 1 // datos guardados correctamente
                        ];
                    }
            }else{
                return [
                    'success' => 3 //programa no encontrado
                ];
            }
        }
    }

    // eliminar un programa
    public function eliminarPrograma(Request $request){
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

            if($datos = Programa::where('idprograma', $request->id)->first()){

                // borrar programa
                Programa::where('idprograma', $request->id)->delete();
                // borrar imagen

                if(Storage::disk('programa')->exists($datos->logo)){
                    Storage::disk('programa')->delete($datos->logo);
                }

                return [
                    'success' => 1 // programa eliminado
                ];
            }else{
                return [
                    'success' => 2 // programa no encontrado
                ];
            }
        }
    }


    public function informacionUCP(Request $request){

        $infoTabla = Linkucp::where('id', 1)->first();

        if($infoTabla->activo == 0){
            return ['success' => 1];
        }

       return ['success' => 2, 'titulo' => $infoTabla->titulo, 'descripcion' => $infoTabla->descripcion,
           'urllink' => $infoTabla->linkucp];
    }


    public function vistaFinanzas(){

        $serviciosMenu = Servicio::all()->sortByDesc('idservicio')->take(4);

        $finanzas = Finanzas::orderBy('fecha', 'DESC')->get();

        foreach($finanzas as $dato){
            $dato->fechaformato = date("d-m-Y", strtotime($dato->fecha));

            $dato->fechaanio = date("Y", strtotime($dato->fecha));

            //$pesoByte = Storage::disk('slider')->size($dato->documento);
            //$pesoEnMB = $pesoByte / 1024 / 1024;

            //$dato->peso = number_format((float)$pesoEnMB, 2, '.', ',');
        }

        return view('frontend.paginas.finanzas.vistafinanzas', compact('serviciosMenu', 'finanzas'));
    }


    // descarga de documento de finanzas
    public function descargarDocumentoFinanzas($id){

        $infoFinanza = Finanzas::where('id', $id)->first();

        $nombre = str_replace(' ', '_', $infoFinanza->titulo);

        $pathToFile = "storage/slider/" . $infoFinanza->documento;
        $extension = pathinfo(($pathToFile), PATHINFO_EXTENSION);
        $nombre = $nombre . "." . $extension;
        return response()->download($pathToFile, $nombre);
    }


    public function vistaCompras(){
        $serviciosMenu = Servicio::all()->sortByDesc('idservicio')->take(4);

        $arrayCompras = Compras::orderBy('fecha', 'ASC')->get();

        foreach ($arrayCompras as $dato){

            $dato->fechaFormat = date("d-m-Y", strtotime($dato->fecha));
            $dato->fechaAnio = date("Y", strtotime($dato->fecha));

        }

        return view('frontend.paginas.compras.vistacompras', compact('arrayCompras', 'serviciosMenu'));
    }



}
