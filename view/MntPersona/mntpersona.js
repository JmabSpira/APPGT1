var tabla;

function init() {
    filtrarAp();

    $("#persona_form").on("submit", function (e) {
        guardaryeditar(e);

    });
    document.getElementById('docTipo_id').addEventListener("change", validar);
}


function filtrarAp() {
    var app = document.getElementById("filtro").value;
    if (app == "") {
        app = " ";
    }

    console.log("var" + app);
    document.getElementById("filtro").value = "";
    tabla = $('#persona_data').dataTable({
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

            url: '../../controller/persona.php?op=listar&appat=' + app,
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

    info = '' + $('#per_nroDoc').val();
    cant = document.getElementById("per_nroDoc").maxLength;
    if (cant == info.length) {
        var formData = new FormData($("#persona_form")[0]);

        $.ajax({
            url: "../../controller/persona.php?op=guardaryeditar",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (datos) {

                if (datos == false) {
                    swal.fire(
                        'Registro!',
                        'El registro correctamente.',
                        'success'
                    )
                    $('#persona_form')[0].reset();
                    $("#modalpersona").modal('hide');
                    $('#persona_data').DataTable().ajax.reload();

                } else {
                    swal.fire(
                        'ERROR!',
                        'No se completó la acción. Error: ' + datos,
                        'error'
                    )
                }
            }

        });
    } else {
        swal.fire("El documento de identidad debe tener " + cant + " dígitos");
    }
}

function editar(per_id) {
    //document.getElementById('docTipo_id').removeEventListener("change", validar);


    $.post("../../controller/persona.php?op=mostrar", {
        per_id: per_id
    }, function (data) {
        data = JSON.parse(data);
        $('#per_id').val(data.per_id);
        $('#per_nroDoc').val(data.per_nroDoc);
        $('#per_paterno').val(data.per_paterno);
        $('#per_materno').val(data.per_materno);
        $('#per_nombres').val(data.per_nombres);
        //$('#per_sexo').val(data.per_sexo);
        $('input[name=per_sexo][value =' + data.per_sexo + ']').prop("checked", true);
        //cargarSexo(data.per_sexo);
        //console.log(data.per_sexo);

        $('#docTipo_id').val(data.docTipo_id);

    });
    $('#per_nroDoc').prop('readonly', true);
    $('#docTipo_id').prop('disabled', true);
    $('#mdltitulo').html('Editar Registro');
    $('#modalpersona').modal('show');

}

function cargarSexo(per_sexo) {
    if (per_sexo == "M") {
        document.querySelector('[value="M"]').checked = true;
    } else {
        document.querySelector('[value="F"]').checked = true;
    }
}

function eliminar(per_id) {

    swal.fire({
        title: 'PERSONAS',
        text: "Esta seguro de Eliminar el Registro?",
        icon: 'error',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {

            $.post("../../controller/persona.php?op=eliminar", {
                per_id: per_id
            }, function (data) {

            });

            //$('#persona_data').DataTable().ajax.reload();

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        }
        $('#persona_data').DataTable().ajax.reload();
    })

}

function validar() {
    opt = $('#docTipo_id').val();
    $('#per_nroDoc').val('');
    if (opt == "1") {
        $('#per_nroDoc').attr('maxlength', '15');
    } else if (opt == "2") {
        $('#per_nroDoc').attr('maxlength', '8');
    } else if (opt == "3") {
        $('#per_nroDoc').attr('maxlength', '11');
    } else if (opt == "4" || opt == "5") {
        $('#per_nroDoc').attr('maxlength', '12');
    } else {
        $('#per_nroDoc').attr('maxlength', '10');
    }
}

$(document).on("click", "#btnnuevo", function () {
    $('#per_id').val('');
    $('#per_nroDoc').prop('readonly', false);
    $('#docTipo_id').prop('disabled', false);
    document.getElementById("filtro").value = "";

    $('#mdltitulo').html('Nuevo Registro');
    $('#modalpersona').modal('show');
    $('#persona_form')[0].reset();
    validarNumeros("#per_nroDoc");
});

init();