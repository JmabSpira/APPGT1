var tabla;

function init() {
    cargarSesion();
    $("#resolucion_form").on("submit", function (e) {
        //guardaryeditar(e);
        procesarExpediente(e);

    });
}

function cargarSesion() {

    $.get("../../controller/sesion.php?op=sesionActual", {}, function (data) {
        data = JSON.parse(data);
        $('#ses_id').val(data.ses_id);
        console.log(data.ses_id);
        var ses = data.ses_id;
        console.log("Ses: " + ses);
        var infoSes = data.org_acronimo + " - " + data.sesTipo_sigla + " - " + data.ses_fecha;
        $('#ses_data').val(infoSes);
        console.log(data.ses_id + data.org_acronimo + data.ses_fecha);

        listarPorSesion(ses);
    });
}

function listarPorSesion(ses) {

    console.log("var en tabla: " + ses);
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
                url: '../../controller/expediente.php?op=listarR&ses=' + ses + '&dil=' + 1,
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
}

function procesarExpediente(e) {
    e.preventDefault();
    //'href', '../../../report/resolucionBF.php?ses=' + 1 + '&dil=' + 1 + '&tipo=0'
    console.log("Se van a procesar los expedientes");
}

function generarDoc(doc_id) {

    swal.fire({
        title: 'RESOLUCIÓN',
        text: "Esta seguro de generar la Resolución?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {


            console.log(doc_id);

            /*
            $.post("../../report/resolucionB.php?op=individual", {
                doc_id: doc_id
            }, function (data) {

            });*/

            //$('#denominacion_data').DataTable().ajax.reload();
        }
        $('#resolucion_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    //$('#exp_id').val('');

    swal.fire({
        title: 'RESOLUCIÓN',
        text: "Esta seguro de generar las Resoluciones?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            console.log("se van a generar las resoluciones");
            var url = '../../../report/resolucionBF.php?ses=' + 1 + '&dil=' + 1 + '&tipo=0';

            $.ajax({
                url: '../../report/resolucionBF.php?ses=' + 1 + '&dil=' + 1 + '&tipo=0',
                success: function (response) {
                    var texto = "Se han generado un total de " + response + " resoluciones."
                    swal.fire(
                        'RESOLUCIONES',
                        texto,
                        'success'
                    )
                }
            })
        }
    })

});


init();