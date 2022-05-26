function init() {

    $("#persona_form").on("submit", function (e) {
        guardarPersona(e);
    });
    navegacion();
    cargarEscuelaBT();
    //cargarDenominacion();
    cargarSesion();
    leerCambio();

    $(".dato").on('focus', function () {
        this.select();
    });
}

function limpiar() {
    $('.new').val('');
    $('input[name=per_sexo1]').prop("checked", false);

}

function verDatos() {
    var formData = new FormData($("#expediente_form")[0]);
    console.log("Recorremos");
    for (var entrie of formData.entries()) {
        console.log(entrie[0] + ': ' + entrie[1]);
    }
}

function guardarPersona(e) {
    e.preventDefault();

    var formData = new FormData($("#persona_form")[0]);

    $.ajax({
        url: "../../controller/persona.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#per_idE').val(formData.get('per_idE'));
            $('#per_nroDoc1').val(formData.get('per_nroDoc'));
            $('#per_paterno1').val(formData.get('per_paterno'));
            $('#per_materno1').val(formData.get('per_materno'));
            $('#per_nombres1').val(formData.get('per_nombres'));
            $('input[name=per_sexo1][value =' + formData.get('per_sexo') + ']').prop("checked", true);
            $('#docTipo_id1').val(formData.get('docTipo_id'));

            $('#persona_form')[0].reset();
            $("#modalpersona").modal('hide');

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )


        }
    });
}


/*
$(document).ready(function () {
    cargarEscuelaBT();
    //cargarDenominacion();
    cargarSesion();
    leerCambio();

});
*/

function navegacion() {
    //var campos = document.getElementsByName('inp');
    var campos = document.getElementsByClassName('Exp');
    var ids = [];

    for (let i = 0; i < campos.length; i++) {
        const element = campos[i];
        //console.log(element.id);
        ids.push(element.id);
    }
    console.log(ids);
    console.log(campos);

    for (i = 0; i < campos.length; i++) {
        //campos[i].addEventListener("keydown", uwu);
        var elemento = campos[i];
        //console.log(elemento);
        elemento.addEventListener("keydown", (e) => {
            if (e.keyCode === 13) {
                //console.log(e.target.id);
                var indice = ids.indexOf(e.target.id)
                //console.log("AHORA ESTAMOS EN EL INPUT" + (indice + 1));
                /*
                if (indice == (campos.length - 1)) {
                    console.log("El indice es: " + indice);
                    $("#guardarExp").focus();
                } else {*/
                console.log("Entro aqui: " + indice);

                if ($('#sesTipo_id').prop('disabled') && (e.target.id == 'org_id')) {
                    $('#resol_fecha').focus();
                } else {
                    if (indice + 1 == campos.length) {
                        indice = 0;
                    }
                    document.getElementById(ids[indice + 1]).focus();
                    //document.getElementById(ids[indice + 1]).select();
                }
                //document.getElementById(ids[indice + 1]).focus();
                //document.getElementById(ids[indice + 1]).select();
                /* }*/

            }
        });
    }

}

function validarInput(elemento) {

    jQuery(elemento).on('input', function (evt) {
        // Allow only numbers.
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));

    });
    /*
    jQuery(elemento).on('focus', function (evt) {
        jQuery(this).select();
    });
*/
}

function cargarEscuelaBT() {

    var inicio = 1;
    var fin = 60;

    $.ajax({
        type: 'GET',
        url: '../../controller/denominacion.php?op=cargarEscuelaE&inicio=' + inicio + '&fin=' + fin,
        success: function (response) {

            //alert(response);
            //alert(typeof (response));

            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            var $select = $('#esc_code');

            $.each(temp, function (esc_code, esc_alias) {
                //$('#esc_code').append('<option value="' + fila[1].esc_code + '>' + fila[1].esc_alias + '</option>')
                $select.append('<option value=' + esc_alias.esc_code + '>' + esc_alias.esc_alias + '</option>');
            })
        }

    })
}

