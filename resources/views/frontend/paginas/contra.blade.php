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
					<li style="background-image: url({{ asset ('images/Slider/CAMM.jpg') }});">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h2></h2>
										<h1><strong>Unidad Contravencional</strong></h1>
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
							<h2>¿QUE ES LA UNIDAD CONTRAVENCIONAL?</h2>
									<br>
									<p style="text-align: center;"><strong style="font-size: 17px;">Instancia administrativa que se encarga de verificar, sancionar y resolver casos contemplados en la Ordenanza de Convivencia Ciudadana y Contravenciones Administrativas.</strong></p>
									<br><br>
									<p style="text-align: center; font-size: 15px;">
									  La Unidad Contravencional Municipal de Metapán, ha sido creada, en uso de las facultades legales que les confiere la Constitución de la República de El Salvador, a las municipalidades.
En base a la misma Constitución de la República, Código Municipal y Ordenanzas municipales. 
CONSIDERANDO: 
<br>
I.- Que el artículo 14 de la Constitución de la República, establece que la autoridad administrativa podrá mediante resolución o sentencia y previo al debido proceso, sancionar las contravenciones a las ordenanzas. 
El artículo 203 determina como un principio esencial en la administración del gobierno, la autonomía municipal en los asuntos que corresponda al municipio.
El artículo 204 que hace referencia a la autonomía de los municipios con respecto a decretar ordenanzas y reglamentos sociales. 
II.- Que el artículo 126 del Código Municipal señala que en las ordenanzas municipales pueden establecerse sanciones de multas, clausura y servicios a la comunidad por infracción a sus disposiciones, que se entenderán sin perjuicio de las demás responsabilidades a que hubiere lugar conforme a la ley. 
III.- Que es obligación de la Municipalidad velar por el mantenimiento del orden, el bien común y la armónica convivencia municipal; que el logro del bien común municipal requiere la protección de bienes jurídicos reconocidos por la Constitución de la República en una forma especializada según las necesidades del municipio y sus habitantes.
<br>
POR LO TANTO: Se hace de conocimiento a los habitantes del Municipio de Metapán en cuanto al establecimiento de normas de convivencia, respeto y armonía entre los ciudadanos y la creación de la ORDENANZA DE CONVIVENCIA CIUDADANA Y CONTRAVENCIONES ADMINISTRATIVAS DEL MUNICIPIO DE METAPAN.
<br>

objetivo de la unidad: Promover la sana convivencia, respeto y armonía entre los ciudadanos, procurando el ejercicio de los derechos y pleno goce de los espacios públicos y privados del municipio, basándose en la armonía, respeto, tranquilidad, solidaridad y la resolución alternativa de conflictos si fuere necesario.      
<br><br>
Horarios de atención: de lunes a viernes de 8:00am – 5:00pm
<br><br>
Servicios de la unidad  contravencional:
<br>
RECEPCIÓN DE DENUNCIAS CIUDADANAS: Las denuncias deben cumplir con los requisitos mínimos de individualización del denunciado o denunciados (dirección exacta y nombre) para efectos de notificación y establecer con claridad la contravención que comete el ciudadano.
Una vez comprobada la denuncia por medio de una inspección, se da inicio al debido proceso administrativo.
<br>
PROCESOS DE MEDIACIONES: Para solventar los problemas vecinales de forma pacífica, al recibir denuncias ciudadanas, se les explica a los ciudadanos (en casos que proceda) los beneficios de someterse a una mediación como medio alterno de resolución de conflictos, siendo aceptado el proceso se remite a la Unidad de Mediación de la PGR.
<br>
ATENCIÓN DE CONTRIBUYENTES: Asesoría a las personas que se les ha iniciado un proceso administrativo sancionador, por haber contravenido la Ley Marco y Ordenanza Contravencional del municipio de Metapán, para que ejerzan su derecho de defensa.
A las personas que desean interponer una denuncia se les explica el procedimiento a seguir y los efectos y finalidades que conllevan los procesos sancionatorios.
									</p>
									<br><br><hr><br>
										<a style="color: black;" href="{{ url('/downloadc/Contravencional.pdf') }}"><strong>Ordenanza de Convivencia Ciudadana y Contravenciones Administrativas </strong></a>
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