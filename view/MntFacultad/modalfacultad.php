<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="facultad_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="fac_id" name="fac_id">
                    <div class="form-group">
                        <label class="form-label" for="fac_nombre">Nombre:</label>
                        <input type="text" class="form-control" id="fac_nombre" name="fac_nombre"
                            placeholder="Ingrese Nombre de Facultad" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fac_alias">Alias:</label>
                        <input type="text" class="form-control" id="fac_alias" name="fac_alias"
                            placeholder="Ingrese Alias de Facultad" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fac_sigla">Sigla:</label>
                        <input type="text" class="form-control" id="fac_sigla" name="fac_sigla"
                            placeholder="Ingrese Sigla:" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fac_autoridad">Autoridad:</label>
                        <input type="text" class="form-control" id="fac_autoridad" name="fac_autoridad"
                            placeholder="Ingrese Autoridad de Facultad" required>
                    </div>
                    <!-- 
                    <div class="form-group">
                        <label class="form-label" for="per_sexo">Sexo: </label>
                        <input type="text" class="form-control" id="per_sexo" name="per_sexo" placeholder="Elija Sexo" required>
                    </div>
                    -->
                    <!-- 

                    <div class="form-group">
                        <label class="form-label" for="docTipo_id">Tipo Doc. Ident.</label>
                        <input type="text" class="form-control" id="docTipo_id" name="docTipo_id" placeholder="Seleccione Tipo Doc. Ident." required>
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