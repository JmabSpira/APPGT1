<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="subdenominacion_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="subDen_id" name="subDen_id">

                    <div class="form-group">
                        <label class="form-label" for="den_id">Denominación</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="den_id" name="den_id">
                            <option selected="selected" value="0">Seleccione Denominación</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label class="form-label" for="subDen_MasFem">Subdenominación</label>
                        <input type="text" class="form-control" id="subDen_MasFem" name="subDen_MasFem"
                            placeholder="Subdenominación" required>
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