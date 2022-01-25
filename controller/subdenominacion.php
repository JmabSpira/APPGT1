<?php
    require_once("../config/conexion.php");
    require_once("../models/Subdenominacion.php");

    $subdenominacion = new Subdenominacion();
    
    switch($_GET["op"]){

        case "listar":
            $datos = $subdenominacion->get_subdenominacion();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["subDen_id"];
                $sub_array[] = $row["nivel_nombre"];
                $sub_array[] = $row["den_MasFem"];
                $sub_array[] = $row["subDen_MasFem"];
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["subDen_id"].');"  id="'.$row["subDen_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["subDen_id"].');"  id="'.$row["subDen_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
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
            $datos=$subdenominacion->get_subdenominacion_x_id($_POST["subDen_id"]);
            if(empty($_POST["subDen_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $subdenominacion->insert_subdenominacion($_POST["den_id"],$_POST["subDen_MasFem"]);
                }
            }else{
                $subdenominacion->update_subdenominacion($_POST["subDen_id"],$_POST["den_id"],$_POST["subDen_MasFem"]);
            }
            break;

        case "mostrar":
            $datos=$subdenominacion->get_subdenominacion_x_id($_POST["subDen_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["subDen_id"] = $row["subDen_id"];
                    $output["den_id"] = $row["den_id"];
                    $output["subDen_MasFem"] = $row["subDen_MasFem"];
                }
                echo json_encode($output);
            }
            break;

        case "eliminar":
            $subdenominacion->delete_subdenominacion($_POST["subDen_id"]);
            break;

        case "cargarDenominacion": 
            $datos = $subdenominacion->cargarDenominacion();

            $data= Array();

            foreach ($datos as $row) {
                # code...
                $den_id = $row['den_id'];
                $den_MasFem = $row['den_MasFem'];
                $data[] = array('den_id'=>$den_id, 'den_MasFem'=>$den_MasFem);
            }

            $results = array("data"=>$data);
            //$results = array($data);

            
            echo json_encode($data);
            //echo json_encode($results);
            break;
    }
?>