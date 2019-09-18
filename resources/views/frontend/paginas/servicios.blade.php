<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Servicios Municipales</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />


	<link href='{{ asset('images/LOGO_2_-_copia.png') }}' rel='shortcut icon' type='image/png'>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="{{ asset('flaticon/font/flaticon.css') }}" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('icomoon/iconmoon.ttf')}}">
	<link href="{{ asset('css/frontend.css') }}" type="text/css" rel="stylesheet" />
	<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/modernizr-2.6.2.min.js') }}" type="text/javascript"></script>


</head>

<body>

	<div class="colorlib-loader"></div>

	<div id="page">
		<!--Barra de navegacion -->
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu" style="background-color: rgb(0,0,0,0.5); height: 100px; ">
				<div class="container-fluid ">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="index.html"><img src="images/LOGO_2_-_copia.png" alt=""
										srcset="" width="60px" height="80px;"
										style="position: relative; top:-25px;"></a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href="/">Inicio</a></li>
								<li><a href="noticias.html">Noticias</a></li>
								<li class="has-dropdown">
									<a href="/servicios">Servicios</a>
									<ul class="dropdown">
									@foreach($servicio as $dato3)
										<li><a href="/servicio/{{$dato3->nombreservicio}}">{{$dato3->nombreservicio}}</a></li>
									@endforeach	
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="info.html">Tu Alcad&iacute;a</a>
									<ul class="dropdown">
										<li><a href="gob.html">Gobierno municipal</a></li>
										<li><a href="historia.html">Historia</a></li>
									</ul>
								</li>
								<li><a href="/galeria">Galer&iacute;a</a></li>
								<li><a href="#colorlib-footer" class="ancla" data-ancla="colorlib-footer">Contacto</a></li>
								<li><a href="https://www.transparencia.gob.sv/institutions/alc-metapan">Portal de
										transparencia</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<!--End Barra de navegacion-->

		<!--Imagen de cabecera-->
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/Slider/a4.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
									<div class="slider-text-inner text-center">
										<h1>Servicios</h1>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<!--End Imagen de cabecera-->
		<h5>.</h5>

		<!--Contenido-->
		<div id="colorlib-services">
			<div class="container">
				<div class="row">
					<div class="col-md-12 text-center">
						<h1>Servicios Municipales</h1>
					</div>
				</div>

				@foreach($servicio as $item)												
				<div class="row animate-box">
					<div class="services">
						<a href="/servicio/{{$item->nombreservicio}}">
							<div class="col-md-3  text-center">
							<center>
							<img src="../storage/servicio/{{ $item->logo }}" alt="Programa Municipal" style="width:180px; height:180px;"/>
							</center>
							</div>
						</a>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12">
									<a href="/servicio/{{$item->nombreservicio}}">
										<h3>{{ $item->nombreservicio }}</h3>
									</a>
								</div>
								<div class="col-md-12">
								{!! $item->descorta !!}
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				<br><br>
<br>


			</div>
		</div>
		<!--End contenido-->
		@include("frontend.menus.footer")
	<script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>
	<script>
  		$(document).ready(function(){
   			$(".ancla").click(function(evento){
      		evento.preventDefault();
      		var codigo = "#" + $(this).data("ancla");
      		$("html,body").animate({scrollTop: $(codigo).offset().top}, 300);
    		});
  		});
</script>

</body>

</html>