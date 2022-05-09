<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("../../mainhead.php");?>
    <?php require_once("../MntPersona/modalpersona.php");?>
    <title>TITULO</title>

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
                            <h1>Expediente para Título Profesional</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Expedientes</a></li>
                                <li class="breadcrumb-item active">TÍTULO</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <form method="post" id="expediente_form">
                        <div class="row">
                            <input type="hidden" id="exp_id" name="exp_id">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Información del Diploma</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <!--<form class="form-horizontal">-->
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="ses_id" class="col-sm-3 col-form-label">Sesión</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="ses_id" name = "ses_idE"
                                                    readonly="readonly">
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="ses_data" disabled="">
                                            </div>

                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group row">
                                            <label for="nivel_id" class="col-sm-3 col-form-label">Nivel Diploma</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="nivel_id" value="2" name="nivel_idE"
                                                    readonly="readonly">
                                            </div>

                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="Titulo Profesional"
                                                    disabled="">
                                            </div>

                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group row">
                                            <label for="genCop_id" class="col-sm-3 col-form-label">Generación</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dato Exp" id="genCop_id"
                                                    value="1" name="genCop_idE">
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control dato" placeholder="Original"
                                                    id="genCop_alias" disabled="">
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
                                                <input type="text" class="form-control dato Exp" id="esc_code1"
                                                    value="0" onFocus="this.select()" name="esc_codeE" autofocus>
                                            </div>
                                            <div class="col-sm-7">
                                                <select class="form-control select2 select2-hidden-accessible"
                                                    style="width: 100%;" data-select2-id="1" aria-hidden="true"
                                                    id="esc_code">
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
                                    <!--</form>-->

                                </div>
                                <div class="card card-orange">
                                    <div class="card-header">
                                        <h3 class="card-title">Información de la Resolución de la Facultad</h3>
                                    </div>
                                    <!-- form start -->
                                    <!--<form class="form-horizontal">-->
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="org_id" class="col-sm-3 col-form-label">Tipo de Resol.</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dato Exp" id="org_id" value="7"
                                                    name="org_idE">
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="org_alias"
                                                    placeholder="Decanal" disabled="">
                                            </div>

                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group row">
                                            <label for="sesTipo_id" class="col-sm-3 col-form-label">Tipo de
                                                Sesión</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dato Exp" id="sesTipo_id"
                                                    value="1" name="sesTipo_idE" disabled >
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="sesTipo_nombre"
                                                    placeholder="Ordinaria" disabled="">
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
                                                    <input type="text" class="form-control dato Exp"
                                                        data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        inputmode="numeric" id="ses_fecha" name="ses_fechaE" disabled>
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
                                                    <input type="text" class="form-control dato Exp"
                                                        data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        inputmode="numeric" id="resol_fecha" name="resol_fechaE">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="#" class="col-sm-3 col-form-label">Número</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control dato Exp new" id="resol_numero"
                                                    placeholder="Número de Doc." name="resol_numeroE">
                                            </div>
                                        </div>

                                    </div>
                                    <!--</form>-->
                                </div>
                                <!-- /.card -->
                                <div class="card card-olive">
                                    <div class="card-header">
                                        <h3 class="card-title">Información del Expediente</h3>
                                    </div>
                                    <!--<form class="form-horizontal" >-->
                                    <div class="card-body" id="formExp">
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
                                                    <input type="text" class="form-control dato Exp new"
                                                        data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        inputmode="numeric" id="resol_fechaSolicitud" name="resol_fechaSolicitudE">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control dato Exp new" placeholder="Número"
                                                    id="resol_nroSolicitud" name="resol_nroSolicitudE">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="#" class="col-sm-12 col-form-label">Memorando de la Facultad
                                                    Nº</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" class="form-control dato Exp new" placeholder="Memorando"
                                                    id=" resol_memorando" name="resol_memorandoE">
                                            </div>
                                        </div>
                                    </div>
                                    <!--</form>-->
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->

                            </div>
                            <!--/.col (left) -->
                            <!-- right column -->
                            <div class="col-md-6">
                                <!-- Form Element sizes -->
                                <div class="card card-lightblue">

                                    <div class="card-header">
                                        <h3 class="card-title">Información del Interesado</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <!--<form class="form-horizontal" id="persona_form1">-->
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <input type="hidden" id="per_idE" name="per_idE">
                                            <label for="per_id" class="col-sm-3 col-form-label">Nº Doc. Ident.</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control dato Exp new" id="per_nroDoc1"
                                                    placeholder="Ingrese Número de Doc." name="per_nroDocE">
                                            </div>
                                            <div class="col-sm-5">
                                                <button type="button" class="btn btn-block btn-outline-primary"
                                                    id="btnnuevo">Nuevo</button>

                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="per_paterno1" class="col-sm-3 col-form-label">Ap. Paterno</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control new" id="per_paterno1" disabled="">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="per_materno1" class="col-sm-3 col-form-label">Ap. Materno</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control new" id="per_materno1" disabled="">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="per_nombres1" class="col-sm-3 col-form-label">Nombres:</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control new" id="per_nombres1" disabled="">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="per_sexo1" class="col-sm-3 col-form-label">Género</label>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="per_sexo1"
                                                        id="per_sexo1" value="M" disabled="">
                                                    <label class="form-check-label" for="per_sexo">Masculino</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="per_sexo1"
                                                        id="per_sexo1" value="F" disabled="">
                                                    <label class="form-check-label" for="per_sexo">Femenino</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="docTipo_id1" class="col-sm-3 col-form-label">Tipo Doc.</label>
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
                                    <!--</form>-->


                                </div>
                                <!-- /.card -->

                                <!-- general form elements disabled -->
                                <div class="card card-maroon">
                                    <div class="card-header">
                                        <h3 class="card-title">Información del Acto Académico</h3>
                                    </div>
                                    <!--<form class="form-horizontal" id="formExp1">-->
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="actAca_id" class="col-sm-3 col-form-label">Modalidad</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control dato Exp" id="actAca_id"
                                                    value="6" name="actAca_idE">
                                            </div>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" id="actAca_alias"
                                                    placeholder="Automático" disabled="">
                                            </div>

                                        </div>

                                        <!-- /.form-group -->
                                        <div class="form-group row">
                                            <label for="fecha_actAca" class="col-sm-3 col-form-label">Fecha de
                                                Acto</label>
                                            <div class="col-sm-5">
                                                <div class="input-group" data-children-count="1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" data-children-count="0"><i
                                                                class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control dato Exp new"
                                                        data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        inputmode="numeric" id="fecha_actAca" name="fecha_actAcaE">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="den_id" class="col-sm-3 col-form-label">Denominación</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible Exp"
                                                    style="width: 100%;" data-select2-id="1" aria-hidden="true"
                                                    id="den_id" name="den_idE">
                                                    <option selected="selected" value="0">Seleccione Denominación
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="subDen_id" class="col-sm-3 col-form-label">Especialidad</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2 select2-hidden-accessible Exp"
                                                    style="width: 100%;" data-select2-id="1" aria-hidden="true"
                                                    id="subDen_id" name="subDen_idE">
                                                    <option selected="selected" value="0">Seleccione Especialidad
                                                    </option>
                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <!--</form>-->
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                                <div class="card">
                                    <div class="card-body row">
                                        <div class="col-md-6">
                                            <button type="button" id="guardarExp" value="add"
                                        class="btn btn-outline-primary btn-block Exp"><i
                                        class="fas fa-save" ></i> Guardar</button>
                                            <!--<button type="button" class="btn btn-outline-primary btn-block"
                                                id="guardarExp" name="inp"><i class="fas fa-save"></i> Guardar</button>-->
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
                    </form>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <<?php // require_once("modalpersona.php");?> <?php require_once("../../footer.php");?> <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php require_once("../../mainjs.php");?>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript" src="mnttitulo.js"></script>
    <!--<script type = "text/javascript" src="mntpersona.js"></script>-->

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