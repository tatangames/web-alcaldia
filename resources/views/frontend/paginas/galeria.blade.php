<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Galer&iacute;a de fotos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link href='{{ asset('images/LOGO_2_-_copia.png') }}' rel='shortcut icon' type='image/png'>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	<link href="{{ asset('flaticon/font/flaticon.css') }}" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('icomoon/iconmoon.ttf')}}">
	<link href="{{ asset('css/frontend.css') }}" type="text/css" rel="stylesheet" />
	<script src="{{ asset('js/jquery.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/modernizr-2.6.2.min.js') }}" type="text/javascript"></script>


</head>

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
										<h1>Galer&iacute;a de Fotos</h1>
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
		@include('frontend.paginas.paginatedata')
		</div>
		
	
		<!--End galería de fotos-->

		<!--Cuadro modal Zoom  fotos-->
		<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
			aria-hidden="true">
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
						<button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
							data-dismiss="modal">Cerrar</button>
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

<script>
$(document).ready(function(){

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault(); 
  var page = $(this).attr('href').split('page=')[1];
  fetch_data(page);
 });

 function fetch_data(page)
 {
  $.ajax({
   url:"/pagination/fetch_data?page="+page,
   success:function(data)
   {
    $('#contenidopagina').html(data);
   }
  });
 }
 
});
</script>

</body>

</html>
