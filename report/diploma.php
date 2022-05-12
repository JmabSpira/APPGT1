<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");
    //$resultado = $condicion ? 'verdadero' : 'falso';

    function generarDiplomaIndividual($id){

            $expediente = new Expediente();
            $TBS = new clsTinyButStrong; 
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); 

                //Parametros
            $proveido = '12334';
            $memosg = 'memo seg';
            $memogt = 'memo gt';

            //declaro las varialbes
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

            $datos = $expediente->get_expediente_x_id($id);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
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

            $visto = crearVisto($proveido,$memosg,$memogt,$memof,$facultad,$den,$nombre);
            $escrito = crearEscrito($nroSolicitud,$fechaSolicitud,$nombre,$escuela,$facultad,$den,$sexo);
            $comision = crearComision($factAca,$facultad,$den,$sexo);
            $consejo = crearConsejo($sesfecha,$facultad,$den,$resolcom,$resolfecha,$sexo);

            $denM = mb_strtoupper($den);
            $nombreM = mb_strtoupper($nombre);

            $articulo = crearArticulo($denM,$nombreM,$sexo);
            $arts = ($sexo =='M') ? 'del interesado' : 'de la interesada';
            $letra = ($sexo =='M') ? 'o' : 'a';


                //Cargando template
            $template = 'BACHILLERCU1.docx';   
            $TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8);

            $TBS->MergeField('pro.visto', $visto);
            $TBS->MergeField('pro.escrito', $escrito);
            $TBS->MergeField('pro.comision', $comision);
            $TBS->MergeField('pro.consejo', $consejo);
            $TBS->MergeField('pro.sesion', '27 de abril de 2022');
            $TBS->MergeField('pro.articulo', $articulo);
            $TBS->MergeField('pro.arts', $arts);
            $TBS->MergeField('pro.facultad', $facultad);
            $TBS->MergeField('pro.escuela', $escuela);
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

    generarDiplomaIndividual(13);

?>