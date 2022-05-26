<?php
    require_once("../config/conexion.php");
    require_once("../models/Diligencia.php");

    $diligencia = new Diligencia();

    switch($_GET["op"]){

        case "listar":
            
            $datos = $diligencia->get_diligencia();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["dil_id"];
                $sub_array[] = $row["sesfecha"];
                $sub_array[] = $row["dil_proveido"];
                $sub_array[] = $row["dil_memosg"];
                $sub_array[] = $row["dil_memogt"];
                $sub_array[] = $row["dil_fechaE"];
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["dil_id"].');"  id="'.$row["dil_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["dil_id"].');"  id="'.$row["dil_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        case "guardaryeditar":
            $datos=$diligencia->get_diligencia_x_id($_POST["dil_id"]);
            if(empty($_POST["dil_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $actual = $diligencia->verificarDiligencia();
                    if ($actual['cantidad'] > 0) {
                        echo "Ya existe una diligencia activa para esta sesión";
                    }else{
                        $diligencia->insert_diligencia($_POST["dil_proveido"],$_POST["dil_memosg"],$_POST["dil_memogt"],$_POST["dil_fechaE"]);
                    }
                }
            }else{
                $diligencia->update_diligencia($_POST["dil_id"],$_POST["dil_proveido"],$_POST["dil_memosg"],$_POST["dil_memogt"],$_POST["dil_fechaE"]);
                //echo json_encode($diligencia);
            }
            
            break;

        case "mostrar":
            $datos=$diligencia->get_diligencia_x_id($_POST["dil_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["dil_id"] = $row["dil_id"];
                    $output["dil_proveido"] = $row["dil_proveido"];
                    $output["dil_memosg"] = $row["dil_memosg"];
                    $output["dil_memogt"] = $row["dil_memogt"];
                    $output["dil_fechaE"] = $row["dil_fechaE"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $diligencia->delete_diligencia($_POST["dil_id"]);
            break;

        case "diligenciaActual":
            $fila = $diligencia->get_diligencia_actual();
            echo json_encode($fila);

            break;
    }