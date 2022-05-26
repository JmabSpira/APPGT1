var tabla;

function init() {

    console.log($('#dato').val());
    console.log(typeof ($('#dato').val()));

    if ($('#dato').val() == "1") {
        cargarFacultad();
    } else if ($('#dato').val() == "2") {
        cargarEscuelaBT();
    } else {
        cargarNivel();
    }
    document.getElementById('filtro').addEventListener("change", enviarFiltro);
}


function cargarEscuelaBT() {

    $.ajax({
        type: 'GET',
        url: '../../controller/denominacion.php?op=cargarEscuelaBT',
        success: function (response) {

            //alert(response);
            //alert(typeof (response));

            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            var $select = $('#filtro');

            $.each(temp, function (esc_code, esc_alias) {
                //$('#filtro').append('<option value="' + fila[1].esc_code + '>' + fila[1].esc_alias + '</option>')
                $select.append('<option value=' + esc_alias.esc_code + '>' + esc_alias.esc_alias + '</option>');
            })
        }

    })
}

function cargarFacultad() {
    $.ajax({
        type: 'GET',
        url: '../../controller/escuela.php?op=cargarFacultad',
        success: function (response) {

            //alert(response);
            //alert(typeof (response));

            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            var $select = $('#filtro');

            $.each(temp, function (fac_id, fac_sigla) {
                console.log(fac_sigla.fac_id);
                console.log(fac_id);
                //$('#fac_id').append('<option value="' + fila[1].fac_id + '>' + fila[1].fac_sigla + '</option>')
                $select.append('<option value=' + fac_sigla.fac_id + '>' + fac_sigla.fac_sigla + '</option>');
            })
        }

    })
}

function cargarNivel() {
    $.ajax({
        type: 'GET',
        url: '../../controller/expediente.php?op=cargarNivel',
        success: function (response) {

            //alert(response);
            //alert(typeof (response));
            console.log(response);
            var json = JSON.parse(response);
            const temp = json;
            //alert(temp);
            var $select = $('#filtro');

            $.each(temp, function (nivel_id, nivel_nombre) {
                //$('#fac_id').append('<option value="' + fila[1].fac_id + '>' + fila[1].fac_sigla + '</option>')
                $select.append('<option value=' + nivel_nombre.nivel_id + '>' + nivel_nombre.nivel_nombre + '</option>');
            })
        }

    })
}

function enviarFiltro() {
    valor = $('#dato').val();
    dato = $('#filtro').val();
    console.log(dato);
    if (valor == "1") {
        listarPorFiltro(dato, '', '');
    } else if (valor == "2") {
        listarPorFiltro('', dato, '');
    } else {
        listarPorFiltro('', '', dato);
    }
}

function listarPorFiltro(fac, esc, niv) {

    console.log("var en tabla: " + valor);
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
            url: '../../controller/expediente.php?op=listarFiltro&fac=' + fac + '&esc=' + esc + '&niv=' + niv,
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

        $('#resolucion_data').DataTable().ajax.reload();
    })

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