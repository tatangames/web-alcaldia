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
            <h1>Lista de Programas</h1>
          </div>
          <div class="col-sm-2">
          <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
          <i class="fas fa-pencil-alt"></i>
          Nuevo Programa
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
            <h3 class="card-title">Programas Municipales</h3>

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
      var ruta = "{{ URL::to('admin/tablas/programa') }}";   
      $('#tablaDatatable').load(ruta);
    });
 </script>


  <script>

  function abrirModalAgregar(){
      document.getElementById("formulario").reset();
      CKEDITOR.instances['editor1'].setData('');
      CKEDITOR.instances['editor2'].setData('');              
      $('#modalAgregar').modal('show'); 
    }

      // guardar nuevo slider
  function guardarPrograma(){

      var nombre = document.getElementById('nombre').value;
      var editor1 = CKEDITOR.instances.editor1.getData();  
      var editor2 = CKEDITOR.instances.editor2.getData();
      var imagen = document.getElementById('logo'); 

      var retorno = validaciones(nombre, editor1, editor2, imagen);

      if(retorno){ 

        var spinHandle = loadingOverlay().activate(); // activar loading
        document.getElementById("btnGuardar").disabled = true;
              
        let formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('descorta', editor1);
        formData.append('deslarga', editor2);
        formData.append('imagen', imagen.files[0]);

        axios.post('/admin/agregar-programa', formData, {  
          })
          .then((response) => {	
            loadingOverlay().cancel(spinHandle); // cerrar loading            
            document.getElementById("btnGuardar").disabled = false; //habilitar boton          
           
            mensajeResponse(response);
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
      toastr.success('Guardado', 'Se ha creado nuevo Programa!')
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
  function validaciones(nombre, editor1, editor2, imgFile){            
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
      else if(editor2 === ''){
          toastr.error('Error', 'Agregar descripción larga!');
          return false;
      }
      else{
          return true;
      }
  } 


  // abre el modal para editar el programa
  function abrirModalEditar(id){
    document.getElementById("formularioU").reset();   
    spinHandle = loadingOverlay().activate();
    axios.post('/admin/informacion-programa',{
      'id': id  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); // cerrar loading
          if(response.data.success = 1){
         
            $('#modalEditar').modal('show');
            $('#idU').val(response.data.programa.idprograma);
            $('#nombreU').val(response.data.programa.nombreprograma);    
            CKEDITOR.instances['editor3'].setData(response.data.programa.descorta);
            CKEDITOR.instances['editor4'].setData(response.data.programa.deslarga);
          }else{ 
            toastr.error('Error', 'Programa no encontrado'); 
          }
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading
          toastr.error('Error');    
    });
  }

  // editar programa
  function editarPrograma(){
            
      var id = document.getElementById('idU').value;
      var nombre = document.getElementById('nombreU').value;
      var editor3 = CKEDITOR.instances.editor3.getData();  
      var editor4 = CKEDITOR.instances.editor4.getData();
      var imagen = document.getElementById('logoU'); 
      
      // validacion
      var retorno = validacionesEditar(nombre, editor3, editor4);
    
      if(retorno){
          var spinHandle = loadingOverlay().activate(); // activar loading
          document.getElementById("btnGuardarU").disabled = true;
          
          var formData = new FormData();
          formData.append('idprograma', id);
          formData.append('nombre', nombre);
          formData.append('descorta', editor3);
          formData.append('deslarga', editor4);
          formData.append('imagen', imagen.files[0]);
  
          axios.post('/admin/editar-programa', formData, {        
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
          var ruta = "{{ URL::to('admin/tablas/programa') }}";   
          $('#tablaDatatable').load(ruta);   
          toastr.success('Guardado', 'Programa actualizado');    
      } else if (valor.data.success == 2) { 
          toastr.error('Error', 'No se pudo cargar la imagen'); 
      } else if (valor.data.success == 3) { 
          toastr.error('Error', 'Programa no encontrado'); 
      } else {
          toastr.error('Error'); 
      }
  }
        
  // validar antes de agregar
  function validacionesEditar(nombre, editor3, editor4){           
      
      if(nombre === ''){
          toastr.error('Error', 'Agregar nombre de programa'); 
          return false;
      }
      else if(editor3 === ''){
          toastr.error('Error', 'Agregar descripción corta'); 
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
  function borrarPrograma(){
    id = document.getElementById("idD").value;
    spinHandle = loadingOverlay().activate(); // mostrar loading

    axios.post('/admin/eliminar-programa',{
      'id': id  
        })
        .then((response) => {	
          loadingOverlay().cancel(spinHandle); // cerrar loading

          if(response.data.success == 1){
            toastr.success('Programa Eliminado!')
            $('#modalEliminar').modal('hide');   
            var ruta = "{{ URL::to('admin/tablas/programa') }}";   
            $('#tablaDatatable').load(ruta);
          }else{
            toastr.error('Error', 'No se pudo eliminar el Programa');  
          }           
        })
        .catch((error) => {
          loadingOverlay().cancel(spinHandle); // cerrar loading   
          toastr.error('Error');               
    });
  }



  </script>



@stop