//VALIDACIONES
function validarInput(elemento) {

    jQuery(elemento).on('input', function (evt) {
        // Allow only numbers.
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));

    });
}


//FUNCIONES GENERALES

function cargarSesion() {
    $.get("../../controller/sesion.php?op=sesionActual", {}, function (data) {

        if (data === 'false') {
            swal.fire('No hay una sesión activa');
        } else {
            data = JSON.parse(data);
            $('#ses_id').val(data.ses_id);
            var infoSes = data.org_acronimo + " - " + data.sesTipo_sigla + " - " + data.ses_fecha;
            $('#ses_data').val(infoSes);
        }
    });
}

function cargarGeneracion() {
    var appat = $('#genCop_id').val();
    $.get("../../controller/expediente.php?op=cargarGeneracion", {
        appat: appat
    }, function (data) {
        var data = JSON.parse(data);
        if (data == false) {
            swal.fire('Ingrese un Nivel Válido');
            $('#genCop_id').val(1);
            cargarGeneracion();
        } else {

            $('#genCop_alias').val(data.genCop_alias);
        }
    });
}


function cargarEscuelaBT() {

    $.ajax({
        type: 'GET',
        url: '../../controller/denominacion.php?op=cargarEscuelaBT',
        success: function (response) {

            alert(response);
            alert(typeof (response));

            var json = JSON.parse(response);
            alert(json);
            alert(typeof (json));
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
        Toast.fire({
            icon: 'error',
            title: 'Código de Escuela Inválido'
        })
        $('#esc_code1').val('');
        $select.val("");
        $('#den_id').val("");
    }
}


function selectEscuela() {
    var $esc_code = $('#esc_code').val();
    $('#esc_code1').val($esc_code);
    cargarDenominacion();
}

function cargarOrgano() {
    var org = $('#org_id').val();
    $.get("../../controller/expediente.php?op=cargarOrgano", {
        org: org
    }, function (data) {

        var data = JSON.parse(data);

        if (data == false) {
            Toast.fire({
                icon: 'error',
                title: 'Ingrese un tipo de resolución válido'
            })
            $('#org_id').val(7);
            cargarOrgano();
            /*
            $('#org_id').val('');
            $('#org_alias').val('');
            $('#org_id').focus();
            */
        } else {
            $('#org_alias').val(data.org_emite);
            if (org == 1 || org == 2 || org == 6 || org == 8) {
                $('#sesTipo_id').prop('disabled', false);
                $('#ses_fecha').prop('disabled', false);
                $('#sesTipo_id').val('');
                $('#sesTipo_nombre').val('');
                $('#ses_fecha').val('');
                $('#sesTipo_id').focus();


                //$('#sesTipo_id').focus();
            } else {
                $('#sesTipo_id').val('');
                $('#ses_fecha').val('');
                $('#sesTipo_nombre').val('');
                $('#sesTipo_id').prop('disabled', true);
                $('#ses_fecha').prop('disabled', true);
                $('#resol_fecha').focus();
            }
        }
    });
}

function cargarActo() {
    var act = $('#actAca_id').val();
    $.get("../../controller/expediente.php?op=cargarActo", {
        act: act
    }, function (data) {
        var data = JSON.parse(data);
        if (data == false) {
            Toast.fire({
                icon: 'error',
                title: 'Ingrese una modalidad válida'
            })

            $('#actAca_id').val(6);
            cargarActo()
            //$('#actAca_id').val('');
            //$('#actAca_alias').val('')
            //$('#actAca_id').focus();

        } else {
            $('#actAca_alias').val(data.actAca_nombre);
        }
    });
}

function cargarTipoSesion() {
    var ses = $('#sesTipo_id').val();

    $.get("../../controller/expediente.php?op=cargarTipoSesion", {
        ses: ses
    }, function (data) {
        var data = JSON.parse(data);
        if (data == false) {
            Toast.fire({
                icon: 'error',
                title: 'Ingrese un tipo de sesión válido'
            })
            $('#sesTipo_id').val('');
            $('#sesTipo_nombre').val('');
            $('#sesTipo_id').focus();
        } else {
            $('#sesTipo_nombre').val(data.sesTipo_nombre);
        }
    });
}



function guardarPersonaE(e) {
    e.preventDefault();

    info = '' + $('#per_nroDoc').val();
    cant = document.getElementById("per_nroDoc").maxLength;
    if (cant == info.length) {
        var formData = new FormData($("#persona_form")[0]);

        $.ajax({
            url: "../../controller/persona.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {

                if (datos == false) {
                    swal.fire(
                        'Registro!',
                        'El registro correctamente.',
                        'success'
                    )
                    $('#per_nroDoc1').val(formData.get('per_nroDoc'));
                    datos = formData.get('per_paterno') + " " + formData.get('per_materno') + " " + formData.get('per_nombres');
                    $('#per_paterno1').val(datos);
                    //$('#per_materno1').val(formData.get('per_materno'));
                    //$('#per_nombres1').val(formData.get('per_nombres'));
                    $('input[name=per_sexo1][value =' + formData.get('per_sexo') + ']').prop("checked", true);
                    $('#docTipo_id1').val(formData.get('docTipo_id'));
                    $('#persona_form')[0].reset();
                    $("#modalpersona").modal('hide');

                } else {
                    swal.fire(
                        'ERROR!',
                        'No se completó la acción. Error: ' + datos,
                        'error'
                    )
                }
            }
        });
    } else {
        swal.fire("El documento de identidad debe tener " + cant + " dígitos");
    }
}

function registrarPersona() {
    document.getElementById('docTipo_id').addEventListener("change", function () {
        opt = $('#docTipo_id').val();
        $('#per_nroDoc').val('');
        if (opt == "1") {
            $('#per_nroDoc').attr('maxlength', '15');
        } else if (opt == "2") {
            $('#per_nroDoc').attr('maxlength', '8');
        } else if (opt == "3") {
            $('#per_nroDoc').attr('maxlength', '11');
        } else if (opt == "4" || opt == "5") {
            $('#per_nroDoc').attr('maxlength', '12');
        } else {
            $('#per_nroDoc').attr('maxlength', '10');
        }
    });

    $('#mdltitulo').html('Registrar Persona');
    validarNumeros("#per_nroDoc");
    $('#modalpersona').modal('show');
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

function leerCambio() {
    document.getElementById('genCop_id').addEventListener("change", cargarGeneracion);
    document.getElementById('per_nroDoc1').addEventListener("change", cargarPersona);
    document.getElementById('esc_code1').addEventListener("change", seleccionarEscuela);
    document.getElementById('esc_code').addEventListener("change", selectEscuela);
    document.getElementById('org_id').addEventListener("change", cargarOrgano);
    document.getElementById('sesTipo_id').addEventListener("change", cargarTipoSesion);
    document.getElementById('actAca_id').addEventListener("change", cargarActo);

    validarInput("#genCop_id");
    validarNumeros("#per_nroDoc1");
    validarInput("#esc_code1");
    validarInput("#org_id");
    validarInput("#sesTipo_id");
    validarInput("#actAca_id");
    validarInput("#resol_nroSolicitud");

}