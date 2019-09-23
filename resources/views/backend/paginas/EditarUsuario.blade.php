@extends('backend.menus.indexSuperior')
 
@section('content-admin-css')
  <!-- Toastr -->
	<link href="{{ asset('plugins/toastr/toastr.min.css') }}" type="text/css" rel="stylesheet" /> 
@stop
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Editar Usuario</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form class="form-horizontal" id="form1">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Formulario de datos de Usuario</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
              <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{ $usuario->nombre }}">
                        <input type="hidden" name="id" id="id" class="form-control" value="{{ $usuario->id  }}">
                      </div>
                <!-- /.form-group -->
                <div class="form-group">
                        <label>Usuario:</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Apellido" value="{{ $usuario->usuario }}">
                      </div>
                <!-- /.form-group -->
              
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña:</label>
                    <input type="password" name="password2" id="password2" class="form-control"  value="">
                  </div>
                <!-- /.form-group -->    
                <div class="form-group">
                    <label for="exampleInputPassword1">Repetir Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control"  value="">
                  </div>
                <!-- /.form-group -->  
              </div>
              <!-- /.col -->
              <div class="col-md-6">
              <div class="form-group">
                        <label>Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" value="{{ $usuario->apellido  }}">
                      </div>
                <!-- /.form-group -->
                <div class="form-group">
                        <label>Tel.:</label>
                        <input type="number" name= "telefono" id="telefono" class="form-control" placeholder="Tel." value="{{ $usuario->telefono  }}">
                      </div>
                <!-- /.form-group -->
                <div class="form-group">
                    <label for="dui">DUI:</label>
                    <input type="text" name="dui" id="dui" class="form-control" placeholder="Numero de DUI" value="{{ $usuario->dui }}">
                </div>
                <!-- /.form-group --> 
              </div>
            <!-- /.col -->
            </div>
          <!-- /.row -->
          </div>
         <!-- /.card-body -->
         <div class="card-footer">
                  <button type="button" class="btn btn-info float-right" onclick="actualizarUsuario();">Actualizar</button>
                  <button type="button" onclick="location.href='{{ url('/admin/inicio') }}'" class="btn btn-default">Cancelar</button>
                </div>
                <!-- /.card-footer -->
         </div>
      <!-- /.card -->
      </form>
      <!-- /form -->
      </div>
    <!-- /.container-fluid -->
    </section>

	
@extends('backend.menus.indexInferior')

@section('content-admin-js')	
<!-- axios -->
<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
<script>
    function actualizarUsuario(){
      var nombre = document.getElementById('nombre').value; 
      var apellido = document.getElementById('apellido').value; 
      var usuario = document.getElementById('usuario').value; 
      var tel = document.getElementById('telefono').value; 
      var dui = document.getElementById('dui').value;
      var id = document.getElementById('id').value;
     var pass = document.getElementById('password').value;
      var pass2 = document.getElementById('password2').value; 

      let formData = new FormData();
                formData.append('nombre', nombre);
                formData.append('apellido', apellido);
                formData.append('usuario', usuario);
                formData.append('tel', tel);
                formData.append('dui', dui);
                formData.append('id', id);

                var retorno = verificar(pass, pass2);
      // GUARDAR DATOS + CONTRASENA
      if(retorno){
                formData.append('password', pass);  
                
            axios.post('/admin/actualizar-usuario', formData)
                      .then(function (response) {
                        toastr.success(response.data.message);
                        })
                      .catch(function (error) {
                        toastr.error(response.data.message);
                      }); 
                  }
      }
    function verificar(pass, pass2){
         // contrasena no coincide
                if(pass !== pass2){
                    toastr.error("Contraseña no coincide...");
                    return false;
                }else{                  
                   return true;
                }    
    }
</script>

@stop
