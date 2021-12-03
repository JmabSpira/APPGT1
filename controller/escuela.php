<?php
    require_once("../config/conexion.php");
    require_once("../models/Escuela.php");

    $escuela = new Escuela();

    switch($_GET["op"]){

        case "listar":
            $datos = $escuela->get_escuela();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["esc_id"];
                $sub_array[] = $row["esc_code"];
                $sub_array[] = $row["fac_sigla"];
                $sub_array[] = $row["esc_nombre"];
                $sub_array[] = $row["esc_sigla"];
                $sub_array[] = $row["esc_alias"];
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["esc_id"].');"  id="'.$row["esc_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["esc_id"].');"  id="'.$row["esc_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$escuela->get_escuela_x_id($_POST["esc_id"]);
            if(empty($_POST["esc_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $escuela->insert_escuela($_POST["esc_code"],$_POST["esc_nombre"],$_POST["esc_sigla"],$_POST["esc_alias"],$_POST["fac_id"]);
                }
            }else{
                $escuela->update_escuela($_POST["esc_id"],$_POST["esc_code"],$_POST["esc_nombre"],$_POST["esc_sigla"],$_POST["esc_alias"],$_POST["fac_id"]);
            }
            break;

        case "mostrar":
            $datos=$escuela->get_escuela_x_id($_POST["esc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["esc_id"] = $row["esc_id"];
                    $output["esc_code"] = $row["esc_code"];
                    $output["esc_nombre"] = $row["esc_nombre"];
                    $output["esc_sigla"] = $row["esc_sigla"];
                    $output["esc_alias"] = $row["esc_alias"];
                    $output["fac_id"] = $row["fac_id"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $escuela->delete_escuela($_POST["esc_id"]);
            break;
    }
?>