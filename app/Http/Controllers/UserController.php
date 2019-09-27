<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
   public function index(){
      $idusuario =  auth()->user()->id;
      $usuario =  DB::table('users')->where('id', $idusuario)->first();
      return view('backend.paginas.EditarUsuario',compact('usuario'));
   }
     
   public function update(Request $request) {

      if(!empty($request->password)) {
         // reglas
         $rules = array(
            'nombre' => 'required|max:150',
            'apellido' => 'required|max:150',
            'usuario' => 'required|max:45',
            'tel' => 'required|max:45',
            'dui' => 'required|max:45',
            'password' => 'required'
            ); 
         
            
         $messages = array(
            'nombre.max' => '150 caracteres máximo para el nombre',
            'nombre.required' => 'Nombre es requerido',  
            'apellido.max' => '150 caracteres máximo para el apellido', 
            'apellido.required' => 'Apellido requerido',  
            'usuario.max' => '45 caracteres máximo para el usuario', 
            'usuario.required' => 'Usuario requerido',  
            'tel.max' => '45 caracteres máximo para el telefono',  
            'tel.required' => 'Telefono requerido',  
            'dui.max' => '45 caracteres máximo para el dui',
            'dui.required' => 'Telefono Requerido',
             'password.required' => 'Clave requerida'
            ); 
        
        $validator = Validator::make($request->all(), $rules, $messages );

        if ( $validator->fails() ) 
        {
            return [
                'success' => 0, 
                'message' => $validator->errors()->all()
            ];
        }  

        $user = User::findOrFail($request->id);

            $user->nombre = $request->nombre;
            $user->apellido = $request->apellido;
            $user->usuario = $request->usuario;
            $user->telefono = $request->tel;
            $user->dui = $request->dui;
            $user->password = bcrypt($request->password);
         
            if($user->save()){
                  return ['message' => 'Datos guardados'];
            } else {
               return [
                  'message' => 'Error al actualizar'
                     ];
            }
                
            } else {
					
               $rules = array(
                  'nombre' => 'required|max:150',
                  'apellido' => 'required|max:150',
                  'usuario' => 'required|max:45',
                  'tel' => 'required|max:45',
                  'dui' => 'required|max:45'
                  ); 
              
			// mensajes para cada regla
         $messages = array(
            'nombre.max' => '150 caracteres máximo para el nombre',
            'nombre.required' => 'Nombre es requerido',  
            'apellido.max' => '150 caracteres máximo para el apellido', 
            'apellido.required' => 'Apellido requerido',  
            'usuario.max' => '45 caracteres máximo para el usuario', 
            'usuario.required' => 'Usuario requerido',  
            'tel.max' => '45 caracteres máximo para el telefono',  
            'tel.required' => 'Telefono requerido',  
            'dui.max' => '45 caracteres máximo para el dui',
            'dui.required' => 'Telefono Requerido'
            ); 
         
			// validar
			$validator = Validator::make($request->all(), $rules, $messages );

				if ( $validator->fails() ) 
				{
					return [
						'success' => 0, 
						'message' => $validator->errors()->all()
					];
				}  
				$user = User::findOrFail($request->id);
				$user->nombre = $request->nombre;
				$user->apellido = $request->apellido;
				$user->usuario = $request->usuario;
				$user->telefono = $request->tel;
				$user->dui = $request->dui;

               if($user->save()){
        
                return [
                  'message' => 'Datos guardados'
              ];
            }else{
               return [
                  'message' => 'Error al actualizar'
                ];
              }
            }
     }
     public function destroy($id) {
        echo 'destroy';
     }
}
