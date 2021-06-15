var tabla;

function init(){
    filtrarAp();
    $("#persona_form").on("submit",function(e){
        guardaryeditar(e);
        	
    });
    
}


function filtrarAp() {
    var app = document.getElementById("filtro").value;
    if (app == "") {
        app = " ";
    }
    console.log("var"+app);

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
            
            url: '../../controller/persona.php?op=listar&appat='+app,
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




function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#persona_form")[0]);
    $.ajax({
        url: "../../controller/persona.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            $('#persona_form')[0].reset();
            $("#modalmantenimiento").modal('hide');
            $('#persona_data').DataTable().ajax.reload();

            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

function editar(per_id){
    $.post("../../controller/persona.php?op=mostrar",{per_id:per_id},function (data) {
        data = JSON.parse(data);
        $('#per_id').val(data.per_id);
        $('#per_nroDoc').val(data.per_nroDoc);
        $('#per_paterno').val(data.per_paterno);
        $('#per_materno').val(data.per_materno);
        $('#per_nombres').val(data.per_nombres);
        //$('#per_sexo').val(data.per_sexo);
        cargarSexo(data.per_sexo);
        console.log(data.per_sexo);
            
        $('#docTipo_id').val(data.docTipo_id);

    });
    $('#mdltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');

}

function cargarSexo(per_sexo) {
    if (per_sexo == "M") {
        document.querySelector('[value="M"]').checked = true;
    } else {
        document.querySelector('[value="F"]').checked = true;
    }
}



function eliminar(per_id){

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

            $.post("../../controller/persona.php?op=eliminar",{per_id:per_id},function (data) {

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


$(document).on("click","#btnnuevo", function(){
    $('#per_id').val('');
    document.getElementById("filtro").value = "";
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    $('#persona_form')[0].reset();
    
});


init();