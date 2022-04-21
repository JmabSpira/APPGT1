<?php
    require_once("../config/conexion.php");
    require_once("../models/Denominacion.php");

    $denominacion = new Denominacion();
    
    switch($_GET["op"]){

        case "listar":
            $datos = $denominacion->get_denominacion();
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
            $datos=$denominacion->get_denominacion_x_id($_POST["den_id"]);
            if(empty($_POST["den_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $denominacion->insert_denominacion($_POST["nivel_id"],$_POST["esc_code"],$_POST["den_Mas"],$_POST["den_Fem"],$_POST["den_MasFem"]);
                }
            }else{
                $denominacion->update_denominacion($_POST["den_id"],$_POST["nivel_id"],$_POST["esc_code"],$_POST["den_Mas"],$_POST["den_Fem"],$_POST["den_MasFem"]);
            }
            break;

        case "mostrar":
            $datos=$denominacion->get_denominacion_x_id($_POST["den_id"]);
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
            $denominacion->delete_denominacion($_POST["den_id"]);
            break;

        case "cargarEscuela": 
            $datos = $denominacion->cargarEscuela();

            $data= Array();

            foreach ($datos as $row) {
                # code...
                $esc_code = $row['esc_code'];
                $esc_alias = $row['esc_alias'];
                $data[] = array('esc_code'=>$esc_code, 'esc_alias'=>$esc_alias);
            }

            $results = array("data"=>$data);
            //$results = array($data);

            
            echo json_encode($data);
            //echo json_encode($results);
            break;

        case "cargarEscuelaBT": 

            $datos = $denominacion->cargarEscuelaBT();

            $data= Array();

            foreach ($datos as $row) {
                # code...
                $esc_code = $row['esc_code'];
                $esc_alias = $row['esc_alias'];
                $data[] = array('esc_code'=>$esc_code, 'esc_alias'=>$esc_alias);
            }

            $results = array("data"=>$data);
            //$results = array($data);

            
            echo json_encode($data);
            //echo json_encode($results);
            break;

      case "cargarEscuelaE": 

            $inicio = $_GET["inicio"];
            $fin = $_GET["fin"];

            $datos = $denominacion->cargarEscuelaE($inicio,$fin);

            $data= Array();

            foreach ($datos as $row) {
                # code...
                $esc_code = $row['esc_code'];
                $esc_alias = $row['esc_alias'];
                $data[] = array('esc_code'=>$esc_code, 'esc_alias'=>$esc_alias);
            }

            $results = array("data"=>$data);
            //$results = array($data);

            
            echo json_encode($data);
            //echo json_encode($results);
            break;
            
    }
?>