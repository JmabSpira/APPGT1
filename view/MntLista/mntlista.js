var tabla;

function init() {
    cargarSesion();
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

/*
$(document).on("click", "#btnnuevo", function () {
    $('#exp_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#resolucion_form')[0].reset();

});
*/

init();