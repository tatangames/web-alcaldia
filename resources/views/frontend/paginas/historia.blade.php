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
								<div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
									<div class="slider-text-inner text-center">
										<h2></h2>
										<h1>Nuestra Historia</h1>
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
						<div class="col-three-forth  animate-box text-justify" style="font-size: 15px;">
							<h2>Historia</h2>
							<p>El municipio de Metapán pertenece al departamento de Santa Ana, se encuentra a 117 Km de San Salvador y está limitado por los siguientes municipios: al norte, por la República de Guatemala; al este, por los municipios de Citalá y La Palma; al sur con Agua Caliente (departamento de Chalatenango) y Nueva Concepción (departamento de Chalatenango); y al oeste por la República de Guatemala. El municipio de Metapán es el de mayor tamaño de la Región del Trifinio y uno de los dos más grandes de El Salvador. La cabecera municipal de Metapán esta situada en la zona central del territorio municipal, su altitud es 470 metros sobre el nivel del mar y posee centro histórico delimitado por Concultura. La ciudad de Metapán se encuentra emplazada en un sitio intermedio entre el Lago de Güija (sector más llano de la región) y el macizo de Montecristo (uno de los sectores con mayor altitud de la región), ambos espacios naturales de gran importancia localizados dentro del municipio.</p>
							<br>
							<p>Metapán es una antiquísima población precolombina situada en el corazón del territorio habitado desde tiempos inmemoriales por tribus mayachortis, tribus que a partir del siglo decimotercero fueron fuertemente influenciadas por los yaquis o pipiles. Fue tal el grado de fusión de los elementos autóctonos, los chortis, con los elementos civilizados, los yaquis o pipiles, que a la llegada de los españoles en la temprana mitad del siglo XVI en Metapán, Angue, Ostúa y otros pueblos comprendidos entre el cerro Brujo y el lago de Güija corría el dialecto alajuilak, mezcla de los idiomas chorti y náhuat. Se desconoce el nombre chorti de esta población, más el que aun conserva, de origen francamente náhuat, proviene de met, maguey, y apan, río. De tal suerte, que Metapán significa "río del maguey". En un informe municipal de Metapán, de 4 de diciembre de 1858, se lanza la peregrina y festinada etimología de que "Metapán quiere decir, metales tapados", lo cual no pasa de ser una puerilidad o una tomadura de pelo para los incautos. En efecto, Metapán vendría meta, metales, y tapan, tapados, ocultos. En 1550 en los pueblos gemelos de San Pedro y Santiago Metapán había una población de 1,000 habitantes poco más o menos.</p>
							<div class="row">
								<div class="col-md-6">								
								<img src="images/historia/metapanOld.jpg" alt="" srcset="" width="370" height="310">
								<br><br>
								</div>
								<div class="col-md-6">
									<p>En la primera mitad del siglo XVIII, Metapán pertenecía a la provincia de San Salvador, fue para el año 1786 que la provincia de San Salvador se convierte en Intendencia, un rango mayor usado por España. Se dividió entonces la Intendencia para su administración en 15 partidos (departamentos) uno de los cuales fue Metapán.
										Desde años antiguos Metapán gozó de opulencia y de gran actividad agrícola, minera, y ganadería, mencionándose a finales del siglo XVIII junto a San Salvador, Sonsonate, San Miguel y San Vicente como poblaciones de gran crecimiento comercial, motivo por el que en Metapán se instalaron muchas familias españolas, cabe mencionar que hoy en día es muy común ver personas de piel blanca, pelo castaño y ojos café cleloaro o miel.</p>
								</div>																								
							</div>
							<p> El 29 de Junio de 1919 se inauguró el servicio eléctrico, gracias a la maquinaria alemana que llegó a Santa Ana y que se transportó a Metapán en un tiempo de 12 días de camino y con ayuda de 24 yuntas de bueyes. En 1928 llega el ferrocarril a Metapán conocido como “la irca” (I.R.C.A. International Railways of Central America). Otro hecho recordado fue el desbordamiento del río San José el día 7 de junio de 1934, dejando decenas de damnificados y casas destruidas.</p>
							<div class="row">
							<div class="col-md-6">
									<p>1964, Cemento de El Salvador S.A. (CESSA) se traslada de Acajutla a El Ronco, Metapán, donde existe mucha piedra caliza, materia prima muy importante para la elaboración del cemento. En el año 1974 fue inaugurada la carretera pavimentada Santa Ana-Metapán-Anguiatú.
									En la actualidad es el municipio más grande del país, posee una extensión territorial de 668.36 km2, dividido en 29 cantones y 227 caseríos. Según el censo realizado en el 2007, su población es de 59,004 habitantes.</p>
								</div>
								<div class="col-md-6">								
								<img src="images/historia/trenOld.jpg" alt="" srcset="" width="370" height="210">
								
								</div>
																																
							</div>
							<p>En Metapán hay 3 celebraciones importantes en el año,  en febrero se celebra el “Domingo de Ostúa” o la “Feria de los Cantaritos” como popularmente se le llama, y lo que más se vende son dulces  en forma de cantaritos, ángeles, tecomates, y campanas entre otros. Las fiestas patronales se celebran del 20 al 29 de junio, en honor a San Pedro Apóstol. A partir de los últimos días de octubre hasta el 2 de noviembre se realiza la feria de los “Santos Difuntos”.﻿</p>
						</div>
					</div>
				</div>
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