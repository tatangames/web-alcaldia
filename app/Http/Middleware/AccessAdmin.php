<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AccessAdmin
{

    //ACCESO TIPO ADMINISTRADOR

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // si queremos iniciar con muchor roles es
        // if(Auth::user()->hasAnyRoles(['admin', 'author'])){

        // si queremos iniciar con un solo rol es
        //if(Auth::user()->hasAnyRole('admin')){

        // iniciara sesion de tipo admin
        //if(Auth::user()->hasAnyRole('admin')){ 
            return $next($request);
       // }

        // si no inicio sesion, rederigir a 
       // return redirect('home');
    }
}
