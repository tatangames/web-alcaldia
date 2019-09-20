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
				<li style="background-image: url({{ asset('images/Slider/a4.jpg')}});">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
									<div class="slider-text-inner text-center">
										<h1>Noticias y Anuncios</h1>
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
			<div class="container infinite-scroll">
			@foreach($noticias as $item)
			<div class="row ">
					<div class="col-md-10">
						<div class="wrap-division">
							<a href="{{ url('noticia/'.$item->nombrenoticia) }}" >
							<article class="animated zoomIn">
								<div class="blog-img" style="background-image: url( {{ asset('storage/noticia/'.$item->nombrefotografia) }});"></div>
								<div class="desc">
									<div class="meta">
										<h6>
											<span>{{ $item->fecha }}</span>
										</h6>
									</div>
									<h2>{{ $item->nombrenoticia }}</h2>
									<h5>{!! $item->descorta !!}</h5>
								</div>
							</article></a>
						</div>
					</div>
				</div>
				@endforeach
					{{ $noticias->links() }}
			</div>
		</div>
	</div>
	<!--End Contenido-->

	@include("frontend.menus.footer")
	    <script src="{{ asset('plugins/scrollinfinite/jquery.jscroll.min.js') }}" type="text/javascript"></script>
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
		<script type="text/javascript">
		$('ul.pagination').hide();
		$(function() {
			$('.infinite-scroll').jscroll({
				autoTrigger: true,
				loadingHtml: '<img class="center-block" src="/images/loadinggif.gif" alt="Loading..." />',
				padding: 0,
				nextSelector: '.pagination li.active + li a',
				contentSelector: 'div.infinite-scroll',
				callback: function() {
					$('ul.pagination').remove();
				}
			});
		});
	</script>
	</body>
</html>