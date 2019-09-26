    <nav class="colorlib-nav" role="navigation">
			<div class="top-menu" style="background-color: rgb(0,0,0,0.6); height: 100px; ">
				<div class="container-fluid ">
					<div class="row">
						<div class="col-xs-4">
							<div id="colorlib-logo"><img class="logoimage" src="{{ asset('images/LogoWeb.png') }}" alt="Alcaldia Municipal de Metapan" width="90%" height="80%" style="margin-top: -30px" ></div>
						</div>
						<div class="col-xs-8 text-right menu-1">
							<ul>
								<li class="active"><a href="/">Inicio</a></li>
								<li><a href="{{ url('noticias/') }}">Noticias</a></li>
								<li id="caso1" class="has-dropdown">
								    <a href="{{ url('servicios/') }}">Servicios</a>
									<ul class="dropdown">
									@foreach($serviciosMenu as $dato3)
										<li><a href="{{ url('servicio/'.$dato3->slug) }}">{{$dato3->nombreservicio}}</a></li>
									@endforeach	
									</ul>
								</li>
								<li class="has-dropdown">
									<a>Tu Alcad&iacute;a</a>
									<ul class="dropdown">
										<li><a href="{{ url('direccion/') }}">Gobierno municipal</a></li>
										<li><a href="{{ url('historia/') }}">Historia</a></li>
									</ul>
								</li>
								<li><a href="{{ url('galeria/') }}">Galer&iacute;a</a></li>
								<li><a href="#colorlib-footer" class="ancla" data-ancla="colorlib-footer">Contacto</a></li>
								<li><a href="https://www.transparencia.gob.sv/institutions/alc-metapan">Portal de
										transparencia</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>