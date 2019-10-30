    <nav class="colorlib-nav" role="navigation">
    	<div class="top-menu" style="background-color: background: rgb(26,54,96);
background: linear-gradient(90deg, rgba(26,54,96,1) 16%, rgba(68,116,185,1) 28%, rgba(156,198,241,1) 40%, rgba(255,255,255,1) 60%); height: 100px; ">
    		<div class="container-fluid ">
    			<div class="row">
    				<div class="col-xs-4">
    					<div id="colorlib-logo"><img class="logoimage" src="{{ asset('images/LogoWeb.png') }}" alt="Alcaldia Municipal de Metapan" width="90%" height="80%" style="margin-top: -30px"></div>
    				</div>
    				<div class="col-xs-8 text-right menu-1">
    					<ul>
    						<li class="active"><strong><a href="/">Inicio</a></strong></li>
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
    								<li><strong><a href="{{ url('direccion/') }}">Gobierno municipal</a></strong></li>
    								<li><strong><a href="{{ url('historia/') }}">Historia</a></strong></li>
    							</ul>
    						</li>
    						<li><strong><a href="{{ url('galeria/') }}">Galer&iacute;a</a></strong></li>
    						<li><strong><a href="#colorlib-footer" class="ancla" data-ancla="colorlib-footer">Contacto</a></strong></li>
    						<li><strong><a href="https://www.transparencia.gob.sv/institutions/alc-metapan">Portal de
    								transparencia</a></strong></li>
    					</ul>
    				</div>
    			</div>
    		</div>
    	</div>
    </nav>

  
