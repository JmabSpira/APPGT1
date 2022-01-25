<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("../../mainhead.php");?>
    <title>Subdenominacion</title>
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
            <h1>Subdenominacion</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Subdenominacion</a></li>
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
                            <h3 class="card-title">Sub Denominaciones</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <br>
                            <button id = "btnnuevo" type="button" class="btn btn-block btn-outline-primary">Nuevo Registro</button>
                            

                            <br>
                            <table id="subdenominacion_data" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Nivel</th>
                                <th>Subdenominacion</th>
                                <th>Subdenominacion</th>
                                <!-- /.card-header 
                                <th>Tipo Doc</th>
                                -->
                                
                                <th></th>
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

  <?php require_once("modalsubdenominacion.php");?>
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
    
    <script type = "text/javascript" src="mntsubdenominacion.js"></script>
</body>
</html>