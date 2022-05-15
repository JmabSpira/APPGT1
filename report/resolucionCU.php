<?php
    include_once('tbs_class.php'); 
    include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 
    require_once("../config/conexion.php");
    require_once("../models/Expediente.php");

    $e1 = "egresado"; //egresado egresada
    $e2 = "el"; // el - la
    $e3 = "del"; // del - de la
    // $e4 = ""; del egresado - de la egresada $e3 + $e1
    $e5 = "interesado"; // Interesado - Interesada 
    //$e6 = ""; // del interesado - de la interesada $e3 + $e5
    $e7 = "al"; // al - a la

    function crearVisto($proveido,$memosg,$memogt,$memof,$facultad,$den,$nombre){
        $cadena = "Proveído Nº $proveido del Rectorado, el Memorando Nº $memosg  de la Secretaría General, el Memorando Nº $memogt  de la Unidad de Certificación, Grados y Títulos y $memof de la Facultad de $facultad sobre otorgamiento del Grado Académico de $den a $nombre";
         return $cadena;
    }

    function crearEscrito($nroSolicitud,$fechaSolicitud,$nombre,$escuela,$facultad,$den,$sexo){
        $e1 = ($sexo =='M') ? 'egresado' : 'egresada';

        $cadena = "con escrito de registro Nº $nroSolicitud, de fecha $fechaSolicitud, $nombre, $e1 de la Escuela Profesional de $escuela de la $facultad, ha solicitado el otorgamiento del Grado Académico de $den";
         return $cadena;
    }

    function crearComision($factAca,$facultad,$den,$sexo){
        $e2 = ($sexo =='M') ? 'el' : 'la';

        $cadena = "el $factAca, la Comisión Dictaminadora de la Facultad de $facultad ha emitido el informe favorable para el otorgamiento del Grado Académico $den solicitado por $e2 recurrente";
         return $cadena;
    }

    function crearConsejo($sesfecha,$facultad,$den,$resolcom,$resolfecha,$sexo){
        $e3 = ($sexo =='M') ? 'del' : 'de la';

        $cadena = "con fecha $sesfecha, el Consejo de la $facultad aprobó otorgar el Grado Académico de $den a favor $e3 recurrente, según la Resolución del Consejo de Facultad N° $resolcom, de fecha $resolfecha";
         return $cadena;
    }

    function crearArticulo($denM,$nombreM,$sexo){
        $e4 = ($sexo =='M') ? 'del egresado' : 'de la egresada';

        $cadena = "GRADO ACADÉMICO DE $denM a favor $e4 $nombreM";
         return $cadena;
    }

    //$resultado = $condicion ? 'verdadero' : 'falso';

    function generarResolucionIndividual($id){

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

    generarResolucionIndividual(13);

?>