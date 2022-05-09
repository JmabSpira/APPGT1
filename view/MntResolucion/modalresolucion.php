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
                        <label class="form-label" for="doc_proveido">Proveido del Rectorado Nº</label>
                        <input type="text" class="form-control" id="doc_proveido" name="doc_proveido"
                            placeholder="ABC-202X-R" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="doc_memosg">Memorando de Secretaria General Nº</label>
                        <input type="text" class="form-control" id="doc_memosg" name="doc_memosg"
                            placeholder="ABC-202X-UNSCH-SG" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="doc_memogt">Memorando de Grados y Títulos Nº</label>
                        <input type="text" class="form-control" id="doc_memogt" name="doc_memogt"
                            placeholder="ABC-2022-UNSCH-SG-UCGyT" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add"
                        class="btn btn-rounded btn-primary">Procesar</button>
                </div>

            </form>
        </div>
    </div>
</div>