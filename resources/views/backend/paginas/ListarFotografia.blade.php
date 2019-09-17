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
          <div class="col-sm-3">
          <h1>Fotografias</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
          <i class="fas fa-pencil-alt"></i>
            Agregar Fotos
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
            <h3 class="card-title">Fotografias</h3>

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

    <!-- modal agregar nueva fotografia -->
    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nueva Fotografia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formulario">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-12">                    
                    <div class="form-group">
                      <label>Imagenes</label>
                      <!-- imagen -->
                      <input type="file" class="form-control" id="logo" name="logo[]" multiple accept="image/jpeg, image/jpg" />
                    </div>            
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardar" onclick="guardarFoto()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>

   <!-- modal eliminar fotografia individual-->
 
   <div class="modal fade" id="modalEliminarFoto">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Fotografia</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idDF"/> <!-- id de la fotografia para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarFotografia()">Borrar</button>
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

  <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>



 <!-- incluir tabla --> 
  <script type="text/javascript">	
    $(document).ready(function(){  

      // obtener id retornado del controlador
      idf = {{ $idfoto }};
      var ruta = "{{ url('/admin/tabla/fotografia') }}/"+idf;   
      $('#tablaDatatable').load(ruta);
    });
 </script>


  <script>

  
  function abrirModalAgregar(){
      document.getElementById("formulario").reset();               
      $('#modalAgregar').modal('show'); 
    }

      // guardar nuevo slider
  function guardarFoto(){
     
      var imagen = document.getElementById('logo'); 
      id = {{ $idfoto }};

      var retorno = validaciones(imagen);

      if(retorno){ 

        var spinHandle = loadingOverlay().activate(); // activar loading
        document.getElementById("btnGuardar").disabled = true;
              
        let formData = new FormData();
     
        var files = imagen.files;
        for (var i = 0; i < files.length; i++){
            var file = files[i];

            // permitir cualquier tipo de imagen, pero backend valida
            if (!file.type.match('image/jpeg|image/png|image/jpeg')){
              continue;
            }

            // Add the file to the request.
            formData.append('imagen[]', file, file.name);
        }

        formData.append('id', id);

        axios.post('/admin/agregar-fotografia', formData, {  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); // cerrar loading            
            document.getElementById("btnGuardar").disabled = false; //habilitar boton          
            
            if(response.data.success == 1){
             
              var ruta = "{{ url('/admin/tabla/fotografia') }}/"+idf; // esta variable global viene mas arriba
              $('#tablaDatatable').load(ruta);
              $('#modalAgregar').modal('hide');
            }else{
              toastr.error('Error', 'No se pudo agregar la imagen!');  
            }


          })
          .catch((error) => {
            document.getElementById("btnGuardar").disabled = false;     
            loadingOverlay().cancel(spinHandle); // cerrar loading   
            toastr.error('Error', 'Datos incorrectos!');               
        }); 
      } 
  }
    
    // validar antes de agregar foto
  function validaciones(imgFile){            
      if(imgFile.files && imgFile.files[0]){
        return true;
      }else{
        toastr.error('Error', 'Agregar una imagen!');
        return false;
      }
  } 

  // eliminar una foto
  function abrirModalEliminarFoto(id){
    $('#modalEliminarFoto').modal('show');
    $('#idDF').val(id);  
  }

  function borrarFotografia(){
    id = document.getElementById("idDF").value;
    spinHandle = loadingOverlay().activate(); // mostrar loading
    document.getElementById("btnBorrar").disabled = true;

    axios.post('/admin/eliminar-fotografia',{
      'id': id  
        })
        .then((response) => {	


          loadingOverlay().cancel(spinHandle); // cerrar loading
          document.getElementById("btnBorrar").disabled = false;

          if(response.data.success == 1){
            toastr.success('Fotografia Eliminada!')
            var ruta = "{{ url('/admin/tabla/fotografia') }}/"+idf; // esta variable global viene mas arriba
            $('#tablaDatatable').load(ruta);
            $('#modalEliminarFoto').modal('hide');
          }else{
            toastr.error('Error', 'No se pudo eliminar la fotografia');  
          }         
        })
        .catch((error) => {
          document.getElementById("btnBorrar").disabled = false;
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error');               
    });
  }


  </script>



@stop