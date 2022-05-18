<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("../../mainhead.php");?>
  <title>Diploma</title>
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
              <h1>Diploma</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Diploma</a></li>
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
                  <h3 class="card-title">Diploma</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <input type="hidden" id="ses_id" name="ses_id">
                    <input type="hidden" id="dil_id" name="dil_id">
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Sesión Universitaria Actual</label>
                    </div>
                    <div class="col-3" >
                      <input type="text" class="form-control" id="ses_data" placeholder="Sesion Actual" disabled="">
                    </div>
                    <div class="col-2">
                      <label for="nivel_id" class="col-form-label">Fecha de Entrega</label>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" id="dil_fechaE" placeholder="Fecha de Entrega" disabled>
                    </div>
                  </div>
                  <br>
                  <button id="btnnuevo" type="button" class="btn btn-block btn-outline-primary">Generar Diplomas</button>
<br>
                  <table id="resolucion_data" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nro</th>
                        <th>Exp</th>
                        <th>Nombres</th>
                        <th>Denominación</th>
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

  <script type="text/javascript" src="mntdiploma.js"></script>
</body>

</html>