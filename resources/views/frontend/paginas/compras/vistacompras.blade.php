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
                <li style="background-image: url({{ asset('images/imagen_finanzas.jpg')}});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                                <div class="slider-text-inner text-center">
                                    <h1><strong>Compras Públicas</strong></h1>

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

                <br><br><br><hr>

                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-10">
                                <div class="card">
                                    <div class="card-body">


                                        @foreach($arrayCompras as $info)

                                            <div class="col-md-8">


                                                <div class="columns small-24 medium-24 large-20 small-order-3 medium-order-2 large-order-4">

                                                    <div style="float: right;" class="columns small-8 medium-8 large-4 small-order-4 medium-order-4 large-order-3">
                                                        <div class="col-md-12 animate-box">
                                                            <img class="img-responsive" src="{{ asset('storage/slider/'.$info->documento)}}" height="200px" width="200px" alt="" data-toggle="modal" data-target="#modal1" onclick="getPath(this)">
                                                        </div>
                                                    </div>



                                                    <div class="text-bold" style="font-size: 17px">
                                                        <br>
                                                        <strong>Año:</strong> {{ $info->fechaAnio }}
                                                    </div>

                                                    @if($info->descripcion != null)
                                                        <div class="text-bold" style="font-size: 17px">
                                                            <br>
                                                            <strong>{{ $info->titulo }}</strong>
                                                        </div>
                                                    @endif

                                                    <div class="text-bold" style="font-size: 17px">
                                                        <br>
                                                        Fecha Creación: {{ $info->fechaFormat }}
                                                    </div>
                                                    <div class="text-bold" style="font-size: 17px">
                                                        {{ $info->descripcion }}
                                                    </div>

                                                </div>

                                                <hr>
                                                <hr>
                                            </div>


                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>




            </div>
            <br><br>
        </div>
    </div>


    <!--Cuadro modal para el Zoom de las fotos-->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <!--Contenido-->
            <div class="modal-content">
                <div class="modal-body mb-0 p-0">
                    <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                        <img id="imgModal" src=""  class="embed-responsive-item" alt="">
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
            <!--Fin Contenido-->
        </div>
    </div>
    <!--End Cuadro modal-->

    <!--End Contenido-->
    @include("frontend.menus.footer")
    <script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){

        });
    </script>

    <script type="text/javascript">
        function getPath(img) {
            atributo = img.getAttribute("src");
            document.getElementById("imgModal").setAttribute("src", atributo);
        }
    </script>

</body>


