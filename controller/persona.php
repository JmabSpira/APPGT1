<?php
    require_once("../config/conexion.php");
    require_once("../models/Persona.php");

    $persona = new Persona();

    switch($_GET["op"]){

        case "listar":
            $datos=$persona->get_persona();
            $data= Array();

            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["per_id"];
                $sub_array[] = $row["docTipo_sigla"];
                $sub_array[] = $row["per_nroDoc"];
                $sub_array[] = $row["per_paterno"];
                $sub_array[] = $row["per_materno"];
                $sub_array[] = $row["per_nombres"];
                $sub_array[] = $row["per_sexo"];
                

                $sub_array[] = '<button type="button" onClick="editar('.$row["per_id"].');"  id="'.$row["per_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["per_id"].');"  id="'.$row["per_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;
/*
        case "guardaryeditar":
            $datos=$persona->get_persona_x_id($_POST["per_id"]);
            if(empty($_POST["per_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $persona->insert_producto($_POST["prod_nom"]);
                }
            }else{
                $persona->update_producto($_POST["per_id"],$_POST["prod_nom"]);
            }
            break;

        case "mostrar":
            $datos=$persona->get_producto_x_id($_POST["per_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["per_id"] = $row["per_id"];
                    $output["prod_nom"] = $row["prod_nom"];
                }
            }
            break;

        case "eliminar":
            $persona->delete_producto($_POST["per_id"]);
            break;
*/
    }
?>