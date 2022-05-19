<?php
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");
    

    $expediente = new Expediente();

    function formatoFecha($vfecha){
        $fch=explode("/",$vfecha);
        $tfecha=$fch[2]."-".$fch[1]."-".$fch[0];
        return $tfecha;
            
    }

    switch($_GET["op"]){

        case "listar":
            $ses = $_GET["ses"];

            $datos = $expediente->get_lista_expediente($ses);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["num"];
                $sub_array[] = $row["exp_id"];
                $sub_array[] = $row["nombre"];
                $sub_array[] = $row["exp_denominacion"];
                $sub_array[] = $row["fechaA"];
                
                //$sub_array[] = '<button type="button" onClick="editar('.$row["den_id"].');"  id="'.$row["den_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["exp_id"].');"  id="'.$row["exp_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-trash"></i></div></button>';
                $data[]=$sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);

            break;

        case "listarR":

            $ses = $_GET["ses"];
            $dil = $_GET["dil"];
            $doc = $_GET["tipo"];

            $datos = $expediente->get_lista_expediente($ses);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["num"];
                $sub_array[] = $row["exp_id"];
                $sub_array[] = $row["nombre"];
                $sub_array[] = $row["exp_denominacion"];
                
                if ($doc == 1) {
                    $href = 'href="../../report/diploma.php?exp='.$row["exp_id"].'&dil='.$dil.'&tipo=1"';
                }elseif ($doc == 0) {
                    $href = 'href="../../report/resolucionBF.php?exp='.$row["exp_id"].'&dil='.$dil.'&tipo=1"';
                }else{
                    echo("Error de tipo de documento");
                }
                //$sub_array[] = '<button '.$estado.' type="button" onClick="generarDoc('.$row["doc_id"].');"  id="'.$row["doc_id"].'" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-file-word"></i></div></button>';
                $sub_array[] = '<a '.$href.'><button type="button" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-file-word"></i></div></button> 
                </a>';
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
*/

        case "eliminar":
            $expediente->delete_expediente($_POST["exp_id"]);
            break;
        

            /*
        case "guardar":
                $expediente->insert_expediente($_POST["ses_id"],$_POST["genCop_id"],$_POST["nivel_id"],$_POST["esc_id"],$_POST["org_id"],$_POST["resol_id"],$_POST["per_id"],$_POST["actAca_id"],$_POST["den_id"],$_POST["subDen_id"],$_POST["exp_denominacion"]);
            break;

        case "guardarExpediente":
            $datos=$expediente->get_expediente_x_id($_POST["exp_id"]);
            if(empty($_POST["exp_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $expediente->insert_expedienteCC($_POST["per_nroDoc"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"],$_POST["docTipo_id"]);
                }
            }else{
                $expediente->update_expediente($_POST["per_id"],$_POST["per_nroDoc"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"],$_POST["docTipo_id"]);
            }
            break;
*/
            //$ses_id,$nivel_id,$genCop_id,$esc_code,$org_id,$sesTipo_id,$ses_fecha,$resol_fecha,$resol_numero,
            //      $resol_fechaSolicitud,$resol_nroSolicitud,$resol_memorando,$per_id,$actAca_id,$fecha_actAca,$den_id,$subDen_id
