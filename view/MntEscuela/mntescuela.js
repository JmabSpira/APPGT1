var tabla;
var combo;

function init() {
    $("#escuela_form").on("submit", function (e) {
        guardaryeditar(e);

    });

}

$(document).ready(function () {

    /*
        const temp = [{
                "id": 1,
                "name": "Aguascalientes"
            },
            {
                "id": 2,
                "name": "Baja California"
            },
            {
                "id": 3,
                "name": "Baja California Sur"
            },
            {
                "id": 4,
                "name": "Campeche"
            },
            {
                "id": 5,
                "name": "Coahuila"
            },
        ];
        var $select = $('#fac_id');


        $.each(temp, function (id, name) {
            $select.append('<option value=' + name.id + '>' + name.name + '</option>');
        });
    */

    $(function () {
        $.ajax({
            type: 'GET',
            url: '../../controller/escuela.php?op=cargarFacultad',
            success: function (response) {

                alert(response);
                alert(typeof (response));

                var json = JSON.parse(response);
                const temp = json;
                alert(temp);
                var $select = $('#fac_id');

                $.each(temp, function (fac_id, fac_sigla) {
                    //$('#fac_id').append('<option value="' + fila[1].fac_id + '>' + fila[1].fac_sigla + '</option>')
                    $select.append('<option value=' + fac_sigla.fac_id + '>' + fac_sigla.fac_sigla + '</option>');
                })

                /*
                                for (var i = 0; i < response.length; i++) {
                                    $('#fac_id').append('<option value="' + (i + 1) + '">' + response['fac_sigla'] + '</option>')


                                }

                */
            }

        })
    })

    tabla = $('#escuela_data').dataTable({
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
            url: '../../controller/escuela.php?op=listar',
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



    /*combo = $('#fac_id').select2({
        ajax: {
            type: 'get',
            url: '../../controller/escuela.php?op=cargarFacultad',
            dataType: 'json',
            // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            success:function(response) {
                $.each
                
            }
        }
    })*/
});


function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#escuela_form")[0]);
    $.ajax({
        url: "../../controller/escuela.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#escuela_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#escuela_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(esc_id) {
    $.post("../../controller/escuela.php?op=mostrar", {
        esc_id: esc_id
    }, function (data) {
        data = JSON.parse(data);
        $('#esc_id').val(data.esc_id);
        $('#esc_code').val(data.esc_code);
        $('#esc_nombre').val(data.esc_nombre);
        $('#esc_sigla').val(data.esc_sigla);
        $('#esc_alias').val(data.esc_alias);
        $('#fac_id').val(data.fac_id);

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function cargarFacultad() {

    combo = $('#fac_id').select2({
        ajax: {
            type: 'get',
            url: '../../controller/escuela.php?op=cargarFacultad',
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

function eliminar(esc_id) {

    swal.fire({
        title: 'ESCUELAS',
        text: "Esta seguro de Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/escuela.php?op=eliminar", {
                esc_id: esc_id
            }, function (data) {

            });

            //$('#escuela_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
        $('#escuela_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    $('#esc_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#escuela_form')[0].reset();

});


init();