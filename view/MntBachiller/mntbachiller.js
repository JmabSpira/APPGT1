function init() {
    $("#persona_form").on("submit", function (e) {
        guardaryeditar(e);
    });

}

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($("#persona_form")[0]);
    $.ajax({
        url: "../../controller/persona.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {

            $('#persona_form')[0].reset();
            $("#modalmantenimiento").modal('hide');


            swal.fire(
                'Registro!',
                'El registro correctamente.',
                'success'
            )
        }
    });
}

$(document).on("click", "#btnnuevo", function () {
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    //$('#persona_form')[0].reset();

});

init();