/*
        case "guardarExpediente":
            $datos=$expediente->get_expediente_persona($_POST["exp_id"]);
            if(empty($_POST["exp_id"])){
                if(is_array($datos)==true and count($datos)==0){
                    $expediente->insert_expedienteCC($_POST["per_nroDoc"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"],$_POST["docTipo_id"]);
                }
            }else{
                $expediente->update_expediente($_POST["per_id"],$_POST["per_nroDoc"],$_POST["per_paterno"],$_POST["per_materno"],$_POST["per_nombres"],$_POST["per_sexo"],$_POST["docTipo_id"]);
            }
            break;
*/
        case "guardarBachiller":
            $datos = $expediente->verificarExpediente($_POST["per_idE"],$_POST["nivel_idE"],$_POST["genCop_idE"]);
            if ($datos['cantidad'] > 0) {
                echo "ERROR YA EXISTE UN REGISTRO",$datos['cantidad'];
            }else{
                $resol_fecha = formatoFecha($_POST["resol_fechaE"]);
                $resol_fechaSolicitud = formatoFecha($_POST["resol_fechaSolicitudE"]);
                $fecha_actAca = formatoFecha($_POST["fecha_actAcaE"]);
                if (isset($_POST["sesTipo_idE"],$_POST["ses_fechaE"])) {

                    $ses_fecha = formatoFecha($_POST["ses_fechaE"]);
                    
                    $expediente->insert_expediente($_POST["ses_idE"],$_POST["nivel_idE"],$_POST["genCop_idE"],$_POST["esc_codeE"],$_POST["org_idE"],$_POST["sesTipo_idE"],
                    $ses_fecha,$resol_fecha,$_POST["resol_numeroE"],$resol_fechaSolicitud,$_POST["resol_nroSolicitudE"],
                    $_POST["resol_memorandoE"],$_POST["per_idE"],$_POST["actAca_idE"],$fecha_actAca,$_POST["den_idE"]);
                    echo json_encode($expediente);

                }else{
                    $expediente->insert_expediente($_POST["ses_idE"],$_POST["nivel_idE"],$_POST["genCop_idE"],$_POST["esc_codeE"],$_POST["org_idE"],null,
                    NULL,$resol_fecha,$_POST["resol_numeroE"],$resol_fechaSolicitud,$_POST["resol_nroSolicitudE"],
                    $_POST["resol_memorandoE"],$_POST["per_idE"],$_POST["actAca_idE"],$fecha_actAca,$_POST["den_idE"]);
                    echo json_encode($expediente);
                    
                } 
                
            }
            break;

        case "guardarExpediente":
            $datos = $expediente->verificarExpediente($_POST["per_idE"],$_POST["nivel_idE"],$_POST["genCop_idE"]);
            if ($datos['cantidad'] > 0) {
                echo "ERROR YA EXISTE UN REGISTRO",$datos['cantidad'];
            }else{
                $resol_fecha = formatoFecha($_POST["resol_fechaE"]);
                $resol_fechaSolicitud = formatoFecha($_POST["resol_fechaSolicitudE"]);
                $fecha_actAca = formatoFecha($_POST["fecha_actAcaE"]);
                $subDen;
                if (isset($_POST["subDen_idE"])) {
                    $subDen = $_POST["subDen_idE"];
                }else{
                    $subDen = null;
                }

                if (isset($_POST["sesTipo_idE"],$_POST["ses_fechaE"])) {

                    $ses_fecha = formatoFecha($_POST["ses_fechaE"]);
                    
                    $expediente->insert_expedienteT($_POST["ses_idE"],$_POST["nivel_idE"],$_POST["genCop_idE"],$_POST["esc_codeE"],$_POST["org_idE"],$_POST["sesTipo_idE"],
                    $ses_fecha,$resol_fecha,$_POST["resol_numeroE"],$resol_fechaSolicitud,$_POST["resol_nroSolicitudE"],
                    $_POST["resol_memorandoE"],$_POST["per_idE"],$_POST["actAca_idE"],$fecha_actAca,$_POST["den_idE"],$subDen);
                    //echo $expediente;
                    echo json_encode($expediente);
                    //echo $expediente;

                }else{
                    $expediente->insert_expedienteT($_POST["ses_idE"],$_POST["nivel_idE"],$_POST["genCop_idE"],$_POST["esc_codeE"],$_POST["org_idE"],null,
                    NULL,$resol_fecha,$_POST["resol_numeroE"],$resol_fechaSolicitud,$_POST["resol_nroSolicitudE"],
                    $_POST["resol_memorandoE"],$_POST["per_idE"],$_POST["actAca_idE"],$fecha_actAca,$_POST["den_idE"],$subDen);
                    //echo $expediente;
                    echo json_encode($expediente);
                    //echo $expediente->errorInfo();
                } 
            }
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

        case "cargarActo":

            $ap = $_GET["appat"];
            $datos = $expediente->cargarActo($ap);
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