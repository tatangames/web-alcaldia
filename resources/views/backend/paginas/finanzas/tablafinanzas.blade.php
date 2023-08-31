<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 15%">Fecha</th>
                            <th style="width: 20%">Título</th>
                            <th style="width: 30%">Descripción</th>
                            <th style="width: 10%">Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listado as $dato)
                            <tr>
                                <td>{{ $dato->fecha }}</td>
                                <td>{{ $dato->titulo }}</td>
                                <td>{{ $dato->descripcion }}</td>

                                <td>

                                    <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->id }})">
                                        <i class="fas fa-trash-alt" title="Eliminar"></i>&nbsp; Eliminar
                                    </button>

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas"
            }
        });
    });
</script>




