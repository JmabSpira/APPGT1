<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="escuela_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="esc_id" name="esc_id">
                    <div class="form-group">
                        <label class="form-label" for="esc_code">Código</label>
                        <input type="text" class="form-control" id="esc_code" name="esc_code"
                            placeholder="Código de escuela" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="esc_nombre">Escuela</label>
                        <input type="text" class="form-control" id="esc_nombre" name="esc_nombre"
                            placeholder="Ingrese nombre de escuela" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="esc_sigla">Sigla</label>
                        <input type="text" class="form-control" id="esc_sigla" name="esc_sigla"
                            placeholder="Ingrese sigla" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="esc_alias">Alias</label>
                        <input type="text" class="form-control" id="esc_alias" name="esc_alias"
                            placeholder="Ingrese alias" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="fac_id">Facultad</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="fac_id" name="fac_id">
                            <option selected="selected" value="0">Seleccione Facultad</option>
                            <!--<option data-select2-id="30" value="1">FCA</option>
                            <option data-select2-id="30" value="2">FCB</option>
                            <option data-select2-id="31" value="3">FCE</option>
                            <option data-select2-id="32" value="4">FCEAC</option>
                            <option data-select2-id="33" value="5">FCS</option>
                            <option data-select2-id="34" value="6">FDCP</option>
                            <option data-select2-id="35" value="7">FIMGC.</option>
                            <option data-select2-id="36" value="8">FCSA.</option>
                            <option data-select2-id="37" value="9">FCSA.</option>
                            <option data-select2-id="38" value="70">EP</option>-->
                        </select>

                    </div>
                    <!-- 

                    <div class="form-group">
                        <label class="form-label" for="fac_id">Tipo Doc. Ident.</label>
                        <input type="text" class="form-control" id="fac_id" name="fac_id" placeholder="Seleccione Tipo Doc. Ident." required>
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