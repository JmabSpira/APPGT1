<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");

    function crearArticulo($denM,$nombreM,$sexo,$nivelDM){

        $cadena = "$nivelDM DE $denM a favor de $nombreM";
         return $cadena;
    }

    function crearAprobacion($org_id,$sesfecha,$facultad,$den,$resolcom,$resolfecha,$sexo,$nivelD){
        $e3 = ($sexo =='M') ? 'del' : 'de la';

        if ($org_id == 7) {
            $cadena = "con fecha $resolfecha, el Decano de la $facultad aprobó otorgar el $nivelD de $den a favor $e3 recurrente, según la Resolución Decanal N° $resolcom-D, con cargo a dar cuenta al Consejo de Facultad, en mérito a la Resolución del Consejo Universitario N° 859-2019-UNSCH-CU";
        }else{
            $cadena = "con fecha $sesfecha, el Consejo de la $facultad aprobó otorgar el $nivelD de $den a favor $e3 recurrente, según la Resolución del Consejo de Facultad N° $resolcom-CF, de fecha $resolfecha";
        }
        return $cadena;
    }
        
    function generarArchivo($exp_id,$dil_id,$tipo){
        $expediente = new Expediente();
        $TBS = new clsTinyButStrong;    
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

        $outputD = [];
        $datos = $expediente->get_diligencia($dil_id);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $outputD["dil_id"] = $row["dil_id"];
                $outputD["ses_id"] = $row["ses_id"];
                $outputD["sesfecha"] = $row["sesfecha"];
                $outputD["dil_proveido"] = $row["dil_proveido"];
                $outputD["dil_memosg"] = $row["dil_memosg"];
                $outputD["dil_memogt"] = $row["dil_memogt"];
            }
        }

        $outputE = [];
        $datos = $expediente->get_expediente_x_id($exp_id);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $outputE["idExp"] = $row["exp_id"];
                $outputE["nivel_id"] = $row["nivel_id"];
                $outputE["memof"] = $row["resol_memorando"];
                $outputE["facultad"] = $row["fac_nombre"];
                $outputE["den"] = $row["exp_denominacion"];
                $outputE["sexo"] = $row["per_sexo"];
                $outputE["nombre"] = $row["nombre"];
                $outputE["nroSolicitud"] = $row["resol_nroSolicitud"];
                $outputE["fechaSolicitud"] = $row["fechaSolicitud"];
                $outputE["escuela"] = $row["esc_alias"];
                $outputE["factAca"] = $row["factAca"];
                $outputE["sesfecha"] = $row["sesfecha"];
                $outputE["org_id"] = $row["org_id"];
                $outputE["resolcom"] = $row["resolcom"];
                $outputE["resolfecha"] = $row["resolfecha"];
                $outputE["modalidad"] = $row["modalidad"];
            }
        }

        
        $denM = mb_strtoupper($outputE["den"]);
        $nombreM = mb_strtoupper($outputE["nombre"]);
        $nivelD = ($outputE["nivel_id"] == 1) ? 'Grado Académico' : 'Título Profesional';
        $nivelDM = mb_strtoupper($nivelD);
        $aprobacion = crearAprobacion($outputE["org_id"],$outputE["sesfecha"],$outputE["facultad"],$outputE["den"],$outputE["resolcom"],$outputE["resolfecha"],$outputE["sexo"],$nivelD);
        $articulo = crearArticulo($denM,$nombreM,$outputE["sexo"],$nivelDM);
        $egre = ($outputE["sexo"] =='M') ? 'egresado' : 'egresada';
        $ela = ($outputE["sexo"] =='M') ? 'el' : 'la';
        $dela = ($outputE["sexo"] =='M') ? 'del' : 'de la';
        $arts = ($outputE["sexo"] =='M') ? 'del interesado' : 'de la interesada';
        $letra = ($outputE["sexo"] =='M') ? 'o' : 'a';
        
        $template = '';
        if ($outputE["nivel_id"] == 1) {
            $template = 'Resolucion/RB.docx';
        } else {
            $template = 'Resolucion/RT.docx';
        }
        
        
        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

        $TBS->MergeField('pro.proveido', $outputD["dil_proveido"]);
        $TBS->MergeField('pro.memosg', $outputD["dil_memosg"]);
        $TBS->MergeField('pro.memogt', $outputD["dil_memogt"]);
        $TBS->MergeField('pro.memof', $outputE["memof"]);
        $TBS->MergeField('pro.facultad', $outputE["facultad"]);
        $TBS->MergeField('pro.den', $outputE["den"]);
        $TBS->MergeField('pro.nombre', $outputE["nombre"]);
        $TBS->MergeField('pro.nroSolicitud', $outputE["nroSolicitud"]);
        $TBS->MergeField('pro.fechaSolicitud', $outputE["fechaSolicitud"]);
        $TBS->MergeField('pro.egre', $egre);
        $TBS->MergeField('pro.escuela', $outputE["escuela"]);
        $TBS->MergeField('pro.factAca', $outputE["factAca"]);
        $TBS->MergeField('pro.ela', $ela);
        $TBS->MergeField('pro.aprobacion', $aprobacion);
        $TBS->MergeField('pro.sesion', $outputD["sesfecha"]);
        $TBS->MergeField('pro.articulo', $articulo);
        $TBS->MergeField('pro.arts', $arts);
        $TBS->MergeField('pro.letra', $letra);
        if ($outputE["nivel_id"] == 2) {
             $TBS->MergeField('pro.modalidad', $outputE["modalidad"]);
        }

        $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
        
        $save = '';
        //$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
        if ($tipo == 1) {
            //0 siginifica descagar automática
            $save = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
        }else{
            //1 significa preguntar donde descargar
            $save = ' ';
        }
        
        $outputE_file_name = str_replace('.', '_'.$outputE["nombre"].'_'.date('d-m-Y').'.', $template);
        //$save = ($tipo ==1) ? 'i' : '';
        //se verifica si el nombre esta vacio
        if ($save==='') {
            $TBS->Show(OPENTBS_DOWNLOAD, $outputE_file_name);
            //exit();
        } else {
            $TBS->Show(OPENTBS_FILE, $outputE_file_name);
            //exit("Resolución [$outputE_file_name] ha sido creado.");
        }
    }

    function generarArchivoMasivo($ses,$dil,$tipo){
        $expediente = new Expediente();
        $cont = 0;
        $datos = $expediente->get_expedientes($ses);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $cont += 1;
                $idExp = $row["exp_id"];
                generarArchivo($idExp,$dil,0);
            }
        }
        return $cont;
    }


    //generarArchivo(103,1,1);

    //generarArchivoMasivo(1,1,0);


    switch ($_GET['tipo']) {
        case 1:
            $exp = $_GET['exp'];
            $dil = $_GET['dil'];
            generarArchivo($exp,$dil,1);
            break;
        case 0:
            $ses = $_GET['ses'];
            $dil = $_GET['dil'];
            $cont = generarArchivoMasivo($ses,$dil,0);
            echo($cont);
            break;
    }
?>