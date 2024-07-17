<!DOCTYPE html>
<html lang="es">
<head>
<title>Santa Ana Norte - Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- libreria fuentes adminlte3 -->
	<link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
	<!-- libreria estilos adminlte3 -->
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />  
    <!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">	
	
	
</head>
<body class="hold-transition sidebar-mini">
    
<div class="wrapper" >
   @include("backend.menus.navbar")
   @include("backend.menus.sidebar")
		
   <div class="content-wrapper" style=" background-color: #fff;">  
      <!-- pantalla inicial que carga -->
      <iframe style="width: 100%; resize: initial; overflow: hidden; min-height: 83vh" frameborder="0"  scrolling="" id="frameprincipal" src="{{ url('/admin/inicio') }}" name="frameprincipal"> 
      </iframe>
   </div>

   @include("backend.menus.footer")
  
</div>

	<!-- libreria jquery -->
	<script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
	<!-- libreria bootstrap4 -->
	<script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
	<!-- libreria adminlte3 -->
    <script src="{{ asset('js/backend/adminlte3/adminlte.min.js') }}" type="text/javascript"></script>


	@yield('content-admin-js')

</body>
</html>