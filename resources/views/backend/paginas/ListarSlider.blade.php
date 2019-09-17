@extends('backend.menus.indexSuperior')
 
@section('content-admin-css')
    <!-- data table -->
    <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" /> 
    <!-- mensaje toast -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" type="text/css" rel="stylesheet" />

    

@stop

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
            <h1>Listar Slider</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
          <i class="fas fa-pencil-alt"></i>
            Nuevo Slider
        </button>
          </div>
        </div>
      </div>
    </section>
   
  <!-- seccion frame -->
  <section class="content">
      <div class="container-fluid">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Tabla de Slider</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
			    <div id="tablaDatatable"></div>
			  </div>
			  <!-- /.col-md-6 -->
			</div>
			<!-- /.row -->
		  </div>
		  <!-- /.card-body -->
		</div>
		<!-- /.card -->
	  </div>
	  <!-- /.container-fluid -->
	</section>
	<!-- /.section -->

  <!-- modal agregar nuevo slider -->
  <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo Slider</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <div class="modal-body">
            <form id="formulario">
                  <div class="form-group">
                      <label style="color:#191818">Descripción</label>
                      <br>
                      <input style="color:#191818" type="text" class="form-control" maxlength="100" id="descripcion" name="descripcion" placeholder="Descripción de imagen"/>
                  </div>                        
                  <div class="form-group">
                      <div>
                          <label>Imagen</label>
                      </div>
                      <br>
                        <div class="col-md-10">
                      <input type="file" style="color:#191818" id="imagen" name="imagen" accept="image/jpeg, image/jpg" />
                      </div>
                  </div>
            </form>
        </div>
          
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
          <button class="btn btn-primary" id="btnGuardar" type="button" onclick="guardarSlider()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>

   <!-- modal editar slider -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Slider</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <div class="modal-body">
            <form id="formularioU">
                  <div class="form-group">
                      <label style="color:#191818">Descripción</label>
                      <br>
                      <input type="hidden" id="idU"/> <!-- guardar id del slider -->
                      <input style="color:#191818" type="text" class="form-control" maxlength="100" id="descripcionU" name="descripcionU" placeholder="Descripción de imagen"/>
                  </div> 
                  
                  <div class="form-group">
                      <label style="color:#191818">posición</label>
                      <br>
                      <input type="number" value="1" id="posicionU" name="posicionU" min="1">
                  </div> 

                  <div class="form-group">
                      <div>
                          <label>Imagen</label>
                      </div>
                      <br>
                        <div class="col-md-10">
                      <input type="file" style="color:#191818" id="imagenU" name="imagenU" accept="image/jpeg, image/jpg" />
                      </div>
                  </div>
            </form>
        </div>
          
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
          <button class="btn btn-primary" id="btnGuardarU" type="button" onclick="actualizarSlider()">Guardar</button>
        </div>
      </div>      
    </div>        
  </div>

  <!-- modal eliminar -->
  <div class="modal fade" id="modalEliminar">
    <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Eliminar Slider</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
                <div class="modal-body">
                  <input type="hidden" id="idD"/> <!-- id del slider para borrarlo-->                           
                </div>
                <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
            <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarSlider()">Borrar</button>
        </div>
      </div>      
    </div>        
  </div>
	
@extends('backend.menus.indexInferior')

