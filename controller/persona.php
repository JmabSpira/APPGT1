<?php
    require_once("../config/conexion.php");
    require_once("../models/Persona.php");

    $persona = new Persona();

    switch($_GET["op"]){

        case "listar":
            $ap = $_GET["appat"];
            $datos;
            if ($ap == " ") {
                $datos = $persona->get_persona();
                # code...
            }else{
                $datos = $persona->get_persona_x_filtro($ap);
            }
            
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
                //$sub_array[] = $row["docTipo_id"];
                
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

        case "guardaryeditar":
            $datos=$persona->get_persona_x_id($_POST["per_id"]);
            if(empty($_POST["per_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $validar=$persona->validarPersona($_POST["per_nroDoc"]);
                    if ($validar['cantidad'] > 0) {
                        echo "Ya existe una persona registrada con el documento de identidad.";
                    }else{
                        $persona->insert_persona($_POST["per_nroDoc"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"],$_POST["docTipo_id"]);
                        
                    }
                }
            }else{
                //$persona->update_persona($_POST["per_id"],$_POST["per_nroDoc"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"],$_POST["docTipo_id"]);
                $persona->update_persona($_POST["per_id"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"]);
                
            }
            break;

        case "mostrar":
            $datos=$persona->get_persona_x_id($_POST["per_id"]);
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

        case "eliminar":
            $persona->delete_persona($_POST["per_id"]);
            break;
        
        
    }
?>