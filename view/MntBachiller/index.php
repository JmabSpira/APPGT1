<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("../../mainhead.php");?>
    <title>Bachiller</title>

        <link rel="stylesheet" href="../../public/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../../public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        
        <!--
        <link rel="stylesheet" href="../../public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        -->
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
            <h1>Expediente para Grado de Bachiller</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Expedientes</a></li>
              <li class="breadcrumb-item active">Bachiller</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Información de Trámite</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Sesión</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="123">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="CU - O: 24/06/2021" disabled="">
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Generación</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Original" disabled="">
                                        <!--
                                        <select class="custom-select" disabled="" style="width: 100%;">
                                            <option>Seleccione Generación Copia</option>
                                            <option>Original</option>
                                            <option>Duplicado</option>
                                            <option>2do Duplicado</option>
                                            <option>3er Duplicado</option>
                                            <option>Otro</option>
                                        </select>
                                        -->
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Nivel Diploma</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="custom-select" style="width: 100%;">
                                            <option>Seleccione Tipo de Diploma</option>
                                            <option>Grado de Bachiller</option>
                                            <option>Título Profesional</option>
                                            <option>Maestría</option>
                                            <option>Doctorado</option>
                                        </select>
                                    </div>

                                </div>
                                <!--
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Facultad</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="custom-select" style="width: 100%;">
                                            <option>Seleccione Facultad</option>
                                            <option>FIMGC</option>
                                            <option>FCS</option>
                                            <option>FCPD</option>
                                            <option>FCE</option>
                                        </select>
                                    </div>
                                
                                </div>
                                -->
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Escuela</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="custom-select" style="width: 100%;">
                                            <option>Seleccione Escuela</option>
                                            <option>Ingenieria de Sistemas</option>
                                            <option>Ingeniería Civil</option>
                                            <option>Derecho</option>
                                            <option>Agronomía</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Información de la Resolución</h3>
                        </div>
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Tipo de Resol.</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="del Consejo de Facultad"
                                            disabled="">
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Tipo de Sesión</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="2">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Extraordinaria"
                                            disabled="">
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Fecha Sesión</label>
                                    <div class="col-sm-5">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Fecha de Doc.</label>
                                    <div class="col-sm-5">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Número</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="#" placeholder="Número de Doc.">
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Información de la Solicitud</h3>
                        </div>
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="#" class="col-sm-12 col-form-label">Fecha</label>
                                    </div>
                                    <div class="col-6">
                                        <label for="#" class="col-sm-12 col-form-label">Número</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Número">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
                    <!-- Form Element sizes -->
                    <div class="card card-primary">
                        
                        <div class="card-header">
                            <h3 class="card-title">Información del Interesado</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Nº Doc. Ident.</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="#"
                                            placeholder="Ingrese Número de Doc.">
                                    </div>
                                    <div class="col-sm-5">
                                        <button type="button" class="btn btn-block btn-outline-primary">Nuevo</button>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Ap. Paterno</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="#" disabled="">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Ap. Materno</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="#" disabled="">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Nombres:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="#" disabled="">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Género</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="per_sexo" id="per_sexo"
                                                value="M" disabled="">
                                            <label class="form-check-label" for="per_sexo">Masculino</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="per_sexo" id="per_sexo"
                                                value="F" disabled="">
                                            <label class="form-check-label" for="per_sexo">Femenino</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Tipo Doc.</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" style="width: 100%;" id="docTipo_id"
                                            name="docTipo_id" disabled="">
                                            <option data-select2-id="3" value="1">Otros</option>
                                            <option selected="selected" data-select2-id="30" value="2">DNI</option>
                                            <option data-select2-id="31" value="3">RUC</option>
                                            <option data-select2-id="32" value="4">LM</option>
                                            <option data-select2-id="33" value="5">C.E.</option>
                                            <option data-select2-id="34" value="6">PASAPORTE</option>
                                            <option data-select2-id="35" value="7">P.NAC.</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                        </form>
                        

                    </div>
                    <!-- /.card -->

                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Información del Acto Académico</h3>
                        </div>
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Modalidad</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="#" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Automático" disabled="">
                                    </div>

                                </div>

                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Fecha de Acto</label>
                                    <div class="col-sm-5">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Denominación</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" style="width: 100%;">
                                            <option>Seleccione Denominacion</option>
                                            <option>Bachiller en Ciencias de la Ingeniería de Sistemas</option>
                                            <option>Bachiller en Ciencias de la Ingeniería Civil</option>
                                            <option>FCPD</option>
                                            <option>FCE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Especialidad</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" style="width: 100%;">
                                            <option>Seleccione Especialidad</option>
                                            <option>: Historia</option>
                                            <option>: Arqueología</option>
                                        </select>
                                    </div>

                                </div>

                            </div>
                        </form>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-body row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-primary btn-block"><i
                                        class="fas fa-save"></i> Guardar</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-danger btn-block"><i
                                        class="fas fa-times"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.col (right) -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

  <<?php // require_once("modalpersona.php");?>
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

    <!--<script type = "text/javascript" src="mntpersona.js"></script>-->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $('[data-mask]').inputmask()

  })
</script>
</body>
</html>