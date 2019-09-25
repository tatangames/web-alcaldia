<!DOCTYPE html>
<html lang="es" class="scrollbar-deep-purple thin square">
<head>
	<title>Alcaldia Metapan - Panel</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
	<!-- libreria fuentes adminlte3 -->
	<link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
	<!-- libreria estilos adminlte3 -->
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />  
    <!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	
    @yield('content-admin-css')

    <style>
		/* Para scroll */
		.scrollbar-deep-purple::-webkit-scrollbar-track {
			-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
			background-color: #F5F5F5;
			border-radius: 10px; }

			.scrollbar-deep-purple::-webkit-scrollbar {
			width: 12px;
			background-color: #F5F5F5; }

			.scrollbar-deep-purple::-webkit-scrollbar-thumb {
			border-radius: 10px;
			-webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
			background-color: #343a40; }

			.square::-webkit-scrollbar-track {
			border-radius: 0 !important; }

			.square::-webkit-scrollbar-thumb {
			border-radius: 0 !important; }

			.thin::-webkit-scrollbar {
			width: 6px; }
    </style>

	
</head>
  <body class="hold-transition sidebar-mini">

    