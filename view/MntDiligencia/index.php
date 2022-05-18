<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("../../mainhead.php");?>
    <title>Diligencia</title>
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
            <h1>Diligencia</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Diligencia</a></li>
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
                            <h3 class="card-title">Diligencias</h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button id = "btnnuevo" type="button" class="btn btn-block btn-outline-primary">Nueva Diligencia</button>
                            <br>
                            <table id="diligencia_data" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Sesion</th>
                                <th>Proveido Rectorado</th>
                                <th>Memo. Sec. Gen.</th>
                                <th>Memo. GyT</th>
                                <th>Fecha Entrega</th>
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

  <?php require_once("modaldiligencia.php");?>
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
    <script type = "text/javascript" src="mntdiligencia.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
  //  $('.select2').select2()

    //Initialize Select2 Elements
  /*  $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
*/
    //Datemask dd/mm/yyyy
    //$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    $('#datemask').inputmask('yyyy/mm/dd', { 'placeholder': 'yyyy/mm/dd' })

    $('[data-mask]').inputmask()

  })
</script>
</body>
</html>