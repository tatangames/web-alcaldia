<!--Parte superior de las paginas -  hasta head  -->
@include('frontend.menus.indexSuperior')
<body>
	<div class="colorlib-loader"></div>
	<div id="page">
		<!--Barra de navegacion -->
		@include("frontend.menus.navbar")
		<!--End Barra de navegacion-->
        
		<!--Contenido-->
		<div id="colorlib-about">
			<div class="container">
				<div class="row">
                <iframe src="https://www.flipbookpdf.net/web/site/a0b73fa56d0f5f14a15051381e493a6b20ab6e6b202106.pdf.html" width="100%" height="650" seamless="seamless" scrolling="no" frameBorder="0" style="margin-top: 5.8%;"allowFullScreen></iframe>
               
                <!--<iframe src="https://metapanfiestas.alcaldiademetapan.gob.sv/index.html" width="100%" height="650" seamless="seamless" scrolling="no" frameBorder="0" style="margin-top: 5.8%;"allowFullScreen></iframe>
                 -->
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