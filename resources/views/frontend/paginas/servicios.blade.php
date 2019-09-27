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
										<h1><strong>Servicios Municipales</strong></h1>
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

				@foreach($servicios as $item)												
				<div class="row animate-box">
					<div class="services">
						<a href="{{ asset('servicio/'.$item->slug) }}">
							<div class="col-md-3  text-center">
							<center>
							<img src="{{ asset('storage/servicio/'.$item->logo) }}" alt="Programa Municipal" style="width:180px; height:180px;"/>
							</center>
							</div>
						</a>
						<div class="col-md-9">
							<div class="row">
								<div class="col-md-12">
									<a href="{{ asset('servicio/'.$item->slug) }}">
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