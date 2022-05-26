<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="sesion_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="ses_id" name="ses_id">
                    

                    <div class="form-group">
                        <label class="form-label" for="org_id">Órgano:</label>
                        <select class="form-control select2" style="width: 100%;" id="org_id" name="org_id">
                            <option value="1">Asamblea Universitaria</option>
                            <option selected="selected" value="2">Consejo Universitario</option>
                            <option value="3">Rectorado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="sesTipo_id">Tipo Sesión:</label>
                        <div class="input-group">
                            <div class="icheck-primary d-inline col-sm-4">
                                <input type="radio" id="sesTipo_id1" name="sesTipo_id" value = 1 checked>
                                <label for="sesTipo_id1">
                                Ordinaria
                                </label>
                            </div>

                            <div class="icheck-primary d-inline col-sm-4">
                                <input type="radio" id="sesTipo_id2" name="sesTipo_id" value = 2>
                                <label for="sesTipo_id2">
                                Extraordinaria
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="ses_fecha">Fecha:</label>
                        <div class="input-group" data-children-count="1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" data-children-count="0"><i
                                        class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="ses_fecha" name="ses_fecha"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask=""
                                    inputmode="numeric" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="ses_estado">Estado:</label>
                        <div class="input-group">
                            <div class="icheck-primary d-inline col-sm-4">
                                <input type="radio" id="ses_estado1" name="ses_estado" value = 1 checked>
                                <label for="ses_estado1">
                                Activado
                                </label>
                            </div>

                            <div class="icheck-primary d-inline col-sm-4">
                                <input type="radio" id="ses_estado2" name="ses_estado" value = 0 disabled>
                                <label for="ses_estado2">
                                Desactivado
                                </label>
                            </div>
                        </div>
                    </div>

                    <!--
                    <div class="form-group">
                        <label class="form-label" for="docTipo_id">Tipo Doc. Ident.</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="docTipo_id" name="docTipo_id">
                            <option data-select2-id="3" value="1">Otros</option>
                            <option selected="selected" data-select2-id="30" value="2">DNI</option>
                            <option data-select2-id="31" value="3">RUC</option>
                            <option data-select2-id="32" value="4">LM</option>
                            <option data-select2-id="33" value="5">C.E.</option>
                            <option data-select2-id="34" value="6">PASAPORTE</option>
                            <option data-select2-id="35" value="7">P.NAC.</option>
                        </select>

                    </div>
                    

                    <div class="form-group">
                        <label class="form-label" for="per_sexo">Género</label>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="per_sexo" id="per_sexo" value="M"
                                required>
                            <label class="form-check-label" for="per_sexo">Masculino</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="per_sexo" id="per_sexo" value="F">
                            <label class="form-check-label" for="per_sexo">Femenino</label>
                        </div>
                    </div>
                    -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add"
                        class="btn btn-rounded btn-primary">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>