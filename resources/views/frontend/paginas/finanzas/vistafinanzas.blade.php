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
                                    <h1><strong>Informes Financieros</strong></h1>

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


                                        @foreach($finanzas as $info)


                                            <div class="col-md-8">
                                                <div style="float: right; font-weight: bold" class="columns small-8 medium-8 large-4 small-order-4 medium-order-4 large-order-3">

                                                    <a href="{{ url('/descargar/finanzas/documento/'.$info->id) }}" style="font-weight: bold; color: white !important;">
                                                       <img src="{{ asset('images/logopdf.png') }}" alt="PDF" class="img-responsive" width="35" height="35">
                                                    </a>
                                                 PDF
                                                </div>


                                                <div class="columns small-24 medium-24 large-20 small-order-3 medium-order-2 large-order-4">


                                                    <a href="{{ url('/descargar/finanzas/documento/'.$info->id) }}">
                                                        <div class="text-mutted" style="font-size: 20px; font-weight: bold; color: black">
                                                            {{ $info->titulo }}
                                                        </div>
                                                    </a>

                                                    <div class="text-bold" style="font-size: 17px">

                                                        <br>
                                                        Año: {{ $info->fechaanio }}
                                                    </div>
                                                    <div class="text-bold" style="font-size: 17px">

                                                        <br>
                                                        Fecha Creación: {{ $info->fechaformato }}
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
    <!--End Contenido-->
    @include("frontend.menus.footer")
    <script src="{{ asset('js/frontend.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){

        });
    </script>

</body>


