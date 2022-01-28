var combo;

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

/*
input.onblur = function () {
    if (!input.value.includes('@')) { // not email
        input.classList.add('invalid');
        error.innerHTML = 'Por favor introduzca un correo válido.'
    }
};
*/




$(document).ready(function () {
    cargarEscuela();
    cargarDenominacion();


});


function cargarEscuela() {
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
}

function cargarDenominacion() {
    var nivel = 1;
    $.ajax({
        type: 'GET',
        url: '../../controller/subdenominacion.php?op=cargarDenominacionPorNivel&appat=' + nivel,
        success: function (response) {

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
}

/*
$('#genCop_id').keypress(function (e) {
    if (e.which == 13) {
        //EjecutaScript();
        document.getElementById('nivel_id').focus();
        //alert("Buscar Generacion");

    }
});
*/
/*
$(".miClase").keypress(function (e) {
    if (e.which == 13) {
        var a = e.target.nextElementSibling;
        a.focus();
        console.log(a.innerHTML);
    }
});

*/
function pulsar(e, id) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        var boton = document.getElementById(id);
        alert("Buscar Generacion");
        boton.focus();
        boton.select();

    }
}



$(document).on("click", "#btnnuevo", function () {
    $('#mdltitulo').html('Nuevo Registro');
    $('#modalmantenimiento').modal('show');
    //$('#persona_form')[0].reset();

});

init();