<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    public function index(){
        return view('backend.paginas.EditarUsuario');
    }
     public function create() {
        echo 'create';
     }
     public function store(Request $request) {
        echo 'store';
     }
     public function show($id) {
        echo 'show';
     }
     public function edit($id) {
        echo 'edit';
     }
     public function update(Request $request) {
      if(!empty($request->password)) {
         // reglas
        $rules = array(
         'nombre' => 'max:150',
         'apellido' => 'max:150',
         'usuario' => 'max:45',
         'telefono' => 'max:45',
         'dui' => 'max:45'          
         ); 
      // mensajes para cada regla
        $messages = array(
         'nombre.max' => '150 caracteres máximo para el nombre',  
         'apellido.max' => '150 caracteres máximo para el apellido',  
         'usuario.max' => '45 caracteres máximo para el usuario',  
         'telefono.max' => '45 caracteres máximo para el telefono',  
         'dui.max' => '45 caracteres máximo para el dui'
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
                $user->password = bcrypt($request->password);
               
                if($user->save()){
                     return [
                    'message' => 'Datos guardados'
                         ];
					} else {
						return [
                    'message' => 'Error al actualizar'
								];
              }
                
            } else {
					 // reglas
				 $rules = array(
				 'nombre' => 'max:150',
				 'apellido' => 'max:150',
				 'usuario' => 'max:45',
				 'telefono' => 'max:45',
				 'dui' => 'max:45'           
							); 
			// mensajes para cada regla
			$messages = array(
			'nombre.max' => '150 caracteres máximo para el nombre',  
			'apellido.max' => '150 caracteres máximo para el apellido',  
			'usuario.max' => '45 caracteres máximo para el usuario',  
			'telefono.max' => '45 caracteres máximo para el telefono',  
			'dui.max' => '45 caracteres máximo para el dui'
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
