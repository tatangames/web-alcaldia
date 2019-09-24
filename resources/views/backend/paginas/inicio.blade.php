<!DOCTYPE html>
<html lang="es">

<head>
  <title>Panel de control</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- libreria fuentes adminlte3 -->
  <link href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}" type="text/css" rel="stylesheet" />
  <!-- libreria estilos adminlte3 -->
  <link href="{{ asset('css/backend/adminlte3/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="{{ asset('css/backend/adminlte3/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>

<body class="hold-transition sidebar-mini">
  

  <!-- Main content -->
  <div class="wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-12">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pantalla Principal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Resumen de publicaciones</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $conteoPrograma }}</h3>

                <p>Programas Municipales</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a class="small-box-footer"><i class="icon ion-pie-graph"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <h3>{{ $conteoServicio }}</h3>

                <p>Servicios Municipales</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-briefcase"></i>
              </div>
              <a class="small-box-footer"><i class="icon ion-pie-graph"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $conteoNoticia }}</h3>

                <p>Noticias </p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-paper"></i>
              </div>
              <a class="small-box-footer"><i class="icon ion-pie-graph"></i></a>
            </div>
          </div>
          <!-- ./col -->


        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-gray">
              <div class="card-header">
                <h3 class="card-title">Visitas Mensuales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- /col-md-6 -->
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-gray">
              <div class="card-header">
                <h3 class="card-title">Descargas Mensuales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart2" style="height:250px; min-height:250px"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- /col-md-6 -->
        </div>
        <!-- /.content -->

        <!-- /.content-wrapper -->
      </div>
    </section>
  </div>


  <!-- libreria jquery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
  <!-- libreria bootstrap4 -->
  <script src="{{ asset('plugins/bootstrap/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
  <!-- libreria adminlte3 -->
  <script src="{{ asset('js/backend/adminlte3/adminlte.min.js') }}" type="text/javascript"></script>
  <!-- ChartJS -->
  <script src="{{ asset('js/backend/adminlte3/Chart.min.js') }}"></script>

  @yield('content-admin-js')
  <script>
  $(function () {
    //--------------
    //- AREA CHART -
    //--------------
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    var areaChartCanvas2 = $('#areaChart2').get(0).getContext('2d')

    var areaChartData = {
      labels  : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      datasets: [
        {
          label               : 'Visitas del mes',
          backgroundColor     : 'rgba(0,153,0,0.5)',
          borderWidth         : 0,
          pointRadius         : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{{$visene}}, {{$visfeb}}, {{$vismar}}, {{$visabr}}, {{$vismay}}, {{$visjun}}, {{$visjul}},
                                 {{$visago}}, {{$vissep}}, {{$visoct}}, {{$visnov}}, {{$visdic}}]
        }
      ]
    }
    var areaChartData2= {
      labels  : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
      datasets: [
        {
          label               : 'Descargas del mes',
          backgroundColor     : 'rgba(255,51,51,0.5)',
          borderWidth         : 0,
          pointRadius         : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [{{$dowene}}, {{$dowfeb}}, {{$dowmar}}, {{$dowabr}}, {{$dowmay}}, {{$dowjun}}, {{$dowjul}},
                                 {{$dowago}}, {{$dowsep}}, {{$dowoct}}, {{$downov}}, {{$dowdic}}]
        }
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas, { 
      type: 'line',
      data: areaChartData, 
      options: areaChartOptions
    })
     // This will get the first returned node in the jQuery collection.
     var areaChart2       = new Chart(areaChartCanvas2, { 
      type: 'line',
      data: areaChartData2, 
      options: areaChartOptions
    })
  })
</script>
</body>

</html>