@section('content-admin-js')	

  <!-- data table -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/loading/loadingOverlay.js') }}" type="text/javascript"></script>
  
 <!-- incluir tabla --> 
  <script type="text/javascript">	
    $(document).ready(function(){
    
      var ruta = "{{ URL::to('admin/tablas/slider') }}";   
      $('#tablaDatatable').load(ruta);
    });
 </script>

  <!-- metodos -->
  <script>
  
    // abre modal para agregar slider
    function abrirModalAgregar(){
      document.getElementById("formulario").reset();              
      $('#modalAgregar').modal('show');    
    }

    // guardar nuevo slider
    function guardarSlider(){

      var descripcion = document.getElementById('descripcion').value;    
      var imagen = document.getElementById("imagen");

      var retorno = validacion(imagen);

      if(retorno){ 

        var spinHandle = loadingOverlay().activate();

        document.getElementById("btnGuardar").disabled = true;
              
        let formData = new FormData();
        formData.append('descripcion', descripcion);
        formData.append('imagen', imagen.files[0]);

        axios.post('/admin/agregar-slider', formData, {  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle);            
            document.getElementById("btnGuardar").disabled = false;             
<<<<<<< HEAD
           mensajeResponse(response);
=======
           
           console.log(response);
            mensajeResponse(response);
>>>>>>> 214487c2b1592abc67218815e406f8ba2ba61f20
          })
          .catch((error) => {
            document.getElementById("btnGuardar").disabled = false;  
            loadingOverlay().cancel(spinHandle); // cerrar loading   
            toastr.error('Error', 'Datos incorrectos!');               
          }); 
      }
    }

    // mensaje cuando guardamos slider
    function mensajeResponse(valor){
      if(valor.data.success == 1){
        toastr.success('Guardado', 'Se ha creado nuevo Slider!')
        $('#modalAgregar').modal('hide');             
        var ruta = "{{ URL::to('admin/tablas/slider') }}";   
        $('#tablaDatatable').load(ruta);
      }else if(valor.data.success == 3){
        toastr.error('Error', 'No se guardo la imagen!');
      }else{
        // error en validacion en servidor
        toastr.error('Error', 'Datos incorrectos!');
      }
    }

    // validacion si agregamos una imagen al agregar slider
    function validacion(imagen){
      if(imagen.files && imagen.files[0]){
        return true;   
      }else{
        toastr.error('Error', 'Agregar una imagen!');
        return false;
      }
    }

    // abre el modal para editar el slider
    function abrirModalEditar(id){
      document.getElementById("formularioU").reset();   
      spinHandle = loadingOverlay().activate();
      axios.post('/admin/informacion-slider',{
        'id': id  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); // cerrar loading
            if(response.data.success = 1){
            
              $('#modalEditar').modal('show');
              $('#idU').val(response.data.slider.idslider);
              $('#descripcionU').val(response.data.slider.nombreslider);
             
            }else{ // slider no encontrado
              toastr.error('Error', 'Slider no encontrado'); 
            }
          })
          .catch((error) => {
            loadingOverlay().cancel(spinHandle); // cerrar loa
            toastr.error('Error');    
      });  
    }

    // actualiza el slider, ya sea foto o solo datos
    function actualizarSlider(){
      descripcion = document.getElementById('descripcionU').value;    
      imagen = document.getElementById("imagenU");
      posicion = document.getElementById("posicionU").value;
      idslider = document.getElementById("idU").value;
     
      retorno = validacionU(posicion);

      if(retorno){
        document.getElementById("btnGuardarU").disabled = true;
        var spinHandle = loadingOverlay().activate();

        let formData = new FormData();
        formData.append('descripcion', descripcion);
        formData.append('posicion', posicion);
        formData.append('imagen', imagen.files[0]);
        formData.append('idslider', idslider);
        
        axios.post('/admin/editar-slider', formData, {        
          })
          .then((response) => {	
            document.getElementById("btnGuardarU").disabled = false;
            loadingOverlay().cancel(spinHandle); // cerrar loading
            mensajesEditar(response);
          })
          .catch((error) => {
            document.getElementById("btnGuardarU").disabled = false;  
            loadingOverlay().cancel(spinHandle); // cerrar loading
            toastr.error('Error');             
       }); 
      }
    }

    // mensaje segun retorno del servidor
    function mensajesEditar(valor){
      if(valor.data.success == 1){
        toastr.success('Guardado', 'Se ha editado el slider!')
        $('#modalEditar').modal('hide');             
        var ruta = "{{ URL::to('admin/tablas/slider') }}";   
        $('#tablaDatatable').load(ruta);
      }else if(valor.data.success == 3){
        toastr.error('Error', 'No se guardo la imagen!');
      }else if(valor.data.success == 4){
        toastr.error('Error', 'Slider no encontrado!');
      }else{
        // error en validacion en servidor
        toastr.error('Error', 'Datos incorrectos!');
      }
    }

    // validacion para cuando se actualiza el slider
    function validacionU(pos){
      if(pos.length == 0){
        toastr.error('Error', 'Posicion es requerida'); 
        return false;
      }else if(pos == 0){
        toastr.error('Error', 'Posicion no debe ser 0'); 
        return false;
      }else{
        return true;
      }
    }

    // abre el modal para eliminar slider
    function abrirModalEliminar(id){     
      $('#modalEliminar').modal('show');
      $('#idD').val(id);
    }

    // enviar peticion para borrar el slider
    function borrarSlider(){
      idslider = document.getElementById("idD").value;
      spinHandle = loadingOverlay().activate(); // mostrar loading

      axios.post('/admin/eliminar-slider',{
        'id': idslider  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); // cerrar loading

            if(response.data.success == 1){
              toastr.success('Slider Eliminado!')
              $('#modalEliminar').modal('hide');   
              var ruta = "{{ URL::to('admin/tablas/slider') }}";   
              $('#tablaDatatable').load(ruta);
            }else{
              toastr.error('Error', 'No se pudo eliminar el Slider');  
            }           
          })
          .catch((error) => {
            loadingOverlay().cancel(spinHandle); // cerrar loading   
            toastr.error('Error');               
      });
    }

  </script>

@stop