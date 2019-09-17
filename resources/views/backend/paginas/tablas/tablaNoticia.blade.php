 <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">         
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>             
                <tr>
                  <th style="width: 25%">Nombre</th>
                  <th style="width: 25%">Fecha</th>                   
                  <th style="width: 15%">Opciones</th>            
                </tr>
                </thead>
                <tbody>
                @foreach($noticia as $dato)
                <tr>
                  <td>{{ $dato->nombrenoticia }}</td> 
                  <td>{{ $dato->fecha }}</td> 
                  <td>
                    <button type="button" class="btn btn-success btn-xs" onclick="abrirTablaFotografia({{ $dato->idnoticia }})">
                    <i class="fas fa-camera" title="Editar"></i>&nbsp; Fotos
                    </button>
                    
                    <button type="button" class="btn btn-info btn-xs" onclick="abrirModalEditar({{ $dato->idnoticia }})">
                    <i class="fas fa-pencil-alt" title="Editar"></i>&nbsp; Editar
                    </button>

                    <button type="button" class="btn btn-danger btn-xs" onclick="abrirModalEliminar({{ $dato->idnoticia }})">
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





   