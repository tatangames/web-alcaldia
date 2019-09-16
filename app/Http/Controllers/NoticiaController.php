<?php

namespace App\Http\Controllers;

use App\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function nuevaNoticia(Request $request){

        if($request->isMethod('post')){  
           
            $regla = array( 
                'nombre' => 'required|max:450',   

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

            
            $imagen = $request->file('imagen');

            foreach($imagen as $img){

                // generar nombre para la imagen
                $cadena = Str::random(15);
                $tiempo = microtime(); 
                $union = $cadena.$tiempo;       
                $nombre = str_replace(' ', '_', $union);

                // guardar imagen en disco
                $extension = '.'.$request->imagen->getClientOriginalExtension();
                $nombreFoto = $nombre;
                //$avatar = $request->file('imagen'); 
                //$upload = Storage::disk('programa')->put($nombreFoto, \File::get($avatar)); 
        
               

                    //$image       = $request->file('image');
                    $filename    = $img->getClientOriginalName();
                
                    $image_resize = Image::make($img->getRealPath());              
                    $image_resize->resize(300, 300);
                    //$image_resize->save(public_path('images/' .$filename));
                    //$image_resize->Storage::disk('programa')->put($nombr, \File::get($avatar));
                              //    save(public_path('images/' .$filename));
               

            }

            return 'ok';
           
    
          /* if($upload){
               
               $noticia = new Noticia();
               $noticia->nombrenoticia = $request->nombre;              
               $noticia->fecha = '2019-09-12';
               $noticia->descorta = $request->descorta;
               $noticia->deslarga = $request->deslarga;

               if($noticia->save()){
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
           }*/
        }


    }
}
