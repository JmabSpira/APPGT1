function validarFecha(fecha) {
    let isValidDate = Date.parse(fecha);
    if (isNaN(isValidDate)) {
        return false;
    } else {
        return true;
    }
}

function validarNumeros(elemento) {

    jQuery(elemento).on('input', function (evt) {
        // Allow only numbers.
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
}

