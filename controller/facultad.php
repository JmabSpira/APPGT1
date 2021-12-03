<?php
    require_once("../config/conexion.php");
    require_once("../models/Facultad.php");

    $facultad = new Facultad();

    switch($_GET["op"]){

        case "listar":
            $datos = $facultad->get_facultad();
            $data= Array();

            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["fac_id"];
                $sub_array[] = $row["fac_nombre"];
                $sub_array[] = $row["fac_sigla"];
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["fac_id"].');"  id="'.$row["fac_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$facultad->get_facultad_x_id($_POST["fac_id"]);
            if(empty($_POST["fac_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $facultad->insert_facultad($_POST["fac_nombre"],$_POST["fac_sigla"]);
                }
            }else{
                $facultad->update_facultad($_POST["fac_id"],$_POST["fac_nombre"],$_POST["fac_sigla"]);
            }
            break;

        case "mostrar":
            $datos=$facultad->get_facultad_x_id($_POST["fac_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["fac_id"] = $row["fac_id"];
                    $output["fac_nombre"] = $row["fac_nombre"];
                    $output["fac_sigla"] = $row["fac_sigla"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $facultad->delete_facultad($_POST["fac_id"]);
            break;
    }
?>