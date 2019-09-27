<!--Parte superior de las paginas -  hasta head  -->
@include('frontend.menus.indexSuperior')

<body>
	<div class="colorlib-loader"></div>
	<div id="page">
		<!--Barra de navegacion -->
		@include("frontend.menus.navbar")
		<!--End Barra de navegacion-->

		<!--Imagen de Cabecera-->
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/Slider/a2.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h1><strong>Galer&iacute;a de Fotos</strong></h1>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<!--End Imagen de Cabecera-->

		<!--Galeria de fotos-->
		<div class="colorlib-wrap" id="contenidopagina">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="wrap-division">
							<div class="infinite-scroll">
								@foreach($fotografias as $foto)
								<div class="col-md-4 col-sm-4 animated zoomIn">
									<div class="tour">
										<a class="tour-img" style="background-image: url(storage/noticia/{{ $foto->nombrefotografia }});" data-toggle="modal" data-target="#modal1" onclick="getPath(this)" alt="error"></a>
									</div>
								</div>
								@endforeach

								{{ $fotografias->links() }}
							</div>
						</div>
						<br>
						<br>
					</div>
				</div>
			</div>
		</div>
		<!--End galería de fotos-->

		<!--Cuadro modal Zoom  fotos-->
		<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<!--Contenido-->
				<div class="modal-content">
					<div class="modal-body mb-0 p-0">
						<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
							<img id="imgModal" src="" class="embed-responsive-item" alt="">
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
		<!-- Metodo cambiar url cuadro modal-->
		<script type="text/javascript">
			function getPath(img) {
				atributo = img.style.backgroundImage;
				document.getElementById("imgModal").setAttribute("src", atributo.substr(5, atributo.length - 7))
			}
		</script>
		<!--Fin Metodo url-->

		<script src="{{ asset('plugins/scrollinfinite/jquery.jscroll.min.js') }}" type="text/javascript"></script>
		<script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>

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