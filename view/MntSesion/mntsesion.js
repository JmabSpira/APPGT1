var tabla;

function init() {
    filtrarAp();
    $("#sesion_form").on("submit", function (e) {
        guardaryeditar(e);

    });

}

function filtrarAp() {
    var app = document.getElementById("filtro").value;

    if (app == "") {
        app = " ";
    }
    console.log("var" + app);
    document.getElementById("filtro").value = "";
    tabla = $('#sesion_data').dataTable({
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

            url: '../../controller/sesion.php?op=listar&appat=' + app,
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
            [0, "desc"]
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

/*
function validarFecha(fecha) {
    let isValidDate = Date.parse(fecha);
    if (isNaN(isValidDate)) {
        return false;
    } else {
        return true;
    }
}
*/
function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#sesion_form")[0]);

    var fecha = $('#ses_fecha').val();
    if (validarFecha(fecha)) {
        $.ajax({
            url: "../../controller/sesion.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                $('#sesion_form')[0].reset();
                $("#modalmantenimiento").modal('hide');
                $('#sesion_data').DataTable().ajax.reload();
                if (datos == false) {
                    swal.fire(
                        'Registro!',
                        'El registro correctamente.',
                        'success'
                    )
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
        swal.fire(
            'ERROR',
            'Ingrese una fecha válida',
            'warning'
        )
    }
    /*
        $.ajax({
            url: "../../controller/sesion.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {
                $('#sesion_form')[0].reset();
                $("#modalmantenimiento").modal('hide');
                $('#sesion_data').DataTable().ajax.reload();
                if (datos == false) {
                    swal.fire(
                        'Registro!',
                        'El registro correctamente.',
                        'success'
                    )
                } else {
                    swal.fire(
                        'ERROR!',
                        'No se completó la acción. Error: ' + datos,
                        'error'
                    )
                }
            }
        });
    */
}

function editar(ses_id) {
    $.post("../../controller/sesion.php?op=mostrar", {
        ses_id: ses_id
    }, function (data) {
        data = JSON.parse(data);
        $('#ses_id').val(data.ses_id);

        $('#org_id').val(data.org_id);

        //cargarTipo(data.sesTipo_id);
        $('input[name=sesTipo_id][value =' + data.sesTipo_id + ']').prop("checked", true);
        $('#ses_fecha').val(data.ses_fecha);
        $('input[name=ses_estado][value =' + data.ses_estado + ']').prop("checked", true);
        //cargarEstado(data.ses_estado);


    });
    $('#ses_estado2').prop('disabled', false);
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function eliminar(ses_id) {
    console.log(ses_id);
    swal.fire({
        title: 'SESIONES',
        text: "Esta seguro de Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/sesion.php?op=eliminar", {
                ses_id: ses_id
            }, function (data) {
                if (data == false) {
                    swal.fire(
                        'Eliminado!',
                        'El registro se elimino correctamente.',
                        'success'
                    )
                    $('#sesion_data').DataTable().ajax.reload();
                } else {
                    swal.fire(
                        'ERROR!',
                        'El registro no se pudo eliminar, ERROR: ' + data,
                        'error'
                    )
                }
            });

            //$('#persona_data').DataTable().ajax.reload();
            /*
                        swal.fire(
                            'Eliminado!',
                            'El registro se elimino correctamente.',
                            'success'
                        )*/
        }
        //$('#sesion_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    $('#ses_id').val('');
    $('#ses_estado2').prop('disabled', true);
    document.getElementById("filtro").value = "";
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#sesion_form')[0].reset();

});


init();