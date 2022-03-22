<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once("../../mainhead.php");?>
    <?php require_once("../MntPersona/modalpersona.php");?>
    <title>Bachiller</title>

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
                            <h3 class="card-title">Información del Diploma</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="ses_id" class="col-sm-3 col-form-label">Sesión</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="ses_id" value="123" disabled>
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id = "ses_data" disabled="">
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="nivel_id" class="col-sm-3 col-form-label">Nivel Diploma</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="nivel_id" value="1" disabled>
                                    </div>
                                   
                                    <div class="col-sm-7">
                                    <input type="text" class="form-control" placeholder="Grado de Bachiller" disabled="">    
                                    <!--
                                        <select class="custom-select" style="width: 100%;" >
                                            <option>Seleccione Tipo de Diploma</option>
                                            <option>Grado de Bachiller</option>
                                            <option>Título Profesional</option>
                                            <option>Maestría</option>
                                            <option>Doctorado</option>
                                        </select>
                                        -->
                                    </div>
                                    
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="genCop_id" class="col-sm-3 col-form-label">Generación</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="genCop_id" value="1">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="Original" id = "genCop_alias" disabled="">
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

                                <div class="form-group row">
                                    <label for="esc_code1" class="col-sm-3 col-form-label">Escuela</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="esc_code1" value="0" onFocus="this.select()" name = "input_exp" autofocus>
                                    </div>
                                    <div class="col-sm-7">
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            data-select2-id="1"  aria-hidden="true" id="esc_code" name="esc_code">
                                            <option selected="selected" value="0">Seleccione Escuela</option>
                                        </select>
                                        <!--
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="esc_code" name="esc_code">
                                            <option selected="selected" value="0" >Seleccione Escuela</option>
                                            <
                                            <option>Ingenieria de Sistemas</option>
                                            <option>Ingeniería Civil</option>
                                            <option>Derecho</option>
                                            <option>Agronomía</option>
                                            
                                        </select> 
                                    -->
                                    </div>

                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Información de la Resolución de la Facultad</h3>
                        </div>
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="org_id" class="col-sm-3 col-form-label">Tipo de Resol.</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="org_id" value="7"  name = "input_exp">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id = "org_alias" placeholder = "Decanal" disabled="">
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="sesTipo_id" class="col-sm-3 col-form-label">Tipo de Sesión</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="sesTipo_id" value="1" disabled name = "input_exp">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id = "sesTipo_nombre" placeholder="Ordinaria"
                                            disabled="">
                                    </div>

                                </div>
                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="ses_fecha" class="col-sm-3 col-form-label">Fecha Sesión</label>
                                    <div class="col-sm-5">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric" id = "ses_fecha" name = "input_exp" disabled>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="ada" class="col-sm-3 col-form-label">Fecha de Doc.</label>
                                    <div class="col-sm-5">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric" id = "resol_fecha" name = "input_exp">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Número</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="resol_numero" placeholder="Número de Doc." name = "input_exp">
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Información del Expediente</h3>
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
                                                inputmode="numeric" id = "resol_fechaSolicitud" name = "input_exp">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control" placeholder="Número" id = "resol_nroSolicitud" name = "input_exp">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="#" class="col-sm-12 col-form-label">Memorando de la Facultad Nº</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="Memorando" id= " resol_memorando" name = "input_exp">
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
                                    <input type="hidden" id="per_id1" name="per_id1">
                                    <label for="per_id" class="col-sm-3 col-form-label">Nº Doc. Ident.</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="per_nroDoc1"
                                            placeholder="Ingrese Número de Doc." name = "input_exp">
                                    </div>
                                    <div class="col-sm-5">
                                        <button type="button" class="btn btn-block btn-outline-primary" id = "btnnuevo">Nuevo</button>
                                         
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Ap. Paterno</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="per_paterno1" disabled="">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Ap. Materno</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="per_materno1" disabled="">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Nombres:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="per_nombres1" disabled="">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Género</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="per_sexo1" id="per_sexo1"
                                                value="M" disabled="">
                                            <label class="form-check-label" for="per_sexo">Masculino</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="per_sexo1" id="per_sexo1"
                                                value="F" disabled="">
                                            <label class="form-check-label" for="per_sexo">Femenino</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Tipo Doc.</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" style="width: 100%;" id="docTipo_id1"
                                            name="docTipo_id" disabled="">
                                            <option value="1">Otros</option>
                                            <option selected="selected" value="2">DNI</option>
                                            <option value="3">RUC</option>
                                            <option value="4">LM</option>
                                            <option value="5">C.E.</option>
                                            <option value="6">PASAPORTE</option>
                                            <option value="7">P.NAC.</option>
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
                                    <label for="actAca_id" class="col-sm-3 col-form-label">Modalidad</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="actAca_id" value="6" name = "input_exp">
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id = "actAca_alias" placeholder="Automático" disabled="">
                                    </div>

                                </div>

                                <!-- /.form-group -->
                                <div class="form-group row">
                                    <label for="fecha_actAca" class="col-sm-3 col-form-label">Fecha de Acto</label>
                                    <div class="col-sm-5">
                                        <div class="input-group" data-children-count="1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" data-children-count="0"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="text" class="form-control" data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                inputmode="numeric" id = "fecha_actAca" name = "input_exp">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Denominación</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                                            data-select2-id="1" aria-hidden="true" id="den_id" name="den_id" name = "input_exp">
                                            <option selected="selected" value="0">Seleccione Denominación</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="#" class="col-sm-3 col-form-label">Especialidad</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select" style="width: 100%;" disabled>
                                            <option>Seleccione Especialidad</option>
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
                                        class="fas fa-save" name = "input_exp"></i> Guardar</button>
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

    <script type = "text/javascript" src="mntbachiller.js"></script>
    <!--<script type = "text/javascript" src="mntpersona.js"></script>-->

<script>
  $(function () {
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

    $('[data-mask]').inputmask()

  })
</script>
</body>
</html>