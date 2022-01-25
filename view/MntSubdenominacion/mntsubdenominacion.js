var tabla;
var combo;

function init() {
    $("#subdenominacion_form").on("submit", function (e) {
        guardaryeditar(e);

    });

}

$(document).ready(function () {

    $(function () {
        $.ajax({
            type: 'GET',
            url: '../../controller/subdenominacion.php?op=cargarDenominacion',
            success: function (response) {

                //alert(response);
                //alert(typeof (response));

                var json = JSON.parse(response);
                const temp = json;
                //alert(temp);
                var $select = $('#den_id');

                $.each(temp, function (den_id, den_MasFem) {
                    //$('#den_id').append('<option value="' + fila[1].den_id + '>' + fila[1].den_MasFem + '</option>')
                    $select.append('<option value=' + den_MasFem.den_id + '>' + den_MasFem.den_MasFem + '</option>');
                })
            }

        })
    })

    tabla = $('#subdenominacion_data').dataTable({
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
            url: '../../controller/subdenominacion.php?op=listar',
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


function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#subdenominacion_form")[0]);
    $.ajax({
        url: "../../controller/subdenominacion.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#subdenominacion_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#subdenominacion_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(subDen_id) {
    $.post("../../controller/subdenominacion.php?op=mostrar", {
        subDen_id: subDen_id
    }, function (data) {
        data = JSON.parse(data);
        $('#subDen_id').val(data.subDen_id);
        $('#den_id').val(data.den_id);
        $('#subDen_MasFem').val(data.subDen_MasFem);

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function cargarDenominacion() {

    combo = $('#den_id').select2({
        ajax: {
            type: 'get',
            url: '../../controller/subdenominacion.php?op=cargarDenominacion',
            dataType: 'json',
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            error: function (e) {
                console.log(e.responseText);
            }
        },
        "order": [
            [0, "asc"]
        ],
        "language": {
            "sProcessing": "Procesando...",
            "sZeroRecords": "No se encontraron resultados",
            "sLoadingRecords": "Cargando...",
        }
    }).select2();
}

function eliminar(subDen_id) {

    swal.fire({
        title: 'SUBDENOMINACIONES',
        text: "Esta seguro de Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/subdenominacion.php?op=eliminar", {
                subDen_id: subDen_id
            }, function (data) {

            });

            //$('#subdenominacion_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
        $('#subdenominacion_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    $('#subDen_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#subdenominacion_form')[0].reset();

});


init();