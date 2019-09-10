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
        <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
          <i class="fas fa-pencil-alt"></i>
            Nuevo Programa
        </button>
      </div>
    </div>
  </section>
   
  <!-- seccion frame -->
  <div id="tablaDatatable"></div>
	
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
    
      var ruta = "{{ URL::to('admin/tablas/programa') }}";   
      $('#tablaDatatable').load(ruta);
    });
 </script>


@stop