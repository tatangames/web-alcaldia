@extends('backend.menus.indexSuperior')

@section('content-admin-css')
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />

    <!-- Toastr -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" type="text/css" rel="stylesheet" />


    <link href="{{ asset('css/estiloToggle.css') }}" type="text/css" rel="stylesheet" />

@stop
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>UCP</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                    <li class="breadcrumb-item active">Link UCP</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <form class="form-horizontal" id="form1">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Formulario</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título:</label>
                                <input type="text" id="titulo" maxlength="300" class="form-control" placeholder="Título" value="{{ $info->titulo }}">
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                <label>Descripción:</label>
                                <input type="text" id="descripcion" maxlength="300" class="form-control" placeholder="Descripción" value="{{ $info->descripcion }}">
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>LINK:</label>
                                <input type="text" id="linkucp" maxlength="300" class="form-control" placeholder="LINK" value="{{ $info->linkucp }}">
                            </div>

                        </div>
                            <div class="form-group">
                                <label>Disponibilidad</label><br>
                                <label class="switch" style="margin-top:10px">
                                    @if ($info->activo == 1)
                                        <input type="checkbox" id="toggle-editar" checked>
                                        <div class="slider round">
                                            <span class="on">Activo</span>
                                            <span class="off">Inactivo</span>
                                        </div>
                                    @else
                                        <input type="checkbox" id="toggle-editar">
                                        <div class="slider round">
                                            <span class="on">Activo</span>
                                            <span class="off">Inactivo</span>
                                        </div>
                                    @endif
                                </label>
                            </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-info float-right" onclick="actualizarDatos();">Actualizar</button>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </form>
        <!-- /form -->
    </div>
    <!-- /.container-fluid -->
</section>


@extends('backend.menus.indexInferior')

@section('content-admin-js')
    <!-- axios -->
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>

        function actualizarDatos(){
            var titulo = document.getElementById('titulo').value;
            var descripcion = document.getElementById('descripcion').value;
            var linkurl = document.getElementById('linkucp').value;

            var t = document.getElementById('toggle-editar').checked;
            var toggle = t ? 1 : 0;

            if(titulo === ''){
                toastr.error('Título es requerido');
                return;
            }

            if(descripcion === ''){
                toastr.error('Descripción es requerido');
                return;
            }

            if(linkurl === ''){
                toastr.error('Link URL es requerido');
                return;
            }


            Swal.fire({
                heightAuto: false,
                title: "Cargando..."
            })
            Swal.showLoading();

            let formData = new FormData();
            formData.append('titulo', titulo);
            formData.append('descripcion', descripcion);
            formData.append('linkurl', linkurl);
            formData.append('toggle', toggle);

            axios.post('/admin/actualizar-ucp', formData)
                .then(function (response) {
                    closeLoading();
                    if(response.data.success === 1){
                        toastr.success('Actualizado');
                    }else{
                        toastr.error('Error al actualizar');
                    }

                })
                .catch(function (error) {
                    closeLoading();
                    toastr.error("Error");
                });
        }

        function closeLoading(){
            Swal.close();
        }


    </script>

@stop
