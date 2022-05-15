<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");

    //$resultado = $condicion ? 'verdadero' : 'falso';

    function crearArticulo($denM,$nombreM,$sexo){
        $e4 = ($sexo =='M') ? 'del egresado' : 'de la egresada';

        $cadena = "GRADO ACADÉMICO DE $denM a favor $e4 $nombreM";
         return $cadena;
    }

    function crearAprobacion($org_id,$sesfecha,$facultad,$den,$resolcom,$resolfecha,$sexo){
        $e3 = ($sexo =='M') ? 'del' : 'de la';

        if ($org_id == 7) {
            $cadena = "con fecha $resolfecha, el Decano de la $facultad aprobó otorgar el Grado Académico de $den a favor $e3 recurrente, según la Resolución Decanal N° $resolcom-D, con cargo a dar cuenta al Consejo de Facultad, en mérito a la Resolución del Consejo Universitario N° 859-2019-UNSCH-CU";
        }else{
            $cadena = "con fecha $sesfecha, el Consejo de la $facultad aprobó otorgar el Grado Académico de $den a favor $e3 recurrente, según la Resolución del Consejo de Facultad N° $resolcom-CF, de fecha $resolfecha";
        }
        return $cadena;
    }

    function generarResolucionIndividual($exp_id,$dil_id){

            $expediente = new Expediente();
            $TBS = new clsTinyButStrong; 
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

            //diligencia
            $proveido = '867-2022-R';
            $memosg = '327-2022-UNSCH-SG';
            $memogt = '028-2022-UNSCH-SG-UCGyT';

            //declaro las varialbes
            $idExp = 0;
            $memof = "";
            $facultad = "";
            $den = "";
            $nombre = "";
            $nroSolicitud = "";
            $fechaSolicitud = "";
            $escuela = "";
            $factAca = "";
            $sesfecha = "";
            $resolcom = "";
            $resolfecha = "";
            $sexo = "";
            $org_id = 7;

            $datos = $expediente->get_expediente_x_id($exp_id);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $idExp = $row["exp_id"];
                    $memof = $row["resol_memorando"];
                    $facultad = $row["fac_nombre"];
                    $den = $row["exp_denominacion"];
                    $sexo = $row["per_sexo"];
                    $nombre = $row["nombre"];
                    $nroSolicitud = $row["resol_nroSolicitud"];
                    $fechaSolicitud = $row["fechaSolicitud"];
                    $escuela = $row["esc_alias"];
                    $factAca = $row["factAca"];
                    $sesfecha = $row["sesfecha"];
                    $org_id = $row["org_id"];
                    $resolcom = $row["resolcom"];
                    $resolfecha = $row["resolfecha"];
                    /*
                    $output["den_id"] = $row["den_id"];
                    $output["nivel_id"] = $row["nivel_id"];
                    $output["esc_code"] = $row["esc_code"];
                    $output["den_Mas"] = $row["den_Mas"];
                    $output["den_Fem"] = $row["den_Fem"];
                    $output["den_MasFem"] = $row["den_MasFem"];
                    */
                }
                //echo json_encode($output);
            }

            $denM = mb_strtoupper($den);
            $nombreM = mb_strtoupper($nombre);

            $aprobacion = crearAprobacion($org_id,$sesfecha,$facultad,$den,$resolcom,$resolfecha,$sexo);
            $articulo = crearArticulo($denM,$nombreM,$sexo);
            $egre = ($sexo =='M') ? 'egresado' : 'egresada';
            $ela = ($sexo =='M') ? 'el' : 'la';
            $dela = ($sexo =='M') ? 'del' : 'de la';
            $arts = ($sexo =='M') ? 'del interesado' : 'de la interesada';
            $letra = ($sexo =='M') ? 'o' : 'a';

                //Cargando template
            $template = 'RB.docx';  

            $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

            $TBS->MergeField('pro.proveido', $proveido);
            $TBS->MergeField('pro.memosg', $memosg);
            $TBS->MergeField('pro.memogt', $memogt);
            $TBS->MergeField('pro.memof', $memof);
            $TBS->MergeField('pro.facultad', $facultad);
            $TBS->MergeField('pro.den', $den);
            $TBS->MergeField('pro.nombre', $nombre);
            $TBS->MergeField('pro.nroSolicitud', $nroSolicitud);
            $TBS->MergeField('pro.fechaSolicitud', $fechaSolicitud);
            $TBS->MergeField('pro.egre', $egre);
            $TBS->MergeField('pro.escuela', $escuela);
            $TBS->MergeField('pro.factAca', $factAca);
            $TBS->MergeField('pro.ela', $ela);
            $TBS->MergeField('pro.aprobacion', $aprobacion);
            $TBS->MergeField('pro.sesion', '27 de abril de 2022');
            $TBS->MergeField('pro.articulo', $articulo);
            $TBS->MergeField('pro.arts', $arts);
            $TBS->MergeField('pro.letra', $letra);

            $TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
            
            $save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
            $output_file_name = str_replace('.', $nombre.'_'.date('Y-m-d').$save_as.'.', $template);
            //se verifica si el nombre esta vacio
            if ($save_as==='s') {
                $TBS->Show(OPENTBS_DOWNLOAD, $output_file_name);
                exit();
            } else {
                $TBS->Show(OPENTBS_FILE, $output_file_name);
                exit("Resolución [$output_file_name] ha sido creado.");
            }
    }
    generarResolucionIndividual(13,1);

?>