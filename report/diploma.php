<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");
        
    function generarArchivo($exp_id,$dil_id,$tipo){
        $expediente = new Expediente();
        $TBS = new clsTinyButStrong;    
        $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

        $outputD = [];
        $datos = $expediente->get_diligencia($dil_id);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $outputD["dil_id"] = $row["dil_id"];
                $outputD["diaE"] = $row["diaE"];
                $outputD["mesE"] = $row["mesE"];
                $outputD["anioE"] = $row["anioE"];
                $outputD["sesion"] = $row["sesion"];
            }
        }

        $outputE = [];
        $datos = $expediente->get_expediente_diploma($exp_id);
        if(is_array($datos)==true and count($datos)>0){
            foreach($datos as $row){
                $outputE["idExp"] = $row["exp_id"];
                $outputE["nivel_id"] = $row["nivel_id"];
                $outputE["nombre"] = $row["nombre"];
                $outputE["den"] = $row["den"];
                $outputE["dia"] = $row["dia"];
                $outputE["mes"] = $row["mes"];
                $outputE["anio"] = $row["anio"];
                $outputE["facultad"] = $row["fac_alias"];
                $outputE["decano"] = $row["fac_autoridad"];
                $outputE["escuela"] = $row["esc_alias"];
                $outputE["dni"] = $row["per_nroDoc"];
            }
        }

        $den = $outputE["den"];
        $cant = str_word_count($den);
        $denA = " ";
        $denB = "";

        if ($outputE["nivel_id"] == 2 and $cant > 7) {
            $palabras = explode(" ",$den);

            $cont = 0;
            while ($cont < $cant) {
                if ($cont < floor($cant/2)) {
                    $denA = $denA . " " . $palabras[$cont];
                }else{
                    $denB = $denB . " " . $palabras[$cont];
                }
                $cont++;
            }
        }else{
            $denB = $den;
        }

        $template = '';
        if ($outputE["nivel_id"] == 1) {
            $template = 'Diploma/DB.docx';
        } else {
            $template = 'Diploma/DT.docx';
        }
        
        $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

        if ($outputE["nivel_id"] == 1) {
            $TBS->MergeField('pro.den', $den);
        } else {
            $TBS->MergeField('pro.denA', $denA);
            $TBS->MergeField('pro.denB', $denB);
        }
        $TBS->MergeField('pro.nombre', $outputE["nombre"]);
        $TBS->MergeField('pro.dia', $outputE["dia"]);  
        $TBS->MergeField('pro.mes', $outputE["mes"]);
        $TBS->MergeField('pro.anio', $outputE["anio"]);      
        $TBS->MergeField('pro.facultad', $outputE["facultad"]);
        $TBS->MergeField('pro.escuela', $outputE["escuela"]);
        $TBS->MergeField('pro.diaE', $outputD["diaE"]);
        $TBS->MergeField('pro.mesE', $outputD["mesE"]);
        $TBS->MergeField('pro.anioE', $outputD["anioE"]);
        $TBS->MergeField('pro.decano', $outputE["decano"]);
        $TBS->MergeField('pro.dni', $outputE["dni"]);
        $TBS->MergeField('pro.sesion', $outputD["sesion"]);  

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
        
        $outputD_file_name = str_replace('.', '_'.$outputE["nombre"].'_'.date('d-m-Y').'.', $template);
        //$save = ($tipo ==1) ? 'i' : '';
        //se verifica si el nombre esta vacio
        if ($save==='') {
            $TBS->Show(OPENTBS_DOWNLOAD, $outputD_file_name);
            //exit();
        } else {
            $TBS->Show(OPENTBS_FILE, $outputD_file_name);
            //exit("Resolución [$outputD_file_name] ha sido creado.");
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