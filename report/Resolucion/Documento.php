<?php
    class Documento extends Conectar{

        public function get_lista_documento($ses){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT ROW_NUMBER() over (ORDER BY E.nivel_id,es.fac_id,E.esc_code,a.actAca_nombre,p.per_nombres asc) as num,E.exp_id,D.doc_id,CONCAT(p.per_nombres,' ',p.per_paterno,' ',p.per_materno) as nombre, E.exp_denominacion, D.doc_nombre, D.doc_createdate FROM documento D
            RIGHT JOIN expediente E on E.exp_id = D.exp_id
            INNER JOIN persona p on p.per_id = E.per_id
            INNER JOIN resolucion r on r.resol_id = E.resol_id
            INNER JOIN sesion s on s.ses_id = r.ses_id
            INNER JOIN escuela es on es.esc_code = E.esc_code
            INNER JOIN acto_academico a on a.actAca_id = E.actAca_id
            where E.ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_expedientes($ses){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT ROW_NUMBER() over (ORDER BY E.nivel_id,es.fac_id,E.esc_code,a.actAca_nombre,p.per_nombres asc) as num,E.exp_id FROM expediente E
            INNER JOIN escuela es on es.esc_code = E.esc_code
            INNER JOIN acto_academico a on a.actAca_id = E.actAca_id
            INNER JOIN persona p on p.per_id = E.per_id
            where E.ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_documento($doc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM documento WHERE doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_documentos_sesion($ses_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM documento WHERE doc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }
        public function update_documento($exp_id,$dil_id,$doc_nombre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE documento
                SET
                    doc_nombre = ?,
                    doc_createdate=now()
                WHERE
                    exp_id = ? and dil_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_nombre);
            $sql->bindValue(2,$exp_id);
            $sql->bindValue(3,$dil_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function verificardocumento($exp_id,$dil_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(doc_id) as cantidad FROM documento WHERE exp_id = ? and dil_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$exp_id);
            $sql->bindValue(2,$dil_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_documento($exp_id,$dil_id,$doc_nombre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO documento(exp_id,dil_id,doc_nombre,doc_createdate) VALUES(?,?,?,now())";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$exp_id);
            $sql->bindValue(2,$dil_id);
            $sql->bindValue(3,$doc_nombre);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_diligencia($dil_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT dil_id,dil_proveido,dil_memosg,dil_memogt,dil_fechaE
            FROM  diligencia
            WHERE dil_id = ? and dil_estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dil_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_expediente_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT E.exp_id,r.resol_memorando,f.fac_nombre,E.exp_denominacion,p.per_sexo,CONCAT(p.per_nombres,' ',p.per_paterno,' ',p.per_materno) as nombre,
            r.resol_nroSolicitud, CONCAT(DAY(r.resol_fechaSolicitud),' de ',MONTHNAME(r.resol_fechaSolicitud),' de ',YEAR(r.resol_fechaSolicitud)) as fechaSolicitud,
            es.esc_alias,CONCAT(DAY(E.fecha_actAca),' de ',MONTHNAME(E.fecha_actAca),' de ',YEAR(E.fecha_actAca)) as factAca,
            CONCAT(DAY(s.ses_fecha),' de ',MONTHNAME(s.ses_fecha),' de ',YEAR(s.ses_fecha)) as sesfecha,s.org_id,
            CONCAT(r.resol_numero,'-',YEAR(r.resol_fecha),'-',f.fac_sigla) as resolcom,
            CONCAT(DAY(r.resol_fecha),' de ',MONTHNAME(r.resol_fecha),' de ',YEAR(r.resol_fecha)) as resolfecha FROM EXPEDIENTE E
            INNER JOIN persona p on p.per_id = E.per_id
            INNER JOIN resolucion r on r.resol_id = E.resol_id
            INNER JOIN sesion s on s.ses_id = r.ses_id
            INNER JOIN escuela es on es.esc_code = E.esc_code
            INNER JOIN facultad f on es.fac_id = f.fac_id
            where E.exp_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

/*
        public function get_datos_resolucion($exp_id,$dil_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT d.doc_id,di.dil_proveido,di.dil_memosg,di.dil_memogt,E.exp_id,r.resol_memorando,f.fac_nombre,E.exp_denominacion,p.per_sexo,CONCAT(p.per_nombres,' ',p.per_paterno,' ',p.per_materno) as nombre,
            r.resol_nroSolicitud, CONCAT(DAY(r.resol_fechaSolicitud),' de ',MONTHNAME(r.resol_fechaSolicitud),' de ',YEAR(r.resol_fechaSolicitud)) as fechaSolicitud,
            es.esc_alias,CONCAT(DAY(E.fecha_actAca),' de ',MONTHNAME(E.fecha_actAca),' de ',YEAR(E.fecha_actAca)) as factAca,
            CONCAT(DAY(s.ses_fecha),' de ',MONTHNAME(s.ses_fecha),' de ',YEAR(s.ses_fecha)) as sesfecha,
            CONCAT(r.resol_numero,'-',YEAR(r.resol_fecha),'-',f.fac_sigla) as resolcom,
            CONCAT(DAY(r.resol_fecha),' de ',MONTHNAME(r.resol_fecha),' de ',YEAR(r.resol_fecha)) as resolfecha,
            a.actAca_nombre from documento d
            inner join diligencia di on di.dil_id = d.dil_id
            inner join expediente E on E.exp_id = d.exp_id
            INNER JOIN persona p on p.per_id = E.per_id
            INNER JOIN resolucion r on r.resol_id = E.resol_id
            INNER JOIN sesion s on s.ses_id = r.ses_id
            INNER JOIN escuela es on es.esc_code = E.esc_code
            INNER JOIN facultad f on es.fac_id = f.fac_id
            INNER JOIN acto_academico a on a.actAca_id = E.actAca_id
            WHERE doc_id = ?
            ORDER BY E.nivel_id,es.fac_id,E.esc_code,a.actAca_nombre,p.per_nombres asc";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$doc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
*/
        public function crearArticulo($denM,$nombreM,$sexo){
            $e4 = ($sexo =='M') ? 'del egresado' : 'de la egresada';

            $cadena = "GRADO ACADÉMICO DE $denM a favor $e4 $nombreM";
            return $cadena;
        }

        public function crearAprobacion($org_id,$sesfecha,$facultad,$den,$resolcom,$resolfecha,$sexo){
            $e3 = ($sexo =='M') ? 'del' : 'de la';

            if ($org_id == 7) {
                $cadena = "con fecha $resolfecha, el Decano de la $facultad aprobó otorgar el Grado Académico de $den a favor $e3 recurrente, según la Resolución Decanal N° $resolcom-D, con cargo a dar cuenta al Consejo de Facultad, en mérito a la Resolución del Consejo Universitario N° 859-2019-UNSCH-CU";
            }else{
                $cadena = "con fecha $sesfecha, el Consejo de la $facultad aprobó otorgar el Grado Académico de $den a favor $e3 recurrente, según la Resolución del Consejo de Facultad N° $resolcom-CF, de fecha $resolfecha";
            }
            return $cadena;
        }

        public function generarArchivo($exp_id,$dil_id,$tipo){
            include_once('../report/tbs_class.php');
            include_once('../public/plugins/tbs/tbs_plugin_opentbs.php'); 

            $TBS = new clsTinyButStrong; 
            $TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

            $outputD = [];
            $datos = get_diligencia($dil_id);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $outputD["dil_id"] = $row["dil_id"];
                    $outputD["dil_proveido"] = $row["dil_proveido"];
                    $outputD["dil_memosg"] = $row["dil_memosg"];
                    $outputD["dil_memogt"] = $row["dil_memogt"];
                }
            }

            $outputE = [];
            $datos = get_expediente_x_id($exp_id);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $outputE["idExp"] = $row["exp_id"];
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
                }
            }

            $denM = mb_strtoupper($outputE["den"]);
            $nombreM = mb_strtoupper($outputE["nombre"]);
            $aprobacion = crearAprobacion($outputE["org_id"],$outputE["sesfecha"],$outputE["facultad"],$outputE["den"],$outputE["resolcom"],$outputE["resolfecha"],$outputE["sexo"]);
            $articulo = crearArticulo($outputE["den"],$outputE["nombre"],$outputE["sexo"]);
            $egre = ($outputE["sexo"] =='M') ? 'egresado' : 'egresada';
            $ela = ($outputE["sexo"] =='M') ? 'el' : 'la';
            $dela = ($outputE["sexo"] =='M') ? 'del' : 'de la';
            $arts = ($outputE["sexo"] =='M') ? 'del interesado' : 'de la interesada';
            $letra = ($outputE["sexo"] =='M') ? 'o' : 'a';

            $template = '../report/Resoluciones/RB.docx';
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
            $TBS->MergeField('pro.sesion', '27 de abril de 2022');
            $TBS->MergeField('pro.articulo', $articulo);
            $TBS->MergeField('pro.arts', $arts);
            $TBS->MergeField('pro.letra', $letra);

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
            
            $outputE_file_name = str_replace('.', $nombre.'_'.date('Y-m-d').$save.'.', $template);
            //$save = ($tipo ==1) ? 'i' : '';
            //se verifica si el nombre esta vacio
            if ($save==='') {
                $TBS->Show(OPENTBS_DOWNLOAD, $outputE_file_name);
                //exit();
            } else {
                $TBS->Show(OPENTBS_FILE, $outputE_file_name);
                //exit("Resolución [$outputE_file_name] ha sido creado.");
            }
            
            /*
            $info = [];
            $info['exp_id'] = $outputE["exp_id"];
            $info['dil_id'] = $outputD["dil_id"];
            $info['doc_name'] = $outputE_file_name;*/
            $verificar = verificardocumento($exp_id,$dil_id);
            if ($verificar['cantidad'] > 0) {
                update_documento($exp_id,$dil_id,$outputE_file_name);
            }else{
                insert_documento($exp_id,$dil_id,$outputE_file_name);
            }
    }
}
?>