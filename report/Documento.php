<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");

    function generarResolucionIndividual($id){

            $expediente = new Expediente();
            $TBS = new clsTinyButStrong; 
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

                //Parametros
            $proveido = '12334';
            $memosg = 'memo seg';
            $memogt = 'memo gt';

            //declaro las varialbes
            $resol_memorando;
            $fac_nombre;
            $exp_denominacion;
            $nombre;
            $resol_nroSolicitud;
            $fechaSolicitud;
            $esc_alias;
            $factAca;
            $sesfecha;
            $resolcom;
            $resolfecha;

            $datos = $expediente->get_expediente_x_id($id);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $resol_memorando = $row["resol_memorando"];
                    $fac_nombre = $row["fac_nombre"];
                    $exp_denominacion = $row["exp_denominacion"];
                    $nombre = $row["nombre"];
                    $resol_nroSolicitud = $row["resol_nroSolicitud"];
                    $fechaSolicitud = $row["fechaSolicitud"];
                    $esc_alias = $row["esc_alias"];
                    $factAca = $row["factAca"];
                    $sesfecha = $row["sesfecha"];
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
                //Cargando template
            $template = 'BACHILLERCU.docx';   
            $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

            $TBS->MergeField('pro.proveido', $proveido);
            $TBS->MergeField('pro.memosg', $memosg);
            $TBS->MergeField('pro.memogt', $memogt);

                //Escribir Nuevos campos
            $TBS->MergeField('pro.memorando', $resol_memorando);
            $TBS->MergeField('pro.facultad', $fac_nombre);
            $TBS->MergeField('denominacion', $exp_denominacion);
            $TBS->MergeField('pro.den', $exp_denominacion);
            $TBS->MergeField('pro.nombre', $nombre);
            $TBS->MergeField('pro.nroSolicitud', $resol_nroSolicitud);
            $TBS->MergeField('pro.fechaSolicitud', $fechaSolicitud);
            $TBS->MergeField('pro.escuela', $esc_alias);
            $TBS->MergeField('pro.actAca', $factAca);
            $TBS->MergeField('pro.sesfecha', $sesfecha);
            $TBS->MergeField('resolcom', $resolcom);
            $TBS->MergeField('pro.resolfecha', $resolfecha);

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

    generarResolucionIndividual(13);

?>