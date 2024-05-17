


<!--Parte superior de las paginas -  hasta head  -->
@include('frontend.menus.indexSuperior')

<body class="scrollbar-indigo bordered-indigo">
	<div class="colorlib-loader"></div>
	<div id="page">
		<!--Barra de navegacion -->
		@include("frontend.menus.navbar")
		<!--End Barra de navegacion-->
		<!--Imagenes de cabecera-->
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
					@foreach($slider as $dato)
					<li style="background-image: url('storage/slider/{{ $dato->fotografia }}');">
					<a href="{{ $dato->link }}">
						<div class="overlay"></div>
					</a>
					<div class="container-fluid">
							<div class="row">
								<div class="col-md-12 col-md-offset-12 col-sm-12 col-xs-12 slider-text">
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
					<div class="tab-content" style="padding:25px;"  >
						<center>
						  <a style="margin-right:15px;" id = "soc" target="_blank" href="">
        				  <span id="socno">Distrito de Metapán</span>
						  </a>&nbsp;
						  <a style="margin-right:15px;" id = "soc" target="_blank"  href="">
						  <span id="socno">Distrito de Santa Rosa</span>
						  </a>&nbsp;
						  <a style="margin-right:15px;" id = "soc" target="_blank"  href="">
						  <span id="socno">Distrito de Masahuat</span>
						  </a>&nbsp;
						  <a style="margin-right:15px;" id = "soc" target="_blank"  href="">
						  <span id="socno">Distrito de Texistepeque</span>
      					</a>&nbsp;
						</center>
					</div>
				</div>
			</div>
		</div>
		<!--End Barra de slogan -->
	</div>

	<!--Programas Municipales-->
	<div class="colorlib-services colorlib-light-grey">
		<div class="container">
			<div class="row  no-gutters">
				<div class="col-md-12 tex-center ">
					<br><br>
					<center>
						<h2>Programas Municipales</h2>
					</center>
				</div>
			</div>
			<div class="row no-gutters">
				@foreach($programas as $dato2)
				@if ($loop->first)
				<div class="col-md-3 animate-box text-center ">
					@else
					<div class="col-md-3 animate-box text-center ">
						@endif
						<div class="services">
							<a href="{{ url('programa/'.$dato2->slug) }}">
								<span class="icon">
									<img src="{{ asset('storage/programa/'.$dato2->logo) }}" alt="Programa Municipal" style="width:120px; height:120px;" />
								</span>
								<h3>{{ $dato2->nombreprograma }}</h3>
							</a>
							{!! $dato2->descorta !!}
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!--End Programas Municipales-->

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
						@foreach($noticia as $dato5)
						<div class="item">
							<div class="hotel-entry">
								<a href="{{ url('noticia/'.$dato5->slug) }}" class="hotel-img" style="background-image: url('storage/noticia/{{ $dato5->nombrefotografia }}');"></a>

								<div class="desc">
									<h3><a href="{{ url('noticia/'.$dato5->slug) }}">{{ $dato5->nombrenoticia }}</a></h3>
									<span class="place">{{ $dato5->fecha }}</span>
									<p>{!! $dato5->descorta !!}</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End Noticias recientes-->

	<!--Servicios municipales-->
	<div id="colorlib-blog" style="background: #fafafa;">
		<div class="container colorlib-light-grey">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
					<h2>Servicios</h2>
					<p>Espacio para descripcion general de los servicios</p>
				</div>
			</div>
			<div class="blog-flex">
				<div class="row">
					@foreach($servicios as $dato3)
					<div class="col-md-6 animate-box">

						<a href="{{ url('servicio/'.$dato3->slug) }}" class="blog-post">
							<span class="img" style="background-image: url('storage/servicio/{{ $dato3->logo }}');"></span>
							<div class="desc">
								<h3>{{ $dato3->nombreservicio }}</h3>
								<span>{!! $dato3->descorta !!}</span>

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
	<div class="colorlib-tour">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
					<h2>Galería</h2>
					<p>Fotograf&iacute;as recientes publicadas.</p>
				</div>
			</div>
		</div>
		<div class="tour-wrap">
			@foreach($fotografia as $dato4)
			<a class="tour-entry animate-box">
				<div class="tour-img" style="background-image: url('{{ asset('storage/noticia/'.$dato4->nombrefotografia ) }}');" data-toggle="modal" data-target="#modal1" onclick="getPath(this)"></div>
				<span class="desc">
					<h2>{{ $dato4->nombre }}</h2>
					<span class="city">{{ $dato4->fecha }}</span>
				</span>
			</a>
			@endforeach
		</div>
	</div>
	<!--End Fotografías recientes-->

	<br><br>
	<!--mapa-->
	<div id="colorlib-reservation">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-12">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3865.6524445684045!2d-89.45010788517732!3d14.33160978997424!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f6255b2d672ac0d%3A0x48fa2f8ae122a71d!2sAlcald%C3%ADa%20Municipal%20de%20Metap%C3%A1n!5e0!3m2!1ses!2ssv!4v1566837634061!5m2!1ses!2ssv" width="100%" height="400" frameborder="0" style="border:0;"></iframe>
				</div>

			</div>
		</div>
	</div>
	<!-- End Mapa -->
	<br><br>

	<!--Cuadro modal fotos-->
	<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<!--Contenido-->
			<div class="modal-content">
				<div class="modal-body mb-0 p-0">
					<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
						<img id="imgModal" src="{{ asset('images/Slider/a1.jpg') }}" class="embed-responsive-item" alt="">
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
	@include("frontend.menus.footer")
	<script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>


	<!--Metodo cuadro modal-->
	<script type="text/javascript">
		function getPath(img) {
			atributo = img.style.backgroundImage;
			document.getElementById("imgModal").setAttribute("src", atributo.substr(5, atributo.length - 7))
		}
	</script>
	<script>
		$(document).ready(function() {
			$(".ancla").click(function(evento) {
				evento.preventDefault();
				var codigo = "#" + $(this).data("ancla");
				$("html,body").animate({
					scrollTop: $(codigo).offset().top
				}, 300);
			});
		});
	</script>

</body>

</html>
