/*$(document).ready(function () {
    // Consultamos los campos en nuestra pantalla
    //let campos = $('input, select');
    //let campos = $('input[name=input_exp]');
    let campos = $('input[name=input_exp],select[name=input_exp]');
    console.log(campos);

    // Por defecto ponemos el foco en el primer campo
    campos[0].focus();
    campos[0].select();

    for (i = 1; i < campos.length; i++) {

        console.log("ingresa: " + campos[i - 1].id);
        console.log(campos[i].id);
        //document.getElementById(campos[i - 1].id).onkeydown = imprimir(campos[i].id);
        var elemento = document.getElementById(campos[i - 1].id);
        console.log(elemento);

        var siguiente = document.getElementById(campos[i].id);
        //inputs[i].addEventListener("keypress", send_key_tab);
        elemento.addEventListener("keypress", (e) => {
            imprimir(siguiente.id);
            /*console.log(e);
            console.log(e.type);
            console.log(e.target);
            if (e.keyCode === 13 && !e.shiftKey) {
                e.preventDefault();
                console.log("ELEMENTO: " + siguiente.id);
                document.getElementById(siguiente.id).focus();
            }
        })
    }

})

/*
function imprimir(elem) {

    //$(document).keydown((event) => {

    if (event.which == 13 || event.keyCode == 13) {

        console.log("saltar al id: " + elem);
        document.getElementById(elem).focus();
    }
    //});

}
/*
function pulsar(e, id) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        var boton = document.getElementById(id);
        alert("Buscar Generacion");
        boton.focus();
        boton.select();

    }
}*/
//var inputs = document.getElementsByName('input_exp');


$(document).ready(function () {
    // Consultamos los campos en nuestra pantalla
    //let campos = $('input, select');
    //let campos = $('input[name=input_exp]');
    let campos = $('input[name=input_exp],select[name=input_exp]');
    console.log(campos);

    // Indice del campo que actualmente tiene el foco
    let indiceFocus = 0;
    // Por defecto ponemos el foco en el primer campo
    campos[indiceFocus].focus();
    campos[indiceFocus].select();

    $(document).keydown((event) => {

        if (event.which == 13 || event.keyCode == 13) {

            // Aumentamos el indice del campo a enfocar
            console.log("VALIDAR");

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

    document.getElementById('ses_id').addEventListener("keypress", console.log("Imprimir"));
})

/*
function saltarEnter() {
    // Consultamos los campos en nuestra pantalla
    //let campos = $('input, select');
    //let campos = $('input[name=input_exp]');
    let campos = $('input[name=input_exp],select[name=input_exp]');
    console.log(campos);

    // Indice del campo que actualmente tiene el foco
    let indiceFocus = 0;
    // Por defecto ponemos el foco en el primer campo
    campos[indiceFocus].focus();
    campos[indiceFocus].select();

    $(document).keydown((event) => {

        if (event.which == 13 || event.keyCode == 13) {

            // Aumentamos el indice del campo a enfocar
            console.log("VALIDAR");

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
}






$(document).ready(function () {

    let campos = $('input[name=input_exp],select[name=input_exp]');
    console.log(campos);
    let indiceFocus = 0;

    campos[indiceFocus].focus();
    campos[indiceFocus].select();

    for (i = 0; i < campos.length; i++) {

        //campos[i].addEventListener("keydown", send_key(campos, (i + 1)));
        campos[i].addEventListener("keydown", send_key_tab);
        //Agregamos la función a detonar
        //inputs[i].addEventListener("keypress", send_key_tab);
        //inputs[i].addEventListener("keypress", pulsar(inputs[i + 1].id));
        console.log("ingresa")
    }

})
/*
window.onload = function () {

    //Se ciclan todos los inputs
    for (i = 0; i < inputs.length; i++) {

        if (i == 0) {
            console.log(inputs[i]);
            inputs[i].focus();
        }

        if (i < 12) {
            inputs[i].addEventListener("onkeypress", imprimir());
        }

        //Agregamos la función a detonar
        //inputs[i].addEventListener("keypress", send_key_tab);
        //inputs[i].addEventListener("keypress", pulsar(inputs[i + 1].id));
        console.log("ingresa")
    }

    //Se liga la funcion al evento click del boton el evento click
    //document.getElementsByTagName('button')[0].addEventListener("click", aceptar);
}

*/
/*
function send_key(campos, indice) {


    let indiceFocus = indice;

    $(document).keydown((event) => {
        if (event.which == 13 || event.keyCode == 13) {


            // Aumentamos el indice del campo a enfocar
            console.log("VALIDAR");
            /*
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

}

function send_key_tab(e) {

    //Se carga el valor del código de la tecla presionada
    var keycode = e.keycode;
    console.log(keycode);

    if (keycode == '13') {

        //Se previee la accion predeterminada para solo un enter
        e.preventDefault();

        //Se itera por todos los inputs existentes
        for (x = 0; x < inputs.length; x++) {

            //Se valida cual de ellos es el actual
            if (inputs[x].id = e.target.id) {

                //Se carga el siguiente
                var nextInput = inputs[x + 1];
            }
        }

        //Si se encontro el siguiente input
        if (nextInput) {
            nextInput.focus();
            nextInput.select();

        } else {

            document.getElementsByTagName('button')[0].focus();

            document.getElementsByTagName('button')[0].click();

            console.log("No llega");

        }
    }
}

/*
const input = document.querySelector('input');
const log = document.getElementById('valores');

input.addEventListener('input', updateValue);

function updateValue(e) {
    log.textContent = e.srcElement.value;
}
*/