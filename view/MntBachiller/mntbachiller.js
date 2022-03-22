function init() {
    $("#persona_form").on("submit", function (e) {
        guardaryeditar(e);
    });

}

function guardaryeditar(e) {
    e.preventDefault();

    var formData = new FormData($("#persona_form")[0]);

    $.ajax({
        url: "../../controller/persona.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#per_nroDoc1').val(formData.get('per_nroDoc'));
            $('#per_paterno1').val(formData.get('per_paterno'));
            $('#per_materno1').val(formData.get('per_materno'));
            $('#per_nombres1').val(formData.get('per_nombres'));
            $('input[name=per_sexo1][value =' + formData.get('per_sexo') + ']').prop("checked", true);
            $('#docTipo_id1').val(formData.get('docTipo_id'));

            $('#persona_form')[0].reset();
            $("#modalmantenimiento").modal('hide');

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )


        }
    });
}

/*
input.onblur = function () {
    if (!input.value.includes('@')) { // not email
        input.classList.add('invalid');
        error.innerHTML = 'Por favor introduzca un correo válido.'
    }
};
*/




$(document).ready(function () {
    cargarEscuelaBT();
    //cargarDenominacion();
    cargarSesion();
    leerCambio();

});

/*
function cargarEscuela() {
    $.ajax({
        type: 'GET',
        url: '../../controller/denominacion.php?op=cargarEscuela',
        success: function (response) {

            //alert(response);
            //alert(typeof (response));

            var json = JSON.parse(response);
            const temp = json;
            
            var $select = $('#esc_code');

            $.each(temp, function (esc_code, esc_alias) {
                //$('#esc_code').append('<option value="' + fila[1].esc_code + '>' + fila[1].esc_alias + '</option>')
                $select.append('<option value=' + esc_alias.esc_code + '>' + esc_alias.esc_alias + '</option>');
            })
        }

    })
}
*/

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

function leerCambio() {
    document.getElementById('genCop_id').addEventListener("change", cargarGeneracion);
    document.getElementById('esc_code1').addEventListener("change", seleccionarEscuela);
    document.getElementById('esc_code').addEventListener("change", selectEscuela);
    document.getElementById('org_id').addEventListener("change", cargarOrgano);
    document.getElementById('sesTipo_id').addEventListener("change", cargarTipoSesion);
    document.getElementById('per_nroDoc1').addEventListener("change", cargarPersona);


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
            $('#per_nroDoc1').val("");
        } else {
            data = JSON.parse(data);

            $('#per_id1').val(data.per_id);
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
                } else {
                    activarCampoSesion(true);
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
    } else {
        swal.fire(
            'Error!',
            'Valor inválido.',
            'error'
        )
        $('#esc_code1').val(0);
        $select.val(0);
    }
    cargarDenominacion();

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

    var nivel = 1;
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
        }

    })
}


$(document).on("click", "#btnnuevo", function () {
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    //$('#persona_form')[0].reset();

});

init();