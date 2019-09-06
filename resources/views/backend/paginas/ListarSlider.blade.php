@extends('backend.menus.indexSuperior')
 
@section('content-admin-css')
    <!-- data table -->
    <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" /> 
@stop

<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">         
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>             
                <tr>
                  <th style="width: 25%">Nombre</th>
                  <th style="width: 25%">Posición</th>
                  <th style="width: 50%">Imagen</th>               
                </tr>
                </thead>
                <tbody>
                @foreach($slider as $dato)
                <tr>
                  <td>{{ $dato->nombreslider }}</td>
                  <td>{{ $dato->posicion }}</td>
                  <td><center><img alt="Slider" src="{{ asset('images'.'/'.'Slider'.'/'.$dato->fotografia) }}" width="150px" height="150px" /></center></td>    
                </tr>
                @endforeach            
                </tbody>            
              </table>
            </div>          
          </div>
        </div>
      </div>
    </section>

	
@extends('backend.menus.indexInferior')

@section('content-admin-js')	

  <!-- data table -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

  <script>
    $(function () {
      $('#example1').DataTable({
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

@stop
