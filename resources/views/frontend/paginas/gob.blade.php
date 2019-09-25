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
					<li style="background-image: url(images/Slider/a7.jpg);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h2></h2>
										<h1>Gobierno Municipal</h1>
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
					<div class="about-flex">
						<div class="col-md-1 aside-stretch animate-box">
							<div class="row">
							</div>
						</div>
						<div class="col-three-forth animate-box text-center">
							<h2>Nuestro Gobierno</h2>
							<div class="row">
								<div class="col-md-12">		
									<img src="{{asset('images/historia/IMG_4348.jpg')}}" alt="Alcalde y Consejo" class="img-responsive" width="900" ></p>
								</div>
							</div>
									<br>
									<p style="text-align: center;"><strong style="font-size: 20px;">NOMINA DE CONCEJALES 2018-2021</strong></p>

									<table class="table table-hover table-bordered">
										<tbody>
											<tr>
												<td>
													<strong>Alcalde Municipal </strong>
												</td>
												<td><span>Prof. José Rigoberto Pinto Rivera</span></td>
											</tr>
											<tr>
												<td>
													<strong>Síndico</strong>
												</td>
												<td><span>Lic. Ramón Alberto Calderón</span></td>
											</tr>
											<tr>
												<td><strong>1° Regidor Propietario</strong></td>
												<td><span>José Roberto Lemus Morataya</span></td>
											</tr>
											<tr>
												<td><strong>2° Regidor Propietaria</strong></td>
												<td><span>Sr. Pedro Antonio Sanabria</span></td>
											</tr>
											<tr>
												<td><strong>3° Regidora Propietario</strong></td>
												<td><span>Sra. Nora Elizabeth Hernández</span></td>
											</tr>
											<tr>
												<td><strong>4° Regidor Propietario</strong></td>
												<td><span>Sr. Rudy Alfredo Sanabria</span></td>
											</tr>
											<tr>
												<td><strong>5° Regidor Propietaria</strong></td>
												<td><span>Sr. Alejandro Lemus M.</span></td>
											</tr>
											<tr>
												<td><strong>6° Regidor Propietario</strong></td>
												<td><span>Lic. José Atilio Granados</span></td>
											</tr>
											<tr>
												<td><strong>7° Regidor Propietario</strong></td>
												<td><span></span>Sr. Julio Enrique Martínez</td>
											</tr>
											<tr>
												<td><strong>8° Regidor Propietaria</strong></td>
												<td><span>Sr. José Misael Posada</span></td>
											</tr>
											<tr>
												<td><strong>9° Regidor Propietario</strong></td>
												<td><span>Lic. Ricardo Alberto Polanco</span></td>
											</tr>
											<tr>
												<td><strong>10° Regidor Propietario</strong></td>
												<td><span>Ing. Nelson Eduardo Figueroa</span></td>
											</tr>
											<tr>
												<td><strong>1° Regidor Suplente</strong></td>
												<td><span>Sr. Carlos Armando Sandoval</span></td>
											</tr>
											<tr>
												<td><strong>2° Regidor Suplente</strong></td>
												<td><span>Sr. Ricardo Pacheco Pacheco</span></td>
											</tr>
											<tr>
												<td><strong>3° Regidor Suplente</strong></td>
												<td><span>Sra. Nora Elizabeth Hernández</span></td>
											</tr>
											<tr>
												<td><strong>4° Regidor Suplente</strong></td>
												<td><span>Sr. Rudy Alfredo Sanabria</span></td>
											</tr>
										</tbody>
									</table>
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