<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Alcald&iacute;a Metap&aacute;n</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

	<link href='images/LOGO_2_-_copia.png' rel='shortcut icon' type='image/png'>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="{{ asset('flaticon/font/flaticon.css') }}" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('icomoon/iconmoon.ttf')}}">
	<link href="{{ asset('css/frontend.css') }}" type="text/css" rel="stylesheet" />
	<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/modernizr-2.6.2.min.js') }}" type="text/javascript"></script>





</head>

<body>



	<div id="page">
		<!--Barra de navegacion -->
		<nav class="colorlib-nav" role="navigation">
			<div class="top-menu" style="background-color: rgb(0,0,0,0.6); height: 100px; ">
				<div class="container-fluid ">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="index.html"><img src="images/LOGO_2_-_copia.png" alt="" srcset="" width="60px" height="80px;" style="position: relative; top:-25px;"></a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href="index.html">Inicio</a></li>
								<li><a href="noticias.html">Noticias</a></li>
								<li class="has-dropdown">
									<a href="servicios.html">Servicios</a>
									<ul class="dropdown">
										<li><a href="servicio.html">Servicio 1</a></li>
										<li><a href="servicio.html">Servicio 2</a></li>
										<li><a href="servicio.html">Servicio 3</a></li>
										<li><a href="servicio.html">Servicio 4</a></li>
										<li><a href="servicio.html">Servicio 5</a></li>
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="info.html">Tu Alcad&iacute;a</a>
									<ul class="dropdown">
										<li><a href="gob.html">Gobierno municipal</a></li>
										<li><a href="historia.html">Historia</a></li>
									</ul>
								</li>
								<li><a href="galeria.html">Galer&iacute;a</a></li>
								<li><a href="#colorlib-footer" class="ancla" data-ancla="colorlib-footer">Contacto</a></li>
								<li><a href="https://www.transparencia.gob.sv/institutions/alc-metapan">Portal de
										transparencia</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<!--Imagenes de cabecera-->
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
					@foreach($slider as $dato)
					<li style="background-image: url('storage/slider/{{ $dato->fotografia }}');">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h2></h2>
										<h1></h1>
									</div>
								</div>
							</div>
						</div>
					</li>
					@endforeach
				</ul>
			</div>
		</aside>
		<!--End Imagenes de cabecera-->

		<!--Barra de slogan -->
		<div id="colorlib-reservation">
			<!-- <div class="container"> -->
			<div class="row">
				<div class="search-wrap">
					<div class="container">

					</div>
					<div class="tab-content">
						<div id="flight" class="tab-pane fade in active">
							<center><img src="images/slogan6.png" alt=""></center>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--End Barra de slogan -->

		<!--Programas Municipales-->
		<div id="colorlib-services">
			<div class="container">
				<div class="row  no-gutters">
					<div class="col-md-12 tex-center ">
						<br><br>
						<center>
							<h1>Programas Municipales</h1>
						</center>
					</div>
				</div>
				
				<div class="row no-gutters" >
					@foreach($programa as $dato2)
					@if ($loop->first)
        			<div class="col-md-3 animate-box text-center aside-stretch">	
    				@else
					<div class="col-md-3 animate-box text-center ">
					@endif
						<div class="services">
							<a href="programa.html">
								<span class="icon">
								<img src="storage/programa/{{ $dato2->logo }}" alt="Programa Municipal" style="width:100px; height:100px;"/>
								</span>
								<h3>{{ $dato2->nombreprograma }}</h3>
							</a>
							{!! $dato2->descorta  !!} 
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		<!--End Programas Municipales-->
			<!--Servicios municipales-->
			<div id="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Servicios</h2>
						<p>Espacio para descripcion general de los servicios</p>
					</div>
				</div>
				<div class="blog-flex">
					<div class="row">
					@foreach($servicio as $dato3)
						<div class="col-md-6 animate-box">

							<a href="blog.html" class="blog-post">
								<span class="img" style="background-image: url('storage/servicio/{{ $dato3->logo }}');"></span>
								<div class="desc">
									<h3>{{ $dato3->nombreservicio }}</h3>
									<span>{!! $dato3->descorta  !!}</span>

								</div>
							</a>
						</div>
							@if ($loop->iteration == 2)
							    </div>
								<div class="row">	
    						@elseif($loop->iteration == 4)
								</div>
								<div class="row">	
							@endif
					@endforeach					

					</div>
				</div>


			</div>
		</div>
		<!--End Servicios municipales-->

		<!--Fotografías recientes-->
		<div class="colorlib-tour colorlib-light-grey">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Fotografías</h2>
						<p>Fotograf&iacute;as recientes publicadas en las noticias.</p>
					</div>
				</div>
			</div>
			<div class="tour-wrap">
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a1.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>
					<span class="desc">
						<h2>Titulo</h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a2.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>
					<span class="desc">
						<h2>Titulo</h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a3.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>

					<span class="desc">
						<h2>Titulo</h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a4.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>

					<span class="desc">
						<h2>Titulo </h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a9.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>

					<span class="desc">
						<h2>Titulo </h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a7.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>

					<span class="desc">
						<h2>Titulo </h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a8.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>

					<span class="desc">
						<h2>Titulo</h2>
						<span class="city">Fecha</span>
					</span>
				</a>
				<a class="tour-entry animate-box">
					<div class="tour-img" style="background-image: url(images/Slider/a5.jpg);" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>

					<span class="desc">
						<h2>Titulo</h2>
						<span class="city">Fecha</span>
					</span>
				</a>
			</div>
		</div>
		<!--End Fotografías recientes-->

		<!--Noticias recientes-->
		<div id="colorlib-hotel">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Noticias </h2>
						<p>Noticias publicadas recientemente </p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 animate-box">
						<div class="owl-carousel">
							<div class="item">
								<div class="hotel-entry">
									<a href="noticiaSelect.html" class="hotel-img" style="background-image: url(images/Slider/a1.jpg);"></a>
									<!--Espacio para la categoria de la noticia si hubiera-->
									<!--<p class="price"><span></span><small> </small></p>-->
									</a>
									<div class="desc">
										<h3><a href="noticiaSelect.html">Titulo Noticia</a></h3>
										<span class="place">Fecha de publicacion</span>
										<p>Descripcion corta de noticia</p>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="hotel-entry">
									<a href="noticiaSelect.html" class="hotel-img" style="background-image: url(images/Slider/a8.jpg);"></a>
									<!--Espacio para la categoria de la noticia si hubiera-->
									<!--<p class="price"><span></span><small> </small></p>-->
									</a>
									<div class="desc">
										<h3><a href="noticiaSelect.html">Titulo Noticia</a></h3>
										<span class="place">Fecha de publicacion</span>
										<p>Descripcion corta de noticia</p>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="hotel-entry">
									<a href="noticiaSelect.html" class="hotel-img" style="background-image: url(images/Slider/a2.jpg);"></a>
									<!--Espacio para la categoria de la noticia si hubiera-->
									<!--<p class="price"><span></span><small> </small></p>-->
									</a>
									<div class="desc">
										<h3><a href="noticiaSelect.html">Titulo Noticia</a></h3>
										<span class="place">Fecha de publicacion</span>
										<p>Descripcion corta de noticia</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--End Noticias recientes-->

		<br><br>
		<!-- Mapa -->
		<div class="container">
			<div class="row-fluid animate-box">
				<div class="col-md-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.6524445684045!2d-89.45010788517732!3d14.33160978997424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6255b2d672ac0d%3A0x48fa2f8ae122a71d!2sAlcald%C3%ADa%20Municipal%20de%20Metap%C3%A1n!5e0!3m2!1ses!2ssv!4v1566837634061!5m2!1ses!2ssv" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
				</div>

			</div>
		</div>
		<!-- End Mapa -->
		<br><br>


	</div>
	<!--Cuadro modal fotos-->
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<!--Contenido-->
			<div class="modal-content">
				<div class="modal-body mb-0 p-0">
					<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
						<img id="imgModal" src="images/Slider/a1.jpg" class="embed-responsive-item" alt="">
					</div>
				</div>
				<!--Pie de pagina -->
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
			<!--Fin Contenido-->
		</div>
	</div>
	<!--Fin cuadro modal-->

	<!--Imagen del footer-->
	<div id="colorlib-subscribe" style="background-image: url(images/Slider/a5.jpg);" data-stellar-background-ratio="0.5">
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
	</div>
	<!--Icono subir-->
	<div class="gototop js-top">
		<a class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	<!--Fin icono sunbir-->

	<script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>


	<!--Metodo cuadro modal-->
	<script type="text/javascript">
		function getPath(img) {
			atributo = img.style.backgroundImage;
			document.getElementById("imgModal").setAttribute("src", atributo.substr(5, atributo.length - 7))
		}
	</script>
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