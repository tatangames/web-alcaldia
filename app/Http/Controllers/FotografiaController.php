<?php

namespace App\Http\Controllers;

use App\Fotografia;
use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class FotografiaController extends Controller
{

    // obtener vista para ver lista de fotografias por id
    public function getFotografiaVista($idfoto)
    {
        $fotografia = Fotografia::where('noticia_id', $idfoto)->get();
        return view('backend.paginas.ListarFotografia', compact('idfoto'));
    }

    // obtener vista de tabla para ver fotografias
    public function getFotografiaTabla($idfoto)
    {
        $fotografia = Fotografia::where('noticia_id', $idfoto)->get();
        return view('backend.paginas.tablas.tablaFotografia', compact('fotografia'));
    }

    // agregar 1 o mas fotografias 
    public function nuevaFotografia(Request $request){
        if($request->isMethod('post')){

            $regla = array( 
                'id' => 'required',
                'imagen' => 'required',
                'imagen.*' => 'image|mimes:jpg,jpeg',
            );

            $mensaje = array(
                'id.required' => 'ID es requerido',
                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .jpeg .jpg',
                'imagen.*.required' => 'Array de imagenes requeridos',
                'imagen.*.mimes' => 'Array de imagenes formato valido .jpg .jpeg',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            foreach ($request->file('imagen') as $img) {
                $cadena = Str::random(15);
                $tiempo = microtime();
                $union = $cadena.$tiempo;
                $nombre = str_replace(' ', '_', $union);
                
                $ancho = Image::make($img)->width(); //obtener ancho de cada imagen

                $extension = '.'.$img->getClientOriginalExtension();
                $nombreFoto = $nombre.$extension;

                if ($img->getSize() <= 1000000 || $ancho <= 1280) {
                    Storage::disk('noticia')->put($nombreFoto, \File::get($img));
                } else {
                    $image = Image::make($img)->resize(1280, 900);
                    Storage::disk('noticia')->put($nombreFoto, (string) $image->encode());
                }
                
                // insertar nombre fotografia
                Fotografia::create(['noticia_id'=>$request->id,
                                    'nombrefotografia'=>$nombreFoto]);
            }

            return [
                'success' => 1
            ];
        }
    }

    // eliminar fotografia por id
    public function eliminarFotografia(Request $request)
    {
        if ($request->isMethod('post')) {
            $regla = array(
                'id' => 'required'
            );

            $mensaje = array(
                'id.required' => 'ID es requerida',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje);

            if ($validar->fails()) {
                return [
                    'success' => 0,
                    'message' => $validar->errors()->all()
                ];
            }

            if ($dato = Fotografia::where('idfotografia', $request->id)->first()) {
                if (Storage::disk('noticia')->exists($dato->nombrefotografia)) {
                    Storage::disk('noticia')->delete($dato->nombrefotografia);
                }
    
                Fotografia::where('idfotografia', $request->id)->delete();
                
                return [
                    'success' => 1,
                ];
            } else {
                return [
                    'success' => 2,
                ];
            }
        }
    }
}