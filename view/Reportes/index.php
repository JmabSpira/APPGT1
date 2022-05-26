<!DOCTYPE html>
<html lang="es">

<head>
  <?php require_once("../../mainhead.php");?>
  <title>Reportes</title>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
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
              <h1>Reporte</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Reporte</a></li>
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
                  <h3 class="card-title">Reporte</h3>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <div class="form-group row">
                    <label for="ses_id" class="col-sm-3 col-form-label">Seleccionar Expedientes:</label>
                    <div class="col-sm-5">
                      <?php 
                      $d = $_GET['filtro'];
                      ?>
                      <input type="hidden" id="dato" name="dato" value ="<?php echo $d; ?>">
                      <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                        data-select2-id="1" aria-hidden="true" id="filtro">
                        <option selected="selected" value="0">Seleccione</option>
                      </select>
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
                        <th>Modalidad</th>
                        <th>Fecha Aprobación</th>
                        <th>Sesion CU</th>
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

  <script type="text/javascript" src="mntreporte.js"></script>
</body>

</html>