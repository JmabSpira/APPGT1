var tabla;

function init() {
    cargarSesion();

    $("#persona_form").on("submit", function (e) {
        guardarPersonaE(e);
    });

    $("#bachiller_form").on("submit", function (e) {
        guardaryeditar(e);

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

function cargarSesion() {
    var ses;
    $.get("../../controller/sesion.php?op=sesionActual", {}, function (data) {
        data = JSON.parse(data);
        $('#ses_id').val(data.ses_id);
        ses = data.ses_id;
        var infoSes = data.org_acronimo + " - " + data.sesTipo_sigla + " - " + data.ses_fecha;
        $('#ses_data').val(infoSes);
        console.log(data.ses_id + data.org_acronimo + data.ses_fecha);

        listarPorSesion(ses);
    });

}

function listarPorSesion(ses) {

    //var ses = $('#ses_id').val();

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
            url: '../../controller/expediente.php?op=listar&ses=' + ses,
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

            /*
                        $.post("../../controller/expediente.php?op=eliminar", {
                            exp_id: exp_id
                        }, function (data) {

                        });

                        //$('#denominacion_data').DataTable().ajax.reload();

                        swal.fire(
                            'Eliminado!',
                            'El expediente se elimino correctamente.',
                            'success'
                        )*/
            console.log(exp_id);
        }

        $('#bachiller_data').DataTable().ajax.reload();
    })

}

function guardarExpediente(e) {
    e.preventDefault();
    /*
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
                //$('#persona_data').DataTable().ajax.reload();

                $.ajax({
                    url: "../../controller/expediente.php?op=guardarBachiller",
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
        })*/
}

$(document).on("click", "#btnnuevo", function () {
    $('#mdltituloB').html('Nuevo Registro');
    $('#modalmantenimiento').on('shown.bs.modal', function () {
        $('#esc_code1').focus();

    })
    $('#modalmantenimiento').modal('show');
    $('#bachiller_form')[0].reset();
});


init();