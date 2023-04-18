    <nav class="colorlib-nav" role="navigation">
    	<div class="top-menu" style="background-color: rgb(238,238,238); height: 60px;">
    		<div class="container-fluid ">
    			<div class="row">
    				<div class="col-xs-3">
    					<div id="colorlib-logo"><a href="/"><img class="logoimage" src="{{ asset('images/LogoWeb.png') }}" alt="Alcaldia Municipal de Metapan" width="35%" height="10%" style="margin-top: -42px"></div>
    				</div>
    				<div class="col-xs-9 text-right menu-1">
    					<ul>
    						<li class="active"><strong><a href="/">Inicio</a></strong></li>
							<!-- Pestaña para revista -->
							<li><strong><a href="{{ url('https://metapanfiestas.alcaldiademetapan.gob.sv/index.html') }}" target="_blank">Revista</a></strong></li>
							<!-- fin pesta;a revista -->
    						<li><strong><a href="{{ url('noticias/') }}">Noticias</a></strong></li>
    						<li class="has-dropdown"><strong>
    							<a >Servicios</a></strong>
    							<ul class="dropdown">
    								@foreach($serviciosMenu as $dato3)
    								<li><strong><a href="{{ url('servicio/'.$dato3->slug) }}">{{$dato3->nombreservicio}}</a></strong></li>
									@endforeach
									<li><strong><a href="{{ url('servicios/') }}">Ver todos</a></strong></li>
    							</ul>
    						</li>
    						<li class="has-dropdown"><strong>
    							<a>Tu Alcad&iacute;a</a></strong>
    							<ul class="dropdown">
								<li><strong><a href="{{ url('programas/') }}">Programas Municipales</a></strong></li>
									<li><strong><a href="{{ url('direccion/') }}">Gobierno municipal</a></strong></li>
    								<li><strong><a href="{{ url('historia/') }}">Historia</a></strong></li>
    							</ul>
    						</li>
    						<li><strong><a href="{{ url('galeria/') }}">Galer&iacute;a</a></strong></li>
    						<li><strong><a href="#colorlib-footer" class="ancla" data-ancla="colorlib-footer">Contacto</a></strong></li>
    						<li><strong><a href="{{ url('contravencional/') }}">Unidad Contravencional</a></strong></li>
							<li><strong><a href="https://www.transparencia.gob.sv/institutions/alc-metapan">Portal de transparencia</a></strong></li>
    						
    					</ul>
    				</div>
    			</div>
    		</div>
    	</div>
    </nav>

  

