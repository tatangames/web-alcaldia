@extends('backend.menus.indexSuperior')
 
@section('content-admin-css')
  
	<!-- libreria fuentes adminlte3 -->
	<link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
	<!-- libreria estilos adminlte3 -->
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />  
    <!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
    <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />  
@stop

   

	
@extends('backend.menus.indexInferior')

@section('content-admin-js')	
	<!-- libreria jquery -->
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
	<!-- libreria bootstrap4 -->
	<script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
	<!-- libreria adminlte3 -->
	<script src="{{ asset('js/backend/adminlte3/adminlte.min.js') }}" type="text/javascript"></script>
@stop
