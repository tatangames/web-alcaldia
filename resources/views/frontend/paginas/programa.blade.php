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
					<li style="background-image: url( {{ asset('images/Slider/a4.jpg') }} );">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
									<div class="slider-text-inner text-center">
										<h1><strong>{{ $programa->nombreprograma }}</strong></h1>

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
						<h1>Informacion Programa</h1>
					</div>
					<br><br><br>
					<div class="row">
						<div class="col-md-4">
							<center>
							<img src="{{ asset('storage/programa/'.$programa->logo) }}" alt="Programa Municipal" style="width:300px; height:300px;"/>
							</center>
						</div>
						<div class="col-md-8">
						<center>{!! $programa->deslarga  !!} </center>
						</div>
					</div>

				</div>
				<br><br>
			</div>
		</div>
		<!--End Contenido-->
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
