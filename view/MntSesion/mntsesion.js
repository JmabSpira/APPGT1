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


/*$(document).ready(function(){ 
    tabla=$('#persona_data').dataTable({
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
        "ajax":{
            url: '../../controller/persona.php?op=listar&appat=""',
            type : "get",
            dataType : "json",
            error: function(e){
                console.log(e.responseText);	
            }
        },
		"bDestroy": true,
		"responsive": true,
		"bInfo":true,
		"iDisplayLength": 10,//Por cada 10 registros hace una paginación
	    "order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	    "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
		}
	}).DataTable();
});
*/




function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#sesion_form")[0]);
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

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(ses_id) {
    $.post("../../controller/sesion.php?op=mostrar", {
        ses_id: ses_id
    }, function (data) {
        data = JSON.parse(data);
        $('#ses_id').val(data.ses_id);

        $('#org_id').val(data.org_id);

        cargarTipo(data.sesTipo_id);
        //$('#sesTipo_id').val(data.sesTipo_id);

        //$('#ses_estado').val(data.ses_estado);
        //$('#per_sexo').val(data.per_sexo);
        $('#ses_fecha').val(data.ses_fecha);
        //console.log(data.ses_fecha);

        cargarEstado(data.ses_estado);
        //console.log(data.ses_estado);
        //$('#docTipo_id').val(data.docTipo_id);

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function cargarTipo(sesTipo_id) {
    if (sesTipo_id == 1) {
        //document.getElementsByName("sesTip")
        document.getElementById("sesTipo_id1").checked = true;
        //document.getElementsByName("sesTipo_id1").checked = true;
        //document.querySelector('[value=1]').checked = true;
    } else {
        document.getElementById("sesTipo_id2").checked = true;

        //document.getElementsByName("sesTipo_id2").checked = true;
        //document.querySelector('[value=2]').checked = true;
    }
}

function cargarEstado(ses_estado) {
    if (ses_estado == 1) {
        //document.getElementsByName("ses_estado").checked = true;
        document.getElementById("ses_estado1").checked = true;
        //document.querySelector('[value=1]').checked = true;
    } else {
        document.getElementById("ses_estado2").checked = true;

        //document.getElementsByName("ses_estado").checked = true;
        //document.querySelector('[value=0]').checked = true;
    }
}

/*
function cargarSexo(per_sexo) {
    if (per_sexo == "M") {
        document.querySelector('[value="M"]').checked = true;
    } else {
        document.querySelector('[value="F"]').checked = true;
    }
}

*/

function eliminar(ses_id) {

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

            });

            //$('#persona_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
        $('#sesion_data').DataTable().ajax.reload();
    })

}


$(document).on("click", "#btnnuevo", function () {
    $('#ses_id').val('');
    document.getElementById("filtro").value = "";
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#sesion_form')[0].reset();

});


init();