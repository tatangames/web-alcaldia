<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Servicio;

class ServiciosController extends Controller
{
    // retornar vista 
    public function index(){
        return view('backend.paginas.ListarServicio');
    }

    // retornar vista tabla con los datos
    public function getServicioTabla(){        
        $servicio = Servicio::all();

        return view('backend.paginas.tablas.tablaServicio',compact('servicio'));
    }

    // agregar nuevo Servicio
    public function nuevoServicio(Request $request){ 
        if($request->isMethod('post')){  
           
            $regla = array( 
                'nombre' => 'required|max:450',                
                'imagen' => 'required|image|mimes:png', 
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'nombre.required' => 'Nombre servicio es requerio',
                'nombre.max' => 'Maximo 450 caracteres',
                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .png',
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

            
           // generar nombre para la imagen
           $cadena = Str::random(15);
           $tiempo = microtime(); 
           $union = $cadena.$tiempo;
           // quitar espacios vacios
           $nombre = str_replace(' ', '_', $union);
           
           // guardar imagen en disco
           $extension = '.'.$request->imagen->getClientOriginalExtension();
           $nombreFoto = $nombre.$extension;
           $avatar = $request->file('imagen'); 
           $upload = Storage::disk('servicio')->put($nombreFoto, \File::get($avatar)); 
    
           if($upload){
               
               $servicio = new Servicio();
               $servicio->nombreservicio = $request->nombre;              
               $servicio->logo = $nombreFoto;
               $servicio->descorta = $request->descorta;
               $servicio->deslarga = $request->deslarga;

               if($servicio->save()){
                   return [
                       'success' => 1 // servicio agregado
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

     // obtener informacion del servicio para actualizarla
     public function infoServicio(Request $request){
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

            if($datos = Servicio::where('idservicio', $request->id)->first()){
                return [
                    'success' => 1,
                    'servicio' => $datos
                ];
            }else{
                return [
                    'success' => 2 // servicio no encontrado                   
                ];
            }
        }
    }
     // editar un servicio
    public function editarServicio(Request $request){

        if($request->isMethod('post')){  

            $regla = array( 
                'nombre' => 'required|max:450',                
                'descorta' => 'required',
                'deslarga' => 'required',
            );    

            $mensaje = array(
                'nombre.required' => 'Nombre de servicio es requerio',
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

            // validar solamente si mando la imagen
            if($request->hasFile('imagen')){                

                // validaciones para los datos
                $regla2 = array( 
                    'imagen' => 'required|image|mimes:png', 
                );    
         
                $mensaje2 = array(
                    'imagen.required' => 'La imagen es requerida',
                    'imagen.image' => 'El archivo debe ser una imagen',
                    'imagen.mimes' => 'Formato validos .png',
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

            // encontrar servicio a modificar
            if($servicio = Servicio::where('idservicio', $request->idservicio)->first()){                        

                if($request->hasFile('imagen')){ // editara servicio y su imagen   

                    $cadena = Str::random(15);
                    $tiempo = microtime(); 
                    $union = $cadena.$tiempo;
                    // quitar espacios vacios
                    $nombre = str_replace(' ', '_', $union);
                    
                    // guardar imagen en disco
                    $extension = '.'.$request->imagen->getClientOriginalExtension();
                    $nombreFoto = $nombre.$extension;
                    $avatar = $request->file('imagen'); 
                    $upload = Storage::disk('servicio')->put($nombreFoto, \File::get($avatar)); 
             
                    if($upload){
                        $imagenOld = $servicio->logo; //nombre de imagen a borrar
                        
                        Servicio::where('idservicio', '=', $request->idservicio)->update(['nombreservicio' => $request->nombre, 
                        'logo' => $nombreFoto, 'descorta' => $request->descorta, 'deslarga' => $request->deslarga]);
                            
                        if(Storage::disk('servicio')->exists($imagenOld)){
                            Storage::disk('servicio')->delete($imagenOld);                                
                        }

                        return [
                        'success' => 1 // datos guardados correctamente
                        ];
                            
                    }else{
                        return [
                            'success' => 2 // imagen no se subio
                        ];
                    }
                }else{ // guardar solo datos
                
                    Servicio::where('idservicio', '=', $request->idservicio)->update(['nombreservicio' => $request->nombre,
                    'descorta' => $request->descorta, 'deslarga' => $request->deslarga]);
                    
                    return [
                        'success' => 1 // datos guardados correctamente
                    ];                    
                }
            }else{
                return [
                    'success' => 3 //servicio no encontrado
                ];
            }
        }
    }

    // eliminar un servicio
    public function eliminarServicio(Request $request){
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

            if($datos = Servicio::where('idservicio', $request->id)->first()){
                
                // borrar servicio
                Servicio::where('idservicio', $request->id)->delete();
                // borrar imagen 

                if(Storage::disk('servicio')->exists($datos->logo)){
                    Storage::disk('servicio')->delete($datos->logo);                                
                }
                
                return [
                    'success' => 1 // servicio eliminado              
                ];
            }else{
                return [
                    'success' => 2 // servicio no encontrado                   
                ];
            }
        }
    }
}
