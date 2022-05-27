<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" id="bachiller_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltituloB"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="exp_id" name="exp_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info">
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
                                            <input type="text" class="form-control" id="ses_id" name="ses_idE"
                                                readonly="readonly" required>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="ses_data" disabled="">
                                        </div>

                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group row">
                                        <label for="nivel_id" class="col-sm-3 col-form-label">Nivel Diploma</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="nivel_id" value="1"
                                                name="nivel_idE" readonly="readonly" required>
                                        </div>

                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" value="Grado de Bachiller"
                                                disabled="">
                                        </div>

                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group row">
                                        <label for="genCop_id" class="col-sm-3 col-form-label">Generación</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control dato Exp" id="genCop_id" value="1"
                                                name="genCop_idE" onFocus="this.select()" required>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" placeholder="Original"
                                                id="genCop_alias" disabled="">
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label for="esc_code1" class="col-sm-3 col-form-label">Escuela</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control dato Exp" id="esc_code1" value="0"
                                                onFocus="this.select()" name="esc_codeE" required>
                                        </div>
                                        <div class="col-sm-7">
                                            <select class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" data-select2-id="1" aria-hidden="true"
                                                id="esc_code" required aria-required="true">
                                                <option value="">Seleccione Escuela</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>
                                <!--</form>-->

                            </div>
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Información de la Resolución de la Facultad</h3>
                                </div>
                                <!-- form start -->
                                <!--<form class="form-horizontal">-->
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="org_id" class="col-sm-3 col-form-label">Tipo de Resol.</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control dato Exp" id="org_id" name="org_idE"
                                                required>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="org_alias" placeholder="Tipo"
                                                disabled="">
                                        </div>

                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group row">
                                        <label for="sesTipo_id" class="col-sm-3 col-form-label">Tipo de
                                            Sesión</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control dato Exp" id="sesTipo_id"
                                                name="sesTipo_idE" required disabled>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="sesTipo_nombre" disabled="">
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
                                                <input type="text" class="form-control Exp"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                    inputmode="numeric" id="ses_fecha" name="ses_fechaE"
                                                    onchange="validarDate(this)" required disabled>
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
                                                <input type="text" class="form-control Exp"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                    inputmode="numeric" id="resol_fecha" name="resol_fechaE"
                                                    onchange="validarDate(this)" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="#" class="col-sm-3 col-form-label">Número</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control dato Exp new" id="resol_numero"
                                                placeholder="Número de Doc." name="resol_numeroE" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="#" class="col-sm-3 col-form-label">Memo. Nro.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control dato Exp new" placeholder="Memorando"
                                                id="resol_memorando" name="resol_memorandoE" required>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                                <!--</form>-->
                            </div>
                            <!-- /.card -->

                            <!-- /.card -->

                        </div>
                        <div class="col-md-6">
                            <!-- Form Element sizes -->
                            <div class="card card-danger">
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
                                                <input type="text" class="form-control Exp new"
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                    inputmode="numeric" id="resol_fechaSolicitud"
                                                    name="resol_fechaSolicitudE" onchange="validarDate(this)" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control dato Exp new" placeholder="Número"
                                                id="resol_nroSolicitud" name="resol_nroSolicitudE" required>
                                        </div>
                                    </div>
                                </div>
                                <!--</form>-->
                                <!-- /.card-body -->
                            </div>
                            <div class="card card-primary">

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
                                                placeholder="Ingrese Número de Doc." name="per_nroDocE" required>
                                        </div>
                                        <div class="col-sm-5">
                                            <button type="button" class="btn btn-block btn-outline-primary"
                                                id="btnpersona" onclick="registrarPersona()">Nuevo</button>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="per_paterno1" class="col-sm-3 col-form-label">Nombres:</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control new" id="per_paterno1" disabled="">
                                        </div>

                                    </div>
                                    <!--
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
-->
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
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Información del Acto Académico</h3>
                                </div>
                                <!--<form class="form-horizontal" id="formExp1">-->
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="fecha_actAca" class="col-sm-3 col-form-label">Fecha de
                                            Acto</label>
                                        <div class="col-sm-5">
                                            <div class="input-group" data-children-count="1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" data-children-count="0"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control Exp new "
                                                    data-inputmask-alias="datetime"
                                                    data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                    inputmode="numeric" id="fecha_actAca" name="fecha_actAcaE"
                                                    onchange="validarDate(this)" required>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- /.form-group -->
                                    <div class="form-group row">
                                        <label for="actAca_id" class="col-sm-3 col-form-label">Modalidad</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control dato Exp" id="actAca_id"
                                                name="actAca_idE" required>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="actAca_alias"
                                                placeholder="Automático" disabled="">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="den_id" class="col-sm-3 col-form-label">Denominación</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2 select2-hidden-accessible Exp"
                                                style="width: 100%;" data-select2-id="1" aria-hidden="true" id="den_id"
                                                name="den_idE" required aria-required="true">
                                                <option value="">Seleccione Denominación</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--</form>-->
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal" onclick = "limpiarInfo()">Cancelar</button>
                    <button type="submit" name="action" id="#" value="add"
                        class="btn btn-rounded btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>

<?php require_once("../MntPersona/modalpersona.php");?>