var tabla;
var Toast = Swal.mixin({
    toast: true,
    showConfirmButton: false,
    timer: 2000
});


$(".dato").on('focus', function () {
    this.select();
});

/*
$('#modalmantenimiento').on('shown.bs.modal', function () {
    $('#esc_code1').focus();

})
*/

function init() {
    cargarSesion();
    cargarGeneracion();
    cargarEscuelaBT();
    leerCambio();

    $("#bachiller_form").on("submit", function (e) {
        //guardarExpediente(e);
        guardaryeditar(e);

    });

    /*
    $("#persona_form").on("submit", function (e) {
        guardarPersonaE(e);
        console.log("termina el guardar Persona");
    });
    */
}

function listarPorSesion(ses) {

    console.log("var en tabla: " + ses);
    tabla = $('#bachiller_data').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../../controller/expediente.php?op=listaExpedientes&nivel=1&ses=' + ses,
            type: "get",
            dataType: "json",
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10, //Por cada 10 registros hace una paginación
        "order": [
            [0, "asc"]
        ], //Ordenar (columna,orden)
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();

}

function cargarSesion() {

    $.get("../../controller/sesion.php?op=sesionActual", {}, function (data) {

        if (data === 'false') {
            swal.fire('No hay una sesión activa');
            $('#btnnuevo').prop('disabled', true);
        } else {
            data = JSON.parse(data);
            $('#ses_id').val(data.ses_id);
            var ses = data.ses_id;
            //sesion = ses;
            var infoSes = data.org_acronimo + " - " + data.sesTipo_sigla + " - " + data.ses_fecha;
            //datossesion = infoSes;
            $('#ses_data').val(infoSes);
            console.log(data.ses_id + data.org_acronimo + data.ses_fecha);

            listarPorSesion(ses);
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
            Toast.fire({
                icon: 'error',
                title: 'Ingrese un nivel válido'
            })
            $('#genCop_id').val(1);
            cargarGeneracion();
        } else {

            $('#genCop_alias').val(data.genCop_alias);
        }
    });
}


function verDatos() {
    var formData = new FormData($("#bachiller_form")[0]);
    console.log("Recorremos");
    for (var entrie of formData.entries()) {
        console.log(entrie[0] + ': ' + entrie[1]);
    }
}

function limpiarCampos() {
    $('.new').val('');
    $('input[name=per_sexo1]').prop("checked", false);
    $('#den_id').val("");

}

function cargarPersona() {
    var per_nroDoc = $('#per_nroDoc1').val();
    $.post("../../controller/expediente.php?op=cargarPersona", {
        per_nroDoc: per_nroDoc
    }, function (data) {

        if (data == false) {
            Toast.fire({
                icon: 'error',
                title: 'No se encontró ningún registro'
            })
            //$('#persona_form1')[0].reset();
            $('#per_nroDoc1').val('');
            $('#per_paterno1').val('');
            $('input[name=per_sexo1]').prop("checked", false);
            $('#per_nroDoc1').focus();

        } else {
            data = JSON.parse(data);

            $('#per_idE').val(data.per_id);
            $('#per_nroDoc1').val(data.per_nroDoc);
            persona = data.per_paterno + " " + data.per_materno + " " + data.per_nombres;
            $('#per_paterno1').val(persona);
            //$('#per_materno1').val(data.per_materno);
            //$('#per_nombres1').val(data.per_nombres);
            $('input[name=per_sexo1][value =' + data.per_sexo + ']').prop("checked", true);
            $('#docTipo_id1').val(data.docTipo_id);
        }
    });

}

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
                .append('<option value="">Seleccione Denominación</option>');

            $.each(temp, function (den_id, den_MasFem) {
                //$('#den_id').append('<option value="' + fila[1].den_id + '>' + fila[1].den_MasFem + '</option>')
                $select.append('<option value=' + den_MasFem.den_id + '>' + den_MasFem.den_MasFem + '</option>');
            })
            //document.getElementById("den_id").selectedIndex = 1;
        }

    })
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

            //$('#actAca_id').val(6);
            //cargarActo()
            $('#actAca_id').val('');
            $('#actAca_alias').val('')
            $('#actAca_id').focus();

        } else {
            $('#actAca_alias').val(data.actAca_nombre);
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
    validarNumeros("#genCop_id");
    validarNumeros("#per_nroDoc1");
    validarNumeros("#esc_code1");
    validarNumeros("#org_id");
    validarNumeros("#sesTipo_id");
    validarNumeros("#actAca_id");
    validarNumeros("#resol_nroSolicitud");


}

function validarDate(elemento) {
    campo = elemento.value;
    var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
    if ((campo.match(RegExPattern)) && (campo != '')) {
        console.log(campo);
    } else {
        Toast.fire({
            icon: 'error',
            title: 'Ingrese una fecha válida'
        })
        elemento.value = '';
        elemento.focus();
    }
}



/*
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
                    Toast.fire({
                        icon: 'success',
                        title: 'Registrado correctamente'
                    })
                    $('#per_nroDoc1').val(formData.get('per_nroDoc'));
                    datos = formData.get('per_paterno') + " " + formData.get('per_materno') + " " + formData.get('per_nombres');
                    $('#per_paterno1').val(datos);
                    //$('#per_materno1').val(formData.get('per_materno'));
                    //$('#per_nombres1').val(formData.get('per_nombres'));
                    $('input[name=per_sexo1][value =' + formData.get('per_sexo') + ']').prop("checked", true);
                    $('#docTipo_id1').val(formData.get('docTipo_id'));
                    $('#persona_form')[0].reset();
                    $("#modalpersona").modal('hide');
                    //$('#fecha_actAca').focus();

                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'No se completo la tarea: ' + datos
                    })
                }
            }
        });
    } else {
        Toast.fire({
            icon: 'error',
            title: 'El documento de identidad debe tener ' + cant + ' dígitos'
        })
    }
}
*/
/*
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

*/



