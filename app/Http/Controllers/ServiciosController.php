<?php

namespace App\Http\Controllers;

use App\Compras;
use App\Documento;
use App\Finanzas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
                'slide' => 'required|image|mimes:jpeg',
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'nombre.required' => 'Nombre servicio es requerio',
                'nombre.max' => 'Maximo 450 caracteres',
                'imagen.required' => 'La imagen es requerida',
                'imagen.image' => 'El archivo debe ser una imagen',
                'imagen.mimes' => 'Formato validos .png',
                'slide.image' => 'El archivo debe ser una imagen',
                'slide.mimes' => 'Formato validos .jpeg',
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

            if ($request->hasFile('documento')) {

                // validacion si manda el documento pdf
                $regla2 = array(
                    'documento' => 'required',
                    'documento.*' => 'required|mimes:pdf',
                );

                $mensaje2 = array(
                    'documento.required' => 'El documento es requerido',
                    'documento.mimes' => 'Formato validos .pdf',
                    'documento.*.required' => 'Array de documentos requeridos',
                    'documento.*.mimes' => 'Array de documento permitido es .PDF',
                    );

                $validar2 = Validator::make($request->all(), $regla2, $mensaje2);

                if ($validar2->fails())
                {
                    return [
                        'success' => 0,
                        'message' => $validar2->errors()->all()
                    ];
                }
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
           $upload2 = Storage::disk('servicio')->put($nombreSlide, \File::get($avatar2));
           $upload = Storage::disk('servicio')->put($nombreFoto, \File::get($avatar));

           $slug = Str::slug($request->nombre, '-');

           if(Servicio::where('slug', $slug)->first()){
                return [
                    'success' => 4,
                    'message' => 'El slug del servicio ya existe'
                ];
           }

           $idservicio = Servicio::insertGetId([
            'nombreservicio'=>$request->nombre,
            'logo'=>$nombreFoto,
            'imagen'=>$nombreSlide,
            'descorta'=>$request->descorta,
            'deslarga'=>$request->deslarga,
            'slug' => $slug ]);

           // subir documentos si envio
           if($request->file('documento')){
                foreach($request->file('documento') as $img){

                    $cadena = Str::random(15);
                    $tiempo = microtime();
                    $union = $cadena.$tiempo;
                    $nombre = str_replace(' ', '_', $union);

                    $extension = '.'.$img->getClientOriginalExtension();
                    $nombrePDF = $idservicio.'_'.$img->getClientOriginalName();
                    $nombreUrl = $nombre.$extension;

                    Storage::disk('servicio')->put($nombreUrl, \File::get($img));

                    Documento::create(['servicio_id'=>$idservicio,
                    'nombre'=>$nombrePDF, 'url'=> $nombreUrl]);
               }
            }

           if($upload && $upload2){

                return [
                    'success' => 1 // servicio agregado
                ];

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
                'idservicio' => 'required',
                'nombre' => 'required|max:450',
                'descorta' => 'required',
                'deslarga' => 'required',
            );

            $mensaje = array(
                'idservicio.required' => 'ID es requerido',
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
            if($request->hasFile('slide')){

                // validaciones para los datos
                $regla3 = array(
                    'slide' => 'required|image|mimes:jpeg',
                );

                $mensaje3 = array(
                    'slide.required' => 'La imagen es requerida',
                    'slide.image' => 'El archivo debe ser una imagen',
                    'slide.mimes' => 'Formato validos .jpg',
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

            if(Servicio::where('slug', $slug)->where('idservicio', '!=', $request->idservicio)->first()){
                 return [
                     'success' => 4,
                     'message' => 'El slug del servicio ya existe'
                 ];
            }

            // encontrar servicio a modificar
            if($servicio = Servicio::where('idservicio', $request->idservicio)->first()){
                $cadena = Str::random(15);
                $tiempo = microtime();
                $union = $cadena.$tiempo;
                // quitar espacios vacios
                $nombre = str_replace(' ', '_', $union);

                $imagenOld = $servicio->logo;
                $slideOld = $servicio->imagen;

                $array = ['nombreservicio' => $request->nombre,
                          'descorta' => $request->descorta,
                          'deslarga' => $request->deslarga,
                          'slug' => $slug];

            if($request->hasFile('imagen')){ // editara servicio y su imagen
                // guardar imagen en disco
                $extension = '.'.$request->imagen->getClientOriginalExtension();
                $nombreFoto = $nombre.$extension;
                $avatar = $request->file('imagen');
                $upload = Storage::disk('servicio')->put($nombreFoto, \File::get($avatar));

                if($upload){
                    if(Storage::disk('servicio')->exists($imagenOld)){
                        Storage::disk('servicio')->delete($imagenOld);
                    }
                    $array['logo'] = $nombreFoto;
                }else{
                    return [
                        'success' => 2 // imagen no se subio al servidor
                    ];
                }
            }
            if($request->hasFile('slide')){ // editara servicio y su imagen
                // guardar imagen en disco
                $extensionSlide = '.'.$request->slide->getClientOriginalExtension();
                $nombreSlide = $nombre.'slide'.$extensionSlide;
                $avatarSlide = $request->file('slide');
                $uploadSlide = Storage::disk('servicio')->put($nombreSlide, \File::get($avatarSlide));

                if($uploadSlide){

                    if(Storage::disk('servicio')->exists($slideOld)){
                        Storage::disk('servicio')->delete($slideOld);
                    }
                    $array['imagen'] = $nombreSlide;
                }else{
                    return [
                        'success' => 2 // Slide no se subio al servidor
                    ];
                }
            }

                if(Servicio::where('idservicio', '=', $request->idservicio)->update($array)){
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


                // borrar documentos
                $ruta = Documento::where('servicio_id', $request->id)->get();

                foreach($ruta as $dato){

                    if(Storage::disk('servicio')->exists($dato->url)){
                        Storage::disk('servicio')->delete($dato->url);
                    }
                }

                // eliminar documentos foraneas
                Documento::where('servicio_id', $request->id)->delete();

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






    //*********** FINANZAS **********************


    public function indexVistaFinanzas(){

        return view('backend.paginas.finanzas.vistafinanzas');
    }


    public function tablaVistaFinanzas(){

        $listado = Finanzas::orderBy('fecha')->get();

        foreach ($listado as $dato){

            $dato->fecha = date("d-m-Y", strtotime($dato->fecha));
        }

        return view('backend.paginas.finanzas.tablafinanzas', compact('listado'));
    }


    public function nuevoRegistroFinanzas(Request $request){

        $regla = array(
            'titulo' => 'required',
            'fecha' => 'required',
        );

        $mensaje = array(
            'titulo.required' => 'Título es requerido',
            'fecha.required' => 'Fecha es requerida'
        );

        $validar = Validator::make($request->all(), $regla, $mensaje);

        if ($validar->fails()){ return ['success' => 0]; }


        $cadena = Str::random(15);
        $tiempo = microtime();
        $union = $cadena . $tiempo;
        $nombre = str_replace(' ', '_', $union);

        $extension = '.' . $request->documento->getClientOriginalExtension();
        $nomDocumento = $nombre . strtolower($extension);
        $avatar = $request->file('documento');
        $archivo = Storage::disk('slider')->put($nomDocumento, \File::get($avatar));


        if ($archivo) {

            DB::beginTransaction();

            try {

            $dato = new Finanzas();
            $dato->titulo = $request->titulo;
            $dato->descripcion = $request->descripcion;
            $dato->fecha = $request->fecha;
            $dato->documento = $nomDocumento;
            $dato->save();


            DB::commit();
            return ['success' => 1];

            }catch(\Throwable $e){
                Log::info('error: ' . $e);
                DB::rollback();
                return ['success' => 2];
            }

        }
        else{
            // error al subir documento
            return ['success' => 2];
        }
    }



    public function borrarRegistroFinanzas(Request $request){
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0]; }

        if($infoFi = Finanzas::where('id', $request->id)->first()){

            $docu = $infoFi->documento;

            if(Storage::disk('slider')->exists($docu)){
                Storage::disk('slider')->delete($docu);
            }

            Finanzas::where('id', $request->id)->delete();


            return ['success' => 1];
        }

        return ['success' => 1];
    }


    public function indexVistaCompras(){

        return view('backend.paginas.compras.vistacompras');
    }


    public function tablaVistaCompras(){
        $listado = Compras::orderBy('fecha')->get();

        foreach ($listado as $dato){
            $dato->fechaFormat = date("d-m-Y", strtotime($dato->fecha));
        }

        return view('backend.paginas.compras.tablacompras', compact('listado'));
    }


    public function nuevoRegistroCompras(Request $request){

        $regla = array(
            'titulo' => 'required',
            'fecha' => 'required',
        );

        $mensaje = array(
            'titulo.required' => 'Título es requerido',
            'fecha.required' => 'Fecha es requerida'
        );

         // descripcion

        $validar = Validator::make($request->all(), $regla, $mensaje);

        if ($validar->fails()){ return ['success' => 0]; }


        $cadena = Str::random(15);
        $tiempo = microtime();
        $union = $cadena . $tiempo;
        $nombre = str_replace(' ', '_', $union);

        $extension = '.' . $request->documento->getClientOriginalExtension();
        $nomDocumento = $nombre . strtolower($extension);
        $avatar = $request->file('documento');
        $archivo = Storage::disk('slider')->put($nomDocumento, \File::get($avatar));


        if ($archivo) {

            DB::beginTransaction();

            try {

                $dato = new Compras();
                $dato->titulo = $request->titulo;
                $dato->descripcion = $request->descripcion;
                $dato->fecha = $request->fecha;
                $dato->documento = $nomDocumento;
                $dato->save();


                DB::commit();
                return ['success' => 1];

            }catch(\Throwable $e){
                Log::info('error: ' . $e);
                DB::rollback();
                return ['success' => 2];
            }

        }
        else{
            // error al subir documento
            return ['success' => 2];
        }
    }


    public function borrarRegistroCompras(Request $request){
        $regla = array(
            'id' => 'required',
        );

        $validar = Validator::make($request->all(), $regla);

        if ($validar->fails()){ return ['success' => 0]; }

        if($infoFi = Compras::where('id', $request->id)->first()){

            $docu = $infoFi->documento;

            if(Storage::disk('slider')->exists($docu)){
                Storage::disk('slider')->delete($docu);
            }

            Compras::where('id', $request->id)->delete();


            return ['success' => 1];
        }

        return ['success' => 1];
    }

}
