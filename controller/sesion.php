<?php
    require_once("../config/conexion.php");
    require_once("../models/Sesion.php");

    $sesion = new Sesion();

    switch($_GET["op"]){

        case "listar":
            $sf = $_GET["appat"];
            $datos;
            if ($sf == " ") {
                $datos = $sesion->get_sesion();
                # code...
            }else{
                $datos = $sesion->get_sesion_x_fecha($sf);
            }
            
            $data= Array();

            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["ses_id"];
                $sub_array[] = $row["ses_fecha"];
                $sub_array[] = $row["sesTipo_nombre"];
                $sub_array[] = $row["org_nombre"];
                $sub_array[] = $row["ses_estado"];
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["ses_id"].');"  id="'.$row["ses_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["ses_id"].');"  id="'.$row["ses_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$sesion->get_sesion_x_id($_POST["ses_id"]);
            if(empty($_POST["ses_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $sesion->insert_sesion($_POST["org_id"],$_POST["sesTipo_id"],$_POST["ses_fecha"],$_POST["ses_estado"]);
                }
            }else{
                $sesion->update_sesion($_POST["ses_id"],$_POST["org_id"],$_POST["sesTipo_id"],$_POST["ses_fecha"],$_POST["ses_estado"]);
            }
            break;

        case "mostrar":
            $datos=$sesion->get_sesion_x_id($_POST["ses_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["ses_id"] = $row["ses_id"];
                    $output["org_id"] = $row["org_id"];
                    $output["sesTipo_id"] = $row["sesTipo_id"];
                    $output["ses_fecha"] = $row["ses_fecha"];
                    $output["ses_estado"] = $row["ses_estado"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $sesion->delete_sesion($_POST["ses_id"]);
            break;

        case "sesionActual":
            $fila = $sesion->get_sesion_actual();
            echo json_encode($fila);


            break;
    }
?>