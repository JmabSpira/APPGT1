<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("../../mainhead.php");?>
  <title>Lista de Expedientes</title>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <?php require_once("../../head.php");?>
    <!-- Main Sidebar Container -->
    <?php require_once("../../sidebar.php");?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Lista de Expedientes</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Lista de Expedientes</a></li>
                <li class="breadcrumb-item active"></li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lista de Expedientes</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                                <div class="form-group row">
                                    <label for="ses_id" class="col-sm-4 col-form-label">Sesión Universitaria Actual:</label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control Exp" id="ses_id" readonly>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id = "ses_data" disabled="">
                                    </div>

                                </div>
                  <br>
                  <table id="resolucion_data" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Exp</th>
                        <th>Nombres</th>
                        <th>Denominación</th>
                        <th>Fecha Aprobación</th>
                        <!-- /.card-header 
                                <th>Tipo Doc</th>
                                -->
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php require_once("../../footer.php");?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  <?php require_once("../../mainjs.php");?>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script type="text/javascript" src="mntlista.js"></script>
</body>

</html>