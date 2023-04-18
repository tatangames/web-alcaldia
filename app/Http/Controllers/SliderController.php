<?php

namespace App\Http\Controllers;

use App\Fotografia;
use App\Noticia;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{

    // retornar vista 
    public function index(){
        return view('backend.paginas.ListarSlider');
    }

    // retornar vista tabla con los datos
    public function getSliderTabla(){        
        $slider = Slider::all()->sortBy('posicion');
        return view('backend.paginas.tablas.tablaSlider',compact('slider'));
    }

    // obtener informacion del slider para actualizarla
    public function infoSlider(Request $request){
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

            if($datos = Slider::where('idslider', $request->id)->first()){
                return [
                    'success' => 1,
                    'slider' => $datos
                ];
            }else{
                return [
                    'success' => 2 // slider no encontrado                   
                ];
            }
        }
    }

    // eliminar un slider
    public function eliminarSlider(Request $request){
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

            if($datos = Slider::where('idslider', $request->id)->first()){
                
                // borrar slider
                Slider::where('idslider', $request->id)->delete();
                // borrar imagen 

                if(Storage::disk('slider')->exists($datos->fotografia)){
                    Storage::disk('slider')->delete($datos->fotografia);                                
                }
                
                return [
                    'success' => 1 // slider eliminado              
                ];
            }else{
                return [
                    'success' => 2 // slider no encontrado                   
                ];
            }
        }
    }

    // editar un slider
    public function editarSlider(Request $request){

        if($request->isMethod('post')){  

            $regla = array( 
                'idslider' => 'required',
                'descripcion' => 'max:100',
                'posicion' => 'required',
                'link' => 'max:500',
            );    

            $mensaje = array(
                'idslider.required' => 'ID es requerida',
                'descripcion.max' => 'Maximo 100 caracteres',
                'posicion.required' => 'Posicion es requerida',
                'descripcion.max' => 'Maximo 100 caracteres',               
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 

            // validar solamente si mando la imagen
            if($request->hasFile('imagen')){                

                // validaciones para los datos
                $regla2 = array( 
                    'imagen' => 'required|image|mimes:jpeg,jpg', 
                );    
         
                $mensaje2 = array(
                    'imagen.required' => 'La imagen es requerida',
                    'imagen.image' => 'El archivo debe ser una imagen',
                    'imagen.mimes' => 'Formato validos .jpg, .jpeg',
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

            // encontrar slider a modificar
            if($slider = Slider::where('idslider', $request->idslider)->first()){                        

                if($request->hasFile('imagen')){ // editara slider y su imagen   

                    $cadena = Str::random(15);
                    $tiempo = microtime(); 
                    $union = $cadena.$tiempo;
                    // quitar espacios vacios
                    $nombre = str_replace(' ', '_', $union);
                    
                    // guardar imagen en disco
                    $extension = '.'.$request->imagen->getClientOriginalExtension();
                    $nombreFoto = $nombre.$extension;
                    $avatar = $request->file('imagen'); 
                    $upload = Storage::disk('slider')->put($nombreFoto, \File::get($avatar)); 
             
                    if($upload){
                        $imagenOld = $slider->fotografia; //nombre de imagen a borrar
                        
                        Slider::where('idslider', '=', $request->idslider)->update(['nombreslider' => $request->descripcion, 
                        'posicion' => $request->posicion, 'fotografia' => $nombreFoto]);
                            
                        if(Storage::disk('slider')->exists($imagenOld)){
                            Storage::disk('slider')->delete($imagenOld);                                
                        }

                        return [
                        'success' => 1 // datos guardados correctamente
                        ];                       
                          
                    }else{
                        return [
                            'success' => 3 // imagen no se subio
                        ];
                    }
                }else{ // guardar solo datos
                Slider::where('idslider', '=', $request->idslider)->update([
                    'nombreslider' => $request->descripcion,
                    'posicion' => $request->posicion,
                    'link' => $request->link
                    ]);
                return [
                   'success' => 1 // datos guardados correctamente
                ];
                    
                }
            }else{
                return [
                    'success' => 4 //slider no encontrado
                ];
            }
        }
    }
    
    // agregar nuevo slider
    public function nuevoSlider(Request $request){ 
        if($request->isMethod('post')){  

            $regla = array( 
                'descripcion' => 'max:100',
                'link' => 'max:500', 
            );    

            $mensaje = array(
                'descripcion.max' => 'Maximo 100 caracteres',
                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .jpg, .jpeg',
                'link.max' => 'Maximo 500 caracteres',
                );

            $validar = Validator::make($request->all(), $regla, $mensaje );

            if ($validar->fails()) 
            {
                return [
                    'success' => 0, 
                    'message' => $validar->errors()->all()
                ];
            } 
            // generar nombre para la imagen
            $cadena = Str::random(15);
            $tiempo = microtime(); 
            $union = $cadena.$tiempo;
            // quitar espacios vacios
            $nombre = str_replace(' ', '_', $union);
           
            // guardar imagen en disco, solo podra ser accedida por aplicacion, no por navegador
            $extension = '.'.$request->imagen->getClientOriginalExtension();
            $nombreFoto = $nombre.$extension;
            $avatar = $request->file('imagen'); 
            $upload = Storage::disk('slider')->put($nombreFoto, \File::get($avatar)); 
            
            
            if($upload){

                // conocer si ya existe un slider para obtener o no, la ultima posicion
                $conteo = Slider::count();
                $posicion = 1;

                if($conteo >= 1){
                    // ya existe un slider, obtener ultima posicion
                    $registro = Slider::orderBy('idslider', 'DESC')->first();
                    $posicion = $registro->posicion;
                    $posicion++;
                }
                
                $slider = new Slider();
                $slider->nombreslider = $request->descripcion;
                $slider->estado = '1';
                $slider->posicion = $posicion;
                $slider->fotografia = $nombreFoto;
                $slider->link = $request->link;
                if($slider->save()){
                    return [
                        'success' => 1 // slider agregado
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


}