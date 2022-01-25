<div id="modalmantenimiento" class="modal fade bd-example-modal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="denominacion_form">
                <div class="modal-header">
                    <h4 class="modal-title" id="mdltitulo"></h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="den_id" name="den_id">
                    
                    <div class="form-group">
                        <label class="form-label" for="nivel_id">Nivel</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="nivel_id" name="nivel_id">
                            <option selected="selected" value="0">Seleccione Nivel</option>
                            <option value="1">Bachiller</option>
                            <option value="2">Título Profesional</option>
                            <option value="3">Maestría</option>
                            <option value="4">Doctorado</option>
                            <option value="5">Título de Segunda Especialidad Profesional</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="esc_code">Escuela</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="esc_code" name="esc_code">
                            <option selected="selected" value="0">Seleccione Escuela</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label class="form-label" for="den_Mas">Denominación - Masculino</label>
                        <input type="text" class="form-control" id="den_Mas" name="den_Mas"
                            placeholder="Denominación Masculino" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="den_Fem">Denominación - Femenino</label>
                        <input type="text" class="form-control" id="den_Fem" name="den_Fem"
                            placeholder="Denominación Femenino" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="den_MasFem">Denominación - Mixto</label>
                        <input type="text" class="form-control" id="den_MasFem" name="den_MasFem"
                            placeholder="Denominación Mixto" required>
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