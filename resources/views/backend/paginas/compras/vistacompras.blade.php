@extends('backend.menus.indexSuperior')

@section('content-admin-css')
    <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <!-- data table -->
    <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <!-- mensaje toast -->
    <link href="{{ asset('plugins/toastr/toastr.min.css') }}" type="text/css" rel="stylesheet" />

@stop

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-3">
                <h1>Lista de Compras Públicas</h1>
            </div>
            <div class="col-sm-2">
                <button type="button" onclick="abrirModalAgregar()" class="btn btn-info btn-sm">
                    <i class="fas fa-pencil-alt"></i>
                    Nuevo Proceso
                </button>
            </div>
        </div>
    </div>
</section>


<!-- seccion frame -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Imagenes</h3>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="tablaDatatable"></div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.section -->



<!-- modal agregar nueva compra-->
<div class="modal fade" id="modalAgregar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Nuevo Proceso</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" class="form-control" autocomplete="off" maxlength="300" id="titulo-nuevo" placeholder="Título del Archivo">
                                </div>

                                <div class="form-group">
                                    <label>Descripción</label>
                                    <input type="text" class="form-control" autocomplete="off" maxlength="800" id="descripcion-nuevo" placeholder="Descripción del Archivo">
                                </div>

                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="date" class="form-control" id="fecha-nuevo" placeholder="Fecha">
                                </div>

                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Imagen</label>
                                    <input type="file" class="form-control" id="documento" accept="image/png, image/gif, image/jpeg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnGuardar" onclick="guardarDocumento()">Guardar</button>
            </div>

        </div>
    </div>
</div>





@extends('backend.menus.indexInferior')

@section('content-admin-js')

    <!-- data table -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>


    <!-- incluir tabla -->
    <script type="text/javascript">
        $(document).ready(function(){
            var ruta = "{{ URL::to('admin/listar/compras/tabla') }}";
            $('#tablaDatatable').load(ruta);
        });
    </script>

    <script>

        function recargar(){
            var ruta = "{{ URL::to('admin/listar/compras/tabla') }}";
            $('#tablaDatatable').load(ruta);
        }

        function abrirModalAgregar(){
            document.getElementById("formulario").reset();
            $('#modalAgregar').modal('show');
        }


        function guardarDocumento(){

            var titulo = document.getElementById('titulo-nuevo').value;
            var descripcion = document.getElementById('descripcion-nuevo').value;
            var fecha = document.getElementById('fecha-nuevo').value;

            var documento = document.getElementById('documento');

            if(titulo === ''){
                toastr.error('Título es requerido');
                return;
            }

            if(fecha === ''){
                toastr.error('Fecha es requerido');
                return;
            }

            if(documento.files && documento.files[0]){ // si trae doc
                if (!documento.files[0].type.match('image/jpeg|image/jpeg|image/png')){
                    toastr.error('formato permitidos: .png .jpg .jpeg');
                    return;
                }
            }else{
                toastr.error('Imagen es requerida');
                return;
            }

            let formData = new FormData();
            formData.append('titulo', titulo);
            formData.append('descripcion', descripcion);
            formData.append('fecha', fecha);
            formData.append('documento', documento.files[0]);

            axios.post('/admin/listar/compras/nuevo', formData, {
            })
                .then((response) => {

                    closeLoading();

                    if(response.data.success === 1){
                        toastr.success('Agregado correctamente');
                        $('#modalAgregar').modal('hide');
                        recargar();
                    }else{
                        toastr.error('error al cargar datos');
                    }


                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('error al cargar datos');
                });
        }



        function abrirModalEliminar(id){

            Swal.fire({
                title: 'Eliminar Registro?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                   borrarRegistro(id);
                }
            })
        }


        function borrarRegistro(id){

            openLoading();

            let formData = new FormData();
            formData.append('id', id);

            axios.post('/admin/listar/compras/borrar', formData, {
            })
                .then((response) => {

                    closeLoading();

                    if(response.data.success === 1){
                        toastr.success('Borrado correctamente');
                        recargar();
                    }else{
                        toastr.error('error al borrar');
                    }

                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('error al borrar');
                });

        }





    </script>



@stop
