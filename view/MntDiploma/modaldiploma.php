<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="resolucion_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="exp_id" name="exp_id">
                    
                    <div class="form-group">
                        <label class="form-label" for="doc_proveido">Fecha de Entrega</label>
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
                    <div class="form-group">
                        <label class="form-label" for="doc_memosg">Nro de Resolución Inicial:</label>
                        <input type="text" class="form-control" id="doc_memosg" name="doc_memosg"
                            placeholder="ABC" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add"
                        class="btn btn-rounded btn-primary">Generar</button>
                </div>

            </form>
        </div>
    </div>
</div>