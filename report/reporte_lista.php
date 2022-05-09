<?php

    require_once('../public/plugins/fpdf/fpdf.php');
    //Constructor

    //'P' vertical 'L' Horizontal. medida mm,cm, in,pt, tamaño 
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->SetFont('Arial','B',11);
    //ancho, alto, texto a mostrar,borde 0 - 1, salto de linea, alineacion 
    $pdf->Cell(50,12,'Hola Mundo',0,1,'R');
    $pdf->Output();





?>