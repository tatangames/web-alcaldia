<?php

namespace App\Http\Controllers\Auth;
use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // controlador para inicio de sesion administrador

    // unico metodo usable sin hacer login es: loginForm
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'loginForm']);
    }

    // retorna vista login administrador
    public function loginForm(){
        return view('auth.admin-login');
    }

    // para iniciar sesion administrador
    public function login(Request $request){

        // reglas
        $rules = array(
            'usuario' => 'required|max:45',
            'password' => 'required|max:100'            
        );  

        // mensajes para cada regla
        $messages = array(
            'usuario.required' => 'El usuario es requerido.',
            'usuario.max' => '45 caracteres máximo para el usuario',
            'password.required' => 'Contraseña es requerida',
            'password.max' => '100 caracteres máximo para la contraseña',            
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

        // verificar si existe el usuario
        if(User::where('usuario', $request->usuario)->first()){
            // validacion de usuario y contrasena
            if (Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password])) {     
                if (Auth::check()) {
                return [
                   'success'=> 1,           
                   'message'=> route('admin.dashboard')
                    ];
                }
            }else{
                return [
                    'success' => 2, 
                    'message' => 'Los datos ingresados son incorrectos'
                ];
            }
        }else{
            return [
                'success' => 3, 
                'message' => 'Usuario no encontrado'
            ];
        }
    }
    
    public function logout (Request $request){
        Auth::logout();
        return redirect("/admin");
    }

}
