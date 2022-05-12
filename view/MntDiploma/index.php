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
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Sesión Universitaria Actual</label>
                    </div>
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Fecha de Entrega</label>
                    </div>
                    <div class="col-3">
                      <label for="nivel_id" class="col-form-label">Nro Resolución Inicial</label>
                    </div>
                  </div>  
                  <div class="row">
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Sesión Actual" readonly>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Fecha de entrega" readonly>
                    </div>
                    <div class="col-3">
                      <input type="text" class="form-control" placeholder="Nro Resolución Inicial" readonly>
                    </div>
                    <div class="col-3">
                      <button id="btnnuevo" type="button" class="btn btn-block btn-outline-primary">Generar Diplomas</button>
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
                        <th>RCU Nº</th>
                        <!-- /.card-header 
                                <th>Diploma Nº</th>
                                -->
                        <th>Doc.</th>
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

    <?php require_once("modaldiploma.php");?>
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
    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })

            $('[data-mask]').inputmask()

        })
    </script>
</body>

</html>