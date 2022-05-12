var tabla;
var combo;

function init() {
    $("#resolucion_form").on("submit", function (e) {
        //guardaryeditar(e);
        procesarExpediente(e);

    });
}

$(document).ready(function () {

    tabla = $('#resolucion_data').dataTable({
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
            url: '../../controller/expediente.php?op=listar',
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
});


function procesarExpediente(e) {
    e.preventDefault();
    console.log("Se van a procesar los expedientes");
}

/*
function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#resolucion_form")[0]);
    $.ajax({
        url: "../../controller/denominacion.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#resolucion_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#denominacion_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}
*/
/*
function editar(exp_id) {
    $.post("../../controller/denominacion.php?op=mostrar", {
        exp_id: exp_id
    }, function (data) {
        data = JSON.parse(data);
        $('#exp_id').val(data.exp_id);
        $('#nivel_id').val(data.nivel_id);
        $('#esc_code').val(data.esc_code);
        $('#den_Mas').val(data.den_Mas);
        $('#den_Fem').val(data.den_Fem);
        $('#den_MasFem').val(data.den_MasFem);

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

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

            });

            //$('#denominacion_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El expediente se elimino correctamente.',
                'success'
            )
        }
        $('#resolucion_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    $('#exp_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#resolucion_form')[0].reset();

});


init();