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

                                        <li><strong><a href="#" onclick="verReunion();">UCP</a></strong></li>

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



    <div class="modal fade" id="modalUCP">
        <div class="modal-dialog" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tituloucp" style="font-size: 16px"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formulario-ucp">
                        <div class="card-body">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group" style="margin-top: 15px">
                                            <label id="descripcionlink" style="font-size: 17px"></label>
                                        </div>

                                        <div class="form-group" style="text-align: center">
                                            <a style="color: blue; font-size: 18px" href="#" target="_blank" id="myLink"><strong>LINK UCP</strong></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script>

        function verReunion(){

            openLoading();

            axios.post('/admin/informacion-ucp', {
            })
                .then((response) => {

                    closeLoading();

                    if(response.data.success === 1){

                        Swal.fire({
                            title: 'Link no disponible',
                            text: "Comunicarse con Jefe de UCP",
                            icon: 'info',
                            showCancelButton: false,
                            allowOutsideClick: false,
                            confirmButtonColor: '#28a745',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            if (result.isConfirmed) {

                            }
                        })
                    }
                    if(response.data.success === 2){
                        abrirPanel(response);
                    }
                    else {
                        toastr.error('Error');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('Error');
                });
        }

        function abrirPanel(response){

            document.getElementById('tituloucp').innerHTML = response.data.titulo;
            document.getElementById('descripcionlink').innerHTML = response.data.descripcion;

            document.getElementById("myLink").href= response.data.urllink;

            $('#modalUCP').modal('show');
        }

        function openLoading(){
            Swal.fire({
                heightAuto: false,
                title: "Cargando..."
            })
            Swal.showLoading();
        }

        function closeLoading(){
            Swal.close();
        }


    </script>
