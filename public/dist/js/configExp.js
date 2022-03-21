var inputs = document.getElementsByName('input_exp');

$(document).ready(function () {
    // Consultamos los campos en nuestra pantalla
    //let campos = $('input, select');
    let campos = $('input[name=input_exp]');
    console.log(campos);

    // Indice del campo que actualmente tiene el foco
    let indiceFocus = 0;

    // Por defecto ponemos el foco en el primer campo
    campos[indiceFocus].focus();
    campos[indiceFocus].select();

    $(document).keydown((event) => {
        if (event.which == 13 || event.keyCode == 13) {

            console.log("VALIDAR");
            // Se ha presionado la tecla Enter

            // Aumentamos el indice del campo a enfocar
            if (indiceFocus < (campos.length - 1)) {
                indiceFocus++;
            } else {
                
                indiceFocus = 0;
            }

            // Enfocar en el campo según el indice actual
            campos[indiceFocus].focus();
            campos[indiceFocus].select();
        }
    });
})