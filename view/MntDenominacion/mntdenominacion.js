var tabla;
var combo;

function init() {
    $("#denominacion_form").on("submit", function (e) {
        guardaryeditar(e);

    });

}

$(document).ready(function () {

    $(function () {
        $.ajax({
            type: 'GET',
            url: '../../controller/denominacion.php?op=cargarEscuela',
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
    })

    tabla = $('#denominacion_data').dataTable({
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
            url: '../../controller/denominacion.php?op=listar',
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
    var formData = new FormData($("#denominacion_form")[0]);
    $.ajax({
        url: "../../controller/denominacion.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#denominacion_form')[0].reset();
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

function editar(den_id) {
    $.post("../../controller/denominacion.php?op=mostrar", {
        den_id: den_id
    }, function (data) {
        data = JSON.parse(data);
        $('#den_id').val(data.den_id);
        $('#nivel_id').val(data.nivel_id);
        $('#esc_code').val(data.esc_code);
        $('#den_Mas').val(data.den_Mas);
        $('#den_Fem').val(data.den_Fem);
        $('#den_MasFem').val(data.den_MasFem);

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function cargarEscuela() {

    combo = $('#esc_code').select2({
        ajax: {
            type: 'get',
            url: '../../controller/denominacion.php?op=cargarEscuela',
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

function eliminar(den_id) {

    swal.fire({
        title: 'DENOMINACIONES',
        text: "Esta seguro de Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/denominacion.php?op=eliminar", {
                den_id: den_id
            }, function (data) {

            });

            //$('#denominacion_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
        $('#denominacion_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    $('#den_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#denominacion_form')[0].reset();

});


init();