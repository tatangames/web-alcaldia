<?php

namespace App\Http\Controllers;

use App\Programa;
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
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'nombre.required' => 'Nombre programa es requerio',
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
           $upload = Storage::disk('programa')->put($nombreFoto, \File::get($avatar)); 
    
           if($upload){
               
               $programa = new Programa();
               $programa->nombreprograma = $request->nombre;              
               $programa->logo = $nombreFoto;
               $programa->descorta = $request->descorta;
               $programa->deslarga = $request->deslarga;

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
                'nombre' => 'required|max:450',                
                'descorta' => 'required',
                'deslarga' => 'required',
            );    

            $mensaje = array(
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

            // encontrar programa a modificar
            if($programa = Programa::where('idprograma', $request->idprograma)->first()){                        

                if($request->hasFile('imagen')){ // editara programa y su imagen   

                    $cadena = Str::random(15);
                    $tiempo = microtime(); 
                    $union = $cadena.$tiempo;
                    // quitar espacios vacios
                    $nombre = str_replace(' ', '_', $union);
                    
                    // guardar imagen en disco
                    $extension = '.'.$request->imagen->getClientOriginalExtension();
                    $nombreFoto = $nombre.$extension;
                    $avatar = $request->file('imagen'); 
                    $upload = Storage::disk('programa')->put($nombreFoto, \File::get($avatar)); 
             
                    if($upload){
                        $imagenOld = $programa->logo; //nombre de imagen a borrar
                        
                        Programa::where('idprograma', '=', $request->idprograma)->update(['nombreprograma' => $request->nombre, 
                        'logo' => $nombreFoto, 'descorta' => $request->descorta, 'deslarga' => $request->deslarga]);
                            
                        if(Storage::disk('programa')->exists($imagenOld)){
                            Storage::disk('programa')->delete($imagenOld);                                
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
                
                    Programa::where('idprograma', '=', $request->idprograma)->update(['nombreprograma' => $request->nombre,
                    'descorta' => $request->descorta, 'deslarga' => $request->deslarga]);
                    
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

}
