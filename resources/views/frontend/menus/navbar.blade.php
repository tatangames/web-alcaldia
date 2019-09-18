    <nav class="colorlib-nav" role="navigation">
			<div class="top-menu" style="background-color: rgb(0,0,0,0.6); height: 100px; ">
				<div class="container-fluid ">
					<div class="row">
						<div class="col-xs-2">
							<div id="colorlib-logo"><a href="#"><img src="images/LogoWeb.png" alt="" srcset="" width="400px" height="80px;" style="position: relative; top:-30px;"></a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a href="/">Inicio</a></li>
								<li><a href="noticias.html">Noticias</a></li>
								<li class="has-dropdown">
									<a href="/servicios">Servicios</a>
									<ul class="dropdown">
									@foreach($servi as $dato3)
										<li><a href="{{ url('servicio/') }}"></a>{{ $dato3->nombreservicio }}</li>
									@endforeach	
									</ul>
								</li>
								<li class="has-dropdown">
									<a href="info.html">Tu Alcad&iacute;a</a>
									<ul class="dropdown">
										<li><a href="gob.html">Gobierno municipal</a></li>
										<li><a href="historia.html">Historia</a></li>
									</ul>
								</li>
								<li><a href="/galeria">Galer&iacute;a</a></li>
								<li><a href="#colorlib-footer" class="ancla" data-ancla="colorlib-footer">Contacto</a></li>
								<li><a href="https://www.transparencia.gob.sv/institutions/alc-metapan">Portal de
										transparencia</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>