<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="diligencia_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="dil_id" name="dil_id">

                    <div class="form-group">
                        <label class="form-label" for="dil_proveido">Proveido del Rectorado Nº</label>
                        <input type="text" class="form-control" id="dil_proveido" name="dil_proveido"
                            placeholder="ABC-202X-R" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dil_memosg">Memorando de Secretaria General Nº</label>
                        <input type="text" class="form-control" id="dil_memosg" name="dil_memosg"
                            placeholder="ABC-202X-UNSCH-SG" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dil_memogt">Memorando de Grados y Títulos Nº</label>
                        <input type="text" class="form-control" id="dil_memogt" name="dil_memogt"
                            placeholder="ABC-2022-UNSCH-SG-UCGyT" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="dil_fechaE">Fecha:</label>
                        <div class="input-group" data-children-count="1">
                            <div class="input-group-prepend">
                                <span class="input-group-text" data-children-count="0"><i
                                        class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" id="dil_fechaE" name="dil_fechaE"
                                data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask=""
                                inputmode="numeric" required>
                        </div>
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