/*
function cargarEscuelaBT() {

    $.ajax({
        type: 'GET',
        url: '../../controller/denominacion.php?op=cargarEscuelaBT',
        success: function (response) {

            //alert(response);
            //alert(typeof (response));

            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            var $select = $('#esc_code');

            $.each(temp, function (esc_code, esc_alias) {
                //$('#esc_code').append('<option value="' + fila[1].esc_code + '>' + fila[1].esc_alias + '</option>')
                $select.append('<option value=' + esc_alias.esc_code + '>' + esc_alias.esc_alias + '</option>');
            })
        }

    })
}
*/
function leerCambio() {
    document.getElementById('genCop_id').addEventListener("change", cargarGeneracion);
    document.getElementById('esc_code1').addEventListener("change", seleccionarEscuela);
    document.getElementById('esc_code').addEventListener("change", selectEscuela);
    document.getElementById('org_id').addEventListener("change", cargarOrgano);
    document.getElementById('sesTipo_id').addEventListener("change", cargarTipoSesion);
    document.getElementById('per_nroDoc1').addEventListener("change", cargarPersona);
    document.getElementById('actAca_id').addEventListener("change", cargarActo);
    validarInput("#genCop_id");
    validarInput("#esc_code1");
    validarInput("#org_id");
    validarInput("#sesTipo_id");
    validarInput("#resol_numero");
    validarInput("#resol_nroSolicitud");
    validarInput("#per_nroDoc1");
    validarInput("#actAca_id");
    validarInput("#per_nroDoc");
    document.getElementById('guardarExp').addEventListener("click", guardarExpediente);
    console.log("llega aqui ---");
}


function guardarExpediente(e) {
    e.preventDefault();

    swal.fire({
        title: 'EXPEDIENTE',
        text: "Desea Guardar el Registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Guardar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            console.log("Se va a Guardar....");
            var formData = new FormData($("#expediente_form")[0]);
            verDatos();
            //$('#persona_data').DataTable().ajax.reload();

            $.ajax({
                url: "../../controller/expediente.php?op=guardarExpediente",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    alert(response);
                    swal.fire(
                            'Guardado!',
                            'El registro se ha guardado correctamente.',
                            'success'
                        )
                        .then((result) => {
                            if (result.isConfirmed) {
                                //window.location.reload();
                                //$('#esc_code1').focus();
                                //verDatos();
                                limpiar();
                            }
                        })
                }
            });



        }

    })
}

function cargarActo() {
    var act = $('#actAca_id').val();
    $.ajax({
        type: 'GET',
        url: '../../controller/expediente.php?op=cargarActo&appat=' + act,
        success: function (response) {

            var json = JSON.parse(response);
            const temp = json;
            if (response == "false") {
                swal.fire(
                    'Error!',
                    'Valor inválido.',
                    'error'
                )
                $("#actAca_id").val(6);
                cargarActo();
            } else {
                var $input = $('#actAca_alias');
                $.each(temp, function (actAca_id, actAca_alias) {
                    $input.val(actAca_alias);
                })
            }
        }
    })
}

function cargarPersona() {
    var per_nroDoc = $('#per_nroDoc1').val();
    $.post("../../controller/expediente.php?op=cargarPersona", {
        per_nroDoc: per_nroDoc
    }, function (data) {

        if (data == false) {
            swal.fire(
                'Error!',
                'No se encontraron registros.',
                'error'
            )
            //$('#persona_form1')[0].reset();
            $('#per_nroDoc1').val('');
            $('#per_paterno1').val('');
            $('#per_materno1').val('');
            $('#per_nombres1').val('');
            $('input[name=per_sexo1]').prop("checked", false);

        } else {
            data = JSON.parse(data);

            $('#per_idE').val(data.per_id);
            $('#per_nroDoc1').val(data.per_nroDoc);
            $('#per_paterno1').val(data.per_paterno);
            $('#per_materno1').val(data.per_materno);
            $('#per_nombres1').val(data.per_nombres);
            $('input[name=per_sexo1][value =' + data.per_sexo + ']').prop("checked", true);
            $('#docTipo_id1').val(data.docTipo_id);
        }
    });

}

function cargarOrgano() {
    var org = $('#org_id').val();
    $.ajax({
        type: 'GET',
        url: '../../controller/expediente.php?op=cargarOrgano&appat=' + org,
        success: function (response) {

            var json = JSON.parse(response);
            const temp = json;
            if (response == "false") {
                swal.fire(
                    'Error!',
                    'Valor inválido.',
                    'error'
                )
                $("#org_id").val(7);
                cargarOrgano();
            } else {
                var $input = $('#org_alias');
                $.each(temp, function (org_id, org_emite) {
                    $input.val(org_emite);
                })

                if (org == 1 || org == 2 || org == 6 || org == 8) {
                    activarCampoSesion(false);
                    $('#sesTipo_id').focus();
                } else {
                    activarCampoSesion(true);
                    $('#resol_fecha').focus();
                }
            }
        }
    })

    //$('#esc_code1').focus();
}


function activarCampoSesion(valor) {
    $('#sesTipo_id').prop('disabled', valor);
    $('#ses_fecha').prop('disabled', valor);
}

