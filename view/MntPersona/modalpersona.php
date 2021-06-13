<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="persona_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="per_id" name="per_id">
                    <div class="form-group">
                        <label class="form-label" for="per_nroDoc">Nro Doc. Ident.</label>
                        <input type="text" class="form-control" id="per_nroDoc" name="per_nroDoc" placeholder="Nro Doc. Identidad" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="per_paterno">Ap. Paterno</label>
                        <input type="text" class="form-control" id="per_paterno" name="per_paterno" placeholder="Ingrese Apellido Paterno" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="per_materno">Ap. Materno</label>
                        <input type="text" class="form-control" id="per_materno" name="per_materno" placeholder="Ingrese Apellido Paterno" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="per_nombres">Nombres</label>
                        <input type="text" class="form-control" id="per_nombres" name="per_nombres" placeholder="Ingrese Nombre" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="per_sexo">Sexo: </label>
                        <input type="text" class="form-control" id="per_sexo" name="per_sexo" placeholder="Elija Sexo" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="docTipo_id">Tipo Doc. Ident.</label>
                        <input type="text" class="form-control" id="docTipo_id" name="docTipo_id" placeholder="Seleccione Tipo Doc. Ident." required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" id="#" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>