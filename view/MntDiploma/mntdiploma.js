var tabla;
var ses;
var dil;

function init() {
    cargarDiligencia();
}

function cargarDiligencia() {

    $.get("../../controller/diligencia.php?op=diligenciaActual", {}, function (data) {

        if (data === 'false') {
            $('#btnnuevo').prop("disabled", true);
            swal.fire('No hay una diligencia activa');
        }
        data = JSON.parse(data);
        $('#ses_id').val(data.ses_id);
        ses = data.ses_id;
        $('#dil_id').val(data.dil_id);
        dil = data.dil_id;
        $('#ses_data').val(data.sesfecha);
        $('#dil_fechaE').val(data.dil_fechaE);
        listarPorSesion(ses, dil);
    });

}

function listarPorSesion(ses, dil) {

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
                url: '../../controller/expediente.php?op=listarR&ses=' + ses + '&dil=' + dil + '&tipo=1',
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

$(document).on("click", "#btnnuevo", function (e) {
    //$('#exp_id').val('');
    e.preventDefault();
    swal.fire({
        title: 'DIPLOMA',
        text: "Esta seguro de generar los Diplomas?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            console.log("se van a generar los diplomas");
            //var url = '../../../report/resolucionBF.php?ses=' + ses + '&dil=' + dil + '&tipo=0';

            $.ajax({
                url: '../../report/diploma.php?ses=' + ses + '&dil=' + dil + '&tipo=0',
                success: function (response) {
                    var texto = "Se han generado un total de " + response + " diplomas."
                    swal.fire(
                        'DIPLOMAS',
                        texto,
                        'success'
                    )
                }
            })
        }
    })

});



init();