function cargarTipoSesion() {
    var ses = $('#sesTipo_id').val();
    $.ajax({
        type: 'GET',
        url: '../../controller/expediente.php?op=cargarTipoSesion&appat=' + ses,
        success: function (response) {

            var json = JSON.parse(response);
            const temp = json;
            if (response == "false") {
                swal.fire(
                    'Error!',
                    'Valor inválido.',
                    'error'
                )
                $("#sesTipo_id").val(1);
                cargarTipoSesion();
            } else {
                var $input = $('#sesTipo_nombre');
                $.each(temp, function (sesTipo_id, sesTipo_nombre) {
                    $input.val(sesTipo_nombre);
                })
            }
        }
    })
}

function seleccionarEscuela() {

    var esc_code1 = $('#esc_code1').val();
    var $select = $('#esc_code');
    var exists = false;
    for (var i = 0, opts = document.getElementById('esc_code').options; i < opts.length; ++i)
        if (opts[i].value === esc_code1) {
            exists = true;
            break;
        }
    if (exists) {
        $select.val(esc_code1);
        cargarDenominacion();
    } else {
        swal.fire(
            'Error!',
            'Valor inválido.',
            'error'
        )

        $('#esc_code1').val(0);
        $select.val(0);
        $('#den_id').val(0);

    }

}

function selectEscuela() {

    var $esc_code = $('#esc_code').val();
    $('#esc_code1').val($esc_code);
    cargarDenominacion();
}

function cargarGeneracion() {
    var genCop_id = $('#genCop_id').val();
    $.ajax({
        type: 'GET',
        url: '../../controller/expediente.php?op=cargarGeneracion&appat=' + genCop_id,
        success: function (response) {

            var json = JSON.parse(response);
            const temp = json;

            if (response == "false") {
                swal.fire(
                    'Error!',
                    'Valor inválido.',
                    'error'
                )
                $("#genCop_id").val(1);
                cargarGeneracion();
            } else {

                var $input = $('#genCop_alias');
                $.each(temp, function (genCop_id, genCop_alias) {
                    $input.val(genCop_alias);
                })
            }
        }
    })
    //$('#esc_code1').focus();
}




function cargarSesion() {
    $.get("../../controller/sesion.php?op=sesionActual", {}, function (data) {
        data = JSON.parse(data);
        $('#ses_id').val(data.ses_id);
        var infoSes = data.org_acronimo + " - " + data.sesTipo_sigla + " - " + data.ses_fecha;
        $('#ses_data').val(infoSes);
        console.log(data.ses_id + data.org_acronimo + data.ses_fecha);
    });
}

function cargarDenominacion() {

    var nivel = 2;
    var code = $('#esc_code').val();

    $.ajax({
        type: 'GET',
        url: '../../controller/subdenominacion.php?op=cargarDenominacionPorEscuela&appat=' + nivel + '&code=' + code,
        success: function (response) {

            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            var $select = $('#den_id');

            $select
                .empty()
                .append('<option selected="selected" value="0">Seleccione Denominación</option>');

            $.each(temp, function (den_id, den_MasFem) {
                //$('#den_id').append('<option value="' + fila[1].den_id + '>' + fila[1].den_MasFem + '</option>')
                $select.append('<option value=' + den_MasFem.den_id + '>' + den_MasFem.den_MasFem + '</option>');
            })
            document.getElementById("den_id").selectedIndex = 1;
            cargarSubDenominacion();
        }

    })
}

function cargarSubDenominacion() {

    var den = $('#den_id').val();

    $.ajax({
        type: 'GET',
        url: '../../controller/subdenominacion.php?op=cargarSubDenominacionPorDen&den=' + den,
        success: function (response) {

            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            if (!jQuery.isEmptyObject(temp)) {
                $('#subDen_id').prop('disabled', false);
                var $select = $('#subDen_id');

                $select
                    .empty()
                    .append('<option selected="selected" value="0">Seleccione Especialidad</option>');

                $.each(temp, function (subDen_id, subDen_MasFem) {
                    //$('#den_id').append('<option value="' + fila[1].den_id + '>' + fila[1].den_MasFem + '</option>')
                    $select.append('<option value=' + subDen_MasFem.subDen_id + '>' + subDen_MasFem.subDen_MasFem + '</option>');
                })
                document.getElementById("subDen_id").selectedIndex = 1;
            } else {
                $('#subDen_id').val(0);
                $('#subDen_id').prop('disabled', true);
            }
        }

    })
}


$(document).on("click", "#btnnuevo", function () {
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalpersona').modal('show');
    //$('#persona_form')[0].reset();

});

init();