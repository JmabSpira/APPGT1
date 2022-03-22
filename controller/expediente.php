<?php
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");

    $expediente = new Expediente();
    
    switch($_GET["op"]){

        /*
        case "listar":
            $datos = $expediente->get_expediente();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["den_id"];
                $sub_array[] = $row["nivel_nombre"];
                $sub_array[] = $row["esc_sigla"];
                $sub_array[] = $row["den_Mas"];
                $sub_array[] = $row["den_Fem"];
                $sub_array[] = $row["den_MasFem"];
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["den_id"].');"  id="'.$row["den_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["den_id"].');"  id="'.$row["den_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$expediente->get_expediente_x_id($_POST["den_id"]);
            if(empty($_POST["den_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $expediente->insert_expediente($_POST["nivel_id"],$_POST["esc_code"],$_POST["den_Mas"],$_POST["den_Fem"],$_POST["den_MasFem"]);
                }
            }else{
                $expediente->update_expediente($_POST["den_id"],$_POST["nivel_id"],$_POST["esc_code"],$_POST["den_Mas"],$_POST["den_Fem"],$_POST["den_MasFem"]);
            }
            break;
        

        case "mostrar":
            $datos=$expediente->get_expediente_x_id($_POST["den_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["den_id"] = $row["den_id"];
                    $output["nivel_id"] = $row["nivel_id"];
                    $output["esc_code"] = $row["esc_code"];
                    $output["den_Mas"] = $row["den_Mas"];
                    $output["den_Fem"] = $row["den_Fem"];
                    $output["den_MasFem"] = $row["den_MasFem"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $expediente->delete_expediente($_POST["den_id"]);
            break;
        */


        case "guardar":
                $expediente->insert_expediente($_POST["ses_id"],$_POST["genCop_id"],$_POST["nivel_id"],$_POST["esc_id"],$_POST["org_id"],$_POST["resol_id"],$_POST["per_id"],$_POST["actAca_id"],$_POST["den_id"],$_POST["subDen_id"],$_POST["exp_denominacion"]);
            break;

        case "cargarGeneracion":

            $ap = $_GET["appat"];

            $datos = $expediente->cargarGeneracion($ap);
            echo json_encode($datos);
            break;

        case "cargarOrgano":

            $ap = $_GET["appat"];
            $datos = $expediente->cargarOrgano($ap);
            echo json_encode($datos);
            break;

        case "cargarTipoSesion":
            $ap = $_GET["appat"];
            $datos = $expediente->cargarTipoSesion($ap);
            echo json_encode($datos);
            break;
        
        case "cargarPersona":
            $datos=$expediente->get_persona_x_doc($_POST["per_nroDoc"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["per_id"] = $row["per_id"];
                    $output["per_nroDoc"] = $row["per_nroDoc"];
                    $output["per_paterno"] = $row["per_paterno"];
                    $output["per_materno"] = $row["per_materno"];
                    $output["per_nombres"] = $row["per_nombres"];
                    $output["per_sexo"] = $row["per_sexo"];
                    $output["docTipo_id"] = $row["docTipo_id"];
                }
                echo json_encode($output);
            }
            break;
    }
?>