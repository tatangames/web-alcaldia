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

		<!--Imagen pie de pagina-->
		<div id="colorlib-subscribe" style="background-image: url(images/Slider/a5.jpg);"
			data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Alcald&iacute;a Municipal de Metapán</h2>

						<form class="form-inline qbstp-header-subscribe">
							<div class="row">
								<div class="col-md-12 col-md-offset-0">
									<div class="form-group">

									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--End imagen pie de pagina-->

		<!--Pie de pagina-->
		<footer id="colorlib-footer" role="contentinfo">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-3 colorlib-widget">
					<h4>Siguenos en nuestras redes</h4>
					<p></p>
					<p>
						<ul class="colorlib-social-icons">
							<li><a href="https://www.facebook.com/AlcaldiadeMetapan/"><i class="icon-facebook"></i></a></li>				
							<li><a href="https://twitter.com/Alcaldia_Met"><i class="icon-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/alcaldiademetapan/"><i class="icon-instagram"></i></a></li>
							<li><a href="https://www.youtube.com/channel/UCWSEAyHR42uZHCY3eWW-ELA"><i class="icon-youtube"></i></a></li>
						</ul>
					</p>
				</div>
				<div class="col-md-3 col-md-push-1">
					<h4>Contactanos!</h4>
					<ul class="colorlib-footer-links">
						<li>Avenida Benjam&iacute;n Estrada Valiente<br> 1ra. Calle Poniente, Barrio San
							Pedro,<br>Metap&aacute;n, Santa Ana</li>
						<li><i class="icon-phone"></i><a href="tel://24027615">  2402-7615</a></li>
						<li><i class="icon-phone"></i><a href="tel://24027601">  2402-7601</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">
					<p>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;
						<script>
							document.write(new Date().getFullYear());
						</script> Todos los derechos reservados |
						Alclad&iacute;a Municipal de Metap&aacute;n, Santa Ana, El Salvador.
					</p>
				</div>
			</div>
		</div>
	</footer>
		<!--End pie de pagina-->
	</div>

	<!--Boton subir-->
	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	<!--End Boton subir-->

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