function eliminar(exp_id) {
    swal.fire({
        title: 'EXPEDIENTE',
        text: "Esta seguro de Eliminar el Expediente?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.post("../../controller/expediente.php?op=eliminar", {
                exp_id: exp_id
            }, function (data) {
                if (data == false) {
                    swal.fire(
                        'Eliminado!',
                        'El registro se elimino correctamente.',
                        'success'
                    )
                    $('#bachiller_data').DataTable().ajax.reload();
                } else {
                    swal.fire(
                        'ERROR!',
                        'El registro no se pudo eliminar, ERROR: ' + data,
                        'error'
                    )
                }
            });
            console.log(exp_id);
        }
    })

}

function editar(exp_id) {
    accion = 'editar';
    $.post("../../controller/expediente.php?op=mostrar", {
        exp_id: exp_id
    }, function (data) {
        //alert(data);
        data = JSON.parse(data);

        $('#exp_id').val(data.exp_id);
        $('#genCop_id').val(data.genCop_id);
        cargarGeneracion();
        $('#esc_code1').val(data.esc_code);
        $('#esc_code').val(data.esc_code);
        cargarDenominacion();
        $('#org_id').val(data.org_id);
        //cargarOrgano();
        if (data.org_id == 1 || data.org_id == 2 || data.org_id == 6 || data.org_id == 8) {
            $('#sesTipo_id').prop('disabled', false);
            $('#ses_fecha').prop('disabled', false);
            $('#sesTipo_id').val(data.sesTipo_id);
            $('#ses_fecha').val(data.sesfecha);
            $('#sesTipo_nombre').val('');
        } else {
            $('#sesTipo_id').val('');
            $('#ses_fecha').val('');
            $('#sesTipo_nombre').val('');
            $('#sesTipo_id').prop('disabled', true);
            $('#ses_fecha').prop('disabled', true);
        }
        $('#resol_fecha').val(data.resolfecha);
        $('#resol_numero').val(data.resol_numero);
        $('#resol_fechaSolicitud').val(data.fechasoli);
        $('#resol_nroSolicitud').val(data.resol_nroSolicitud);
        $('#resol_memorando').val(data.resol_memorando);
        $('#per_nroDoc1').val(data.per_nroDoc);
        $('#per_nroDoc1').prop('disabled', true);
        cargarPersona();
        //$('#btnpersona').prop('disabled', true);
        //$('#per_paterno1').val(data.nombre);
        //$('input[name=per_sexo1][value =' + data.per_sexo + ']').prop("checked", true);
        //$('#docTipo_id1').val(data.docTipo_id);
        $('#fecha_actAca').val(data.fechaacto);
        $('#actAca_id').val(data.actAca_id);
        cargarActo();

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');


}

function guardaryeditar(e) {
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
            var formData = new FormData($("#bachiller_form")[0]);
            verDatos();

            $.ajax({
                url: "../../controller/expediente.php?op=guardaryeditar",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    $("#modalmantenimiento").modal('hide');
                    $('#bachiller_data').DataTable().ajax.reload();
                    if (response.length == 4) {
                        swal.fire(
                            'Guardado!',
                            'El registro se ha guardado correctamente.',
                            'success'
                        )
                        /*.then((result) => {
                            if (result.isConfirmed) {
                                //window.location.reload();
                                
                            }
                        })*/
                    } else {
                        swal.fire(
                            'ERROR!',
                            'No se completó la acción. ' + response,
                            'error'
                        )
                    }
                    limpiarCampos();

                }
            });

            //$('#bachiller_form')[0].reset();
            //console.log("reset modal");
        }
    })
}

/*
function limpiarInfo() {
    if (accion === 'nuevo') {
        limpiarCampos();
    } else {
        location.reload();
    }
}
*/
/*
function guardaryeditar2(e) {
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
            var formData = new FormData($("#bachiller_form")[0]);
            verDatos();

            
            $.ajax({
                url: "../../controller/expediente.php?op=guardarBachiller",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    $("#modalmantenimiento").modal('hide');
                    $('#bachiller_data').DataTable().ajax.reload();
                    if (response.length == 4) {
                    
                        swal.fire(
                            'Guardado!',
                            'El registro se ha guardado correctamente.',
                            'success'
                        )
                        /*.then((result) => {
                            if (result.isConfirmed) {
                                //window.location.reload();
                                
                            }
                        })
                    } else {
                        swal.fire(
                            'ERROR!',
                            'No se completó la acción. ' + response,
                            'error'
                        )
                    }
                    limpiarCampos();
                }
            });
            
            //$('#bachiller_form')[0].reset();
            //console.log("reset modal");
        }
    })
}
*/

$(document).on("click", "#btnnuevo", function () {
    limpiarCampos();
    $('#mdltituloB').html('Nuevo Registro');
    $('#esc_code1').focus();
    $('#per_nroDoc1').prop('disabled', false);
    //cargarPersona();
    //$('#btnpersona').prop('disabled', false);
    $('#modalmantenimiento').modal('show');
    //$('#bachiller_form')[0].reset();
});


init();