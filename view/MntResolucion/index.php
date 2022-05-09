<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("../../mainhead.php");?>
  <title>Resoluciones</title>
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
              <h1>Resoluciones</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Resoluciones</a></li>
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
                  <h3 class="card-title">Resoluciones</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Sesión Universitaria Actual</label>
                    </div>
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Proveido del Rectorado</label>
                    </div>
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Memo. de Secretaría General</label>
                    </div>
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Memo. de Grados y Títulos</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Sesión Actual" readonly>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Proveido" readonly>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Memo SG" readonly>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Memo GT" readonly>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-12" style="text-align:center">
                      <label  for="nivel_id" class="col-form-label">Actualmente hay 178 expedientes sin procesar.</label>
                    </div>
                  </div>
                  <br>
                  <button id="btnnuevo" type="button" class="btn btn-block btn-outline-primary">Procesar
                    Expedientes</button>

                  <br>
                  <table id="resolucion_data" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
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

    <?php require_once("modalresolucion.php");?>
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

  <script type="text/javascript" src="mntresolucion.js"></script>
</body>

</html>