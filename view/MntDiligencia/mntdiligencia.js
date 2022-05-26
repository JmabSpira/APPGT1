var tabla;

function init() {
    $("#diligencia_form").on("submit", function (e) {
        guardaryeditar(e);

    });
}

$(document).ready(function () {
    tabla = $('#diligencia_data').dataTable({
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
            url: '../../controller/diligencia.php?op=listar',
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
});

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#diligencia_form")[0]);

    var fecha = $('#dil_fechaE').val();
    if (validarFecha(fecha)) {
        $.ajax({
            url: "../../controller/diligencia.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {

                $('#diligencia_form')[0].reset();
                $("#modalmantenimiento").modal('hide');
                $('#diligencia_data').DataTable().ajax.reload();

                if (datos == false) {
                    swal.fire(
                        'Registro!',
                        'El registro correctamente.',
                        'success'
                    )
                } else {
                    swal.fire(
                        'ERROR!',
                        'No se completó la acción. ' + datos,
                        'error'
                    )
                }
            }
        });
    } else {
        swal.fire("Ingrese una fecha válida")
    }
}

function editar(dil_id) {
    $.post("../../controller/diligencia.php?op=mostrar", {
        dil_id: dil_id
    }, function (data) {
        data = JSON.parse(data);
        $('#dil_id').val(data.dil_id);
        $('#dil_proveido').val(data.dil_proveido);
        $('#dil_memosg').val(data.dil_memosg);
        $('#dil_memogt').val(data.dil_memogt);
        $('#dil_fechaE').val(data.dil_fechaE);
    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function eliminar(dil_id) {

    swal.fire({
        title: 'DILIGENCIA',
        text: "Esta seguro de Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/diligencia.php?op=eliminar", {
                dil_id: dil_id
            }, function (data) {

            });

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
        $('#diligencia_data').DataTable().ajax.reload();
    })

}

$(document).on("click", "#btnnuevo", function () {
    $('#dil_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#diligencia_form')[0].reset();

});


init();