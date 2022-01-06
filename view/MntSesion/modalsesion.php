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