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
		<!--Contenido-->
		<div id="colorlib-blog">
			<div class="container">
				<div class="row">
					<div class="col-md-10">
						<div class="wrap-division">
						@foreach($noticias as $item)
							<article class="animate-box">
								<a href="/noticia/{{$item->nombrenoticia}}">
									<div class="blog-img" style="background-image: url(storage/noticia/{{ $item->nombrefotografia }});"></div>
								</a>
								<div class="desc">
									<div class="meta">
										<p>
											<span>{{$item->fecha}}</span}>
										</p>
									</div>
									<a href="noticiaSelect.html"></a>
									<h2>{{$item->nombrenoticia}}</h2></a>
									<p>{!! $item->descorta !!}</p>
								</div>
							</article>
							@endforeach
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End Contenido-->

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
</body>

</html>