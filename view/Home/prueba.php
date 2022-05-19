<?php

    $den = "Tengo Cuatro,  Palabras: hola mundo. prueba piedra";
    $cant = str_word_count($den);
    $palabras = explode(" ",$den);

    $den1 = "";
    $den2 = "";
    $cont = 0;
    while ($cont < $cant) {
        if ($cont < floor($cant/2)) {
            $den1 = $den1 . " " . $palabras[$cont];
        }else{
            $den2 = $den2 . " " . $palabras[$cont];
        }
        $cont++;
    }

    echo($den1);
    echo($den2);



?>