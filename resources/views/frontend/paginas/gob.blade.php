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
					<li style="background-image: url({{ asset ('images/Slider/a5.jpg') }});">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h2></h2>
										<h1><strong>Gobierno Municipal</strong></h1>
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
		<div id="colorlib-about">
			<div class="container">
				<div class="row">
					<div class="about-flex animated zoomIn">
					<div class="col-md-1 aside-stretch">
							<div class="row">
							</div>
						</div>
						<div class="col-three-forth text-center">
							<h2>Nuestro Gobierno</h2>
							<div class="row">
								<div class="col-md-12">		
									<!-- <img src="{{ asset('images/historia/IMG_3743-01.jpeg') }}" alt="Alcalde y Consejo" class="img-responsive" width="900" ></p>-->
								</div>
							</div>
									<br>
									<p style="text-align: center;"><strong style="font-size: 20px;">NOMINA DE CONCEJALES 2024-2027</strong></p>

									<table class="table table-hover table-bordered">
										<tbody>
											<tr>
												<td>
													<strong>Alcalde Municipal </strong>
												</td>
												<td><span>Carlos Adelso Landaverde Carpio</span></td>
											</tr>
											<tr>
												<td>
													<strong>Síndico</strong>
												</td>
												<td><span>Roberto Emilio Quijano Jimenez</span></td>
											</tr>
											<tr>
												<td><strong>1° Regidor Propietario</strong></td>
												<td><span>Rene Edgardo Argueta Figueroa</span></td>
											</tr>
											<tr>
												<td><strong>2° Regidor Propietario</strong></td>
												<td><span>José Misael Posadas Mejia</span></td>
											</tr>
											<tr>
												<td><strong>3° Regidor Propietario</strong></td>
												<td><span>Mario Antonio Arriola Figueroa</span></td>
											</tr>
											<tr>
												<td><strong>4° Regidor Propietario</strong></td>
												<td><span>Carlos Humberto Villanueva Osorio</span></td>
											</tr>
											<tr>
												<td><strong>1° Regidor Suplente</strong></td>
												<td><span>Adelaido Aguirre Acevedo</span></td>
											</tr>
											<tr>
												<td><strong>2° Regidor Suplente</strong></td>
												<td><span>Noe Antonio Montejo Orellana</span></td>
											</tr>
											<tr>
												<td><strong>3° Regidor Suplente</strong></td>
												<td><span>Clelia Madelin Guevara de Galdamez</span></td>
											</tr>
											<tr>
												<td><strong>4° Regidora Suplente</strong></td>
												<td><span>Bessy Magaly Marroquin de Rosales</span></td>
											</tr>
										</tbody>
									</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!--End contenido-->

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