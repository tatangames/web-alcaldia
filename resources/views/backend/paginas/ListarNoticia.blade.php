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
          <h1>Lista de Noticias</h1>
        </div>
        <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
          <i class="fas fa-pencil-alt"></i>
            Nueva Noticia
        </button>
      </div>
    </div>
  </section>

   
    <!-- seccion tabla -->
    <div id="tablaDatatable"></div>  
 
    <!-- modal agregar nueva noticia -->
    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nueva Noticia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formulario">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-6"> 
                    <!-- nombre noticia -->
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre noticia">
                    </div>
                    <div class="box box-info">                                            
                        <div class="box-header with-border"  style="margin-top:10px">
                          <h3 class="box-title">Descripción Corta</h3>
                        </div>
                        <!-- editor 1 -->
                      <textarea id="editor1" name="editor1"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Imagenes</label>
                      <!-- imagen -->
                      <input type="file" class="form-control" id="logo" name="logo[]" multiple accept="image/jpeg, image/jpg" />
                    </div>

                    <div class="box box-info">                                            
                        <div class="box-header with-border" style="margin-top:10px">
                          <h3 class="box-title">Descripción Larga</h3>
                        </div>
                        <!-- editor 2-->
                      <textarea id="editor2" name="editor2"></textarea>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                      <label>Fecha</label>
                      <input type="date" class="form-control" id="fecha" name="fecha">
                  </div>
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardar" onclick="guardarNoticia()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>


	 <!-- modal editar noticia -->
   <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Noticia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="formularioU">
              <div class="card-body">
                <div class="row">  
                  <div class="col-md-6"> 
                    <!-- editar noticia -->
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" id="nombreU" name="nombreU" placeholder="Nombre noticia">
                    </div>
                    <div class="box box-info">                                            
                        <div class="box-header with-border"  style="margin-top:10px">
                          <h3 class="box-title">Descripción Corta</h3>
                        </div>
                        <!-- editor 3 -->
                      <textarea id="editor3" name="editor3"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="form-group">
                      <label>Fecha</label>
                      <input type="date" class="form-control" id="fechaU" name="fechaU">
                  </div>
                    <div class="box box-info">                                            
                        <div class="box-header with-border" style="margin-top:10px">
                          <h3 class="box-title">Descripción Larga</h3>
                        </div>
                        <!-- editor 4-->
                      <textarea id="editor4" name="editor4"></textarea>
                    </div>
                  </div>                                   
                </div> 
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardar" onclick="editarNoticia()">Guardar</button>
          </div>          
        </div>        
      </div>      
    </div>
  <!-- modal eliminar -->
 
  <div class="modal fade" id="modalEliminar">
      <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Noticia</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
            </div>
                  <div class="modal-body">
                    <input type="hidden" id="idD"/> <!-- id de la noticia para borrarlo-->                           
                  </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>             
              <button class="btn btn-danger" id="btnBorrar" type="button" onclick="borrarNoticia()">Borrar</button>
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

  <script>
        CKEDITOR.replace('editor1'); //descripcion corta
        CKEDITOR.replace('editor2'); //descripcion larga
        CKEDITOR.replace('editor3'); //descripcion corta
        CKEDITOR.replace('editor4'); //descripcion larga
    </script>

 <!-- incluir tabla --> 
  <script type="text/javascript">	
    $(document).ready(function(){    
      var ruta = "{{ URL::to('admin/tablas/noticia') }}";   
      $('#tablaDatatable').load(ruta);
    });
 </script>


  <script>

  function abrirTablaFotografia(id){
    var ruta = "{{ URL::to('admin/tablas/fotografia/') }}";  
   
    console.log(ruta);
   
  }

  function abrirModalAgregar(){
      document.getElementById("formulario").reset();
      CKEDITOR.instances['editor1'].setData('');
      CKEDITOR.instances['editor2'].setData('');              
      $('#modalAgregar').modal('show'); 
    }

      // guardar nuevo slider
  function guardarNoticia(){

      var nombre = document.getElementById('nombre').value;
      var fecha = document.getElementById('fecha').value;
      var editor1 = CKEDITOR.instances.editor1.getData();  
      var editor2 = CKEDITOR.instances.editor2.getData();
      var imagen = document.getElementById('logo'); 

      var retorno = validaciones(nombre, editor1, editor2, imagen, fecha);

      if(retorno){ 

        var spinHandle = loadingOverlay().activate(); // activar loading
        document.getElementById("btnGuardar").disabled = true;
              
        let formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('descorta', editor1);
        formData.append('deslarga', editor2);
        formData.append('fecha', fecha);

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

        axios.post('/admin/agregar-noticia', formData, {  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); // cerrar loading            
            document.getElementById("btnGuardar").disabled = false; //habilitar boton          
           
            if(response.data.success == 1){
              toastr.success('Guardado', 'Se ha creado nueva noticia!');
              $('#modalAgregar').modal('hide');             
              var ruta = "{{ URL::to('admin/tablas/noticia') }}";   
              $('#tablaDatatable').load(ruta);
            }else{
              toastr.error('Error', 'No se guardo la noticia!'); 
            }
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
      toastr.success('Guardado', 'Se ha creado nuevo Programa!');
      $('#modalAgregar').modal('hide');             
      var ruta = "{{ URL::to('admin/tablas/programa') }}";   
      $('#tablaDatatable').load(ruta);
    }else if(valor.data.success == 2){
      toastr.error('Error', 'Datos no guardados!');
    }else if(valor.data.success == 3){
      toastr.error('Error', 'No se guardo la imagen!');
    }else{
      // error en validacion en servidor
      toastr.error('Error', 'Datos incorrectos!');
    }
  }
    
    // validar antes de agregar programa
  function validaciones(nombre, editor1, editor2, imgFile, fecha){            
      if(imgFile.files && imgFile.files[0]){
        
      }else{
          toastr.error('Error', 'Agregar una imagen!');
          return false;
      }
      
      if(nombre === ''){
          toastr.error('Error', 'Agregar nombre de programa!');
          return false;
      }
      else if(editor1 === ''){
          toastr.error('Error', 'Agregar descripción corta!');
          return false;
      }
      else if(fecha === ''){
          toastr.error('Error', 'Agregar una Fecha!');
          return false;
      }
      else if(editor2 === ''){
          toastr.error('Error', 'Agregar descripción larga!');
          return false;
      }
      else{
          return true;
      }
  } 

  // abre el modal para editar la noticia
  function abrirModalEditar(id){
    document.getElementById("formularioU").reset();   
    spinHandle = loadingOverlay().activate();
    axios.post('/admin/informacion-noticia',{
      'id': id  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); // cerrar loading
          if(response.data.success = 1){
         
            $('#modalEditar').modal('show');
            $('#idU').val(response.data.noticia.idnoticia);
            $('#nombreU').val(response.data.noticia.nombrenoticia);   
            $('#fechaU').val(response.data.noticia.fecha); 
            CKEDITOR.instances['editor3'].setData(response.data.noticia.descorta);
            CKEDITOR.instances['editor4'].setData(response.data.noticia.deslarga);            

          }else{ 
            toastr.error('Error', 'Noticia no encontrado'); 
          }          
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading
          toastr.error('Error');    
    });
  }

  // editar programa
  function editarNoticia(){
            
      var id = document.getElementById('idU').value;
      var nombre = document.getElementById('nombreU').value;
      var editor3 = CKEDITOR.instances.editor3.getData();  
      var editor4 = CKEDITOR.instances.editor4.getData();
      var fecha = document.getElementById('fechaU').value;

      // validacion
      var retorno = validacionesEditar(nombre, editor3, editor4, fecha);
    
      if(retorno){
          var spinHandle = loadingOverlay().activate(); // activar loading
          document.getElementById("btnGuardarU").disabled = true;
          
          var formData = new FormData();
          formData.append('idnoticia', id);
          formData.append('nombre', nombre);
          formData.append('descorta', editor3);
          formData.append('deslarga', editor4);
          formData.append('fecha', fecha);
  
          axios.post('/admin/editar-noticia', formData, {        
          })
          .then((response) => {	

            document.getElementById("btnGuardarU").disabled = false;
            loadingOverlay().cancel(spinHandle); // cerrar loading
            mostrarMensajeEditar(response);           
          })
          .catch((error) => {
            document.getElementById("btnGuardarU").disabled = false;  
            loadingOverlay().cancel(spinHandle); // cerrar loading
            toastr.error('Error');             
        }); 
      }            
  }
        
  // mensajes segun el servidor
  function mostrarMensajeEditar(valor) {          
      if (valor.data.success == 1) { 
          $('#modalEditar').modal('hide');             
          var ruta = "{{ URL::to('admin/tablas/noticia') }}";   
          $('#tablaDatatable').load(ruta);   
          toastr.success('Guardado', 'Programa actualizado');    
      } else if (valor.data.success == 2) { 
          toastr.error('Error', 'Noticia no encontrado'); 
      } else {
          toastr.error('Error'); 
      }
  }
        
  // validar antes de agregar
  function validacionesEditar(nombre, editor3, editor4, fecha){
      
      if(nombre === ''){
          toastr.error('Error', 'Agregar nombre de programa'); 
          return false;
      }
      else if(editor3 === ''){
          toastr.error('Error', 'Agregar descripción corta'); 
          return false;
      }
      else if(fecha === ''){
          toastr.error('Error', 'Agregar una Fecha!');
          return false;
      }
      else if(editor4 === ''){
          toastr.error('Error', 'Agregar descripción larga'); 
          return false;
      }
      else{
          return true;
      }
  } 

  // abre el modal para eliminar slider
  function abrirModalEliminar(id){     
    $('#modalEliminar').modal('show');
    $('#idD').val(id);    
  }

  // enviar peticion para borrar el slider
  function borrarNoticia(){
    id = document.getElementById("idD").value;
    spinHandle = loadingOverlay().activate(); // mostrar loading

    axios.post('/admin/eliminar-noticia',{
      'id': id  
        })
        .then((response) => {	

        console.log(response);

          loadingOverlay().cancel(spinHandle); // cerrar loading

          if(response.data.success == 1){
            toastr.success('Noticia Eliminado!')
            $('#modalEliminar').modal('hide');   
            var ruta = "{{ URL::to('admin/tablas/noticia') }}";   
            $('#tablaDatatable').load(ruta);
          }else{
            toastr.error('Error', 'No se pudo eliminar la noticia');  
          }         
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error');               
    });
  }



  </script>



@stop