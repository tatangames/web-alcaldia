<!--Parte superior de las paginas -  hasta head  -->
@include('frontend.menus.indexSuperior')

<body>
	<div class="colorlib-loader"></div>
	<div id="page">
		<!--Barra de navegacion -->
		@include("frontend.menus.navbar")
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

		<!--Contenido noticia-->
		<div id="colorlib-about">
			<div class="container">

				<div class="row">
					<div class="about-flex">
						<div class="col-md-8 animate-box">
							<br><br><br><br>
							<strong>
								<h1>{{$noticia->nombrenoticia}}</h1>
							</strong>
							<div class="row row-pb-sm">
								<div class="col-md-12">
									<img class="img-responsive" src="{{ asset('storage/noticia/'.$noticia->nombrefotografia)}}" alt="" data-toggle="modal" data-target="#modal1" onclick="getPath(this)">
								</div>

							</div>
							<div class="row">
								<div class="col-md-12">
								{!!$noticia->deslarga!!}
									<br>
								</div>
							</div>
							<div class="row">
							@foreach($fotografias as $foto)
								<div class="col-md-4" animate-box>
									<img class="img-responsive" src="{{ asset('storage/noticia/'.$foto->nombrefotografia)}}" alt="" data-toggle="modal" data-target="#modal1" onclick="getPath(this)">
								</div>
							@endforeach

							</div>
							<br><br>
						</div>
						<div class="col-md-4">
							<br><br><br>
							<div class="side animate-box">
								<h3 class="sidebar-heading">Noticias recientes</h3>
								@foreach($noticiaReciente as $item)
								<div class="blog-entry-side">									
									<a href="/noticia/{{$item->nombrenoticia}}" class="blog-post">
										<span class="img" style="background-image: url({{ asset('storage/noticia/'.$item->nombrefotografia)}});"></span>
										<div class="desc">
											<span class="date">{{$item->fecha}}</span>
											<h4>{{$item->nombrenoticia}}</h4>
											<span class="cat">Ver noticia</span>
										</div>
									</a>
								</div>
								@endforeach
								
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<!--Fin contenido noticia-->

		<br>
		<hr><br>

		<!--Cuadro modal para el Zoom de las fotos-->
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
		<!--End Cuadro modal-->

		@include("frontend.menus.footer")
		<script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>
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
		<!--Cambiar url cuadro modal-->
		<script type="text/javascript">
			function getPath(img) {
				atributo = img.getAttribute("src");
				document.getElementById("imgModal").setAttribute("src", atributo);
			}
		</script>
		<!--End Cuadro modal-->


</body>

</html>