<?php

    class Expediente extends Conectar{

        /*
        public function get_expediente(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT S.subDen_id,N.nivel_nombre,D.den_MasFem,S.subDen_MasFem
            FROM expediente S
            INNER JOIN denominacion D on S.den_id = D.den_id
            INNER JOIN nivel N on N.nivel_id = D.nivel_id
            WHERE subDen_estado = 1 order by subDen_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
*/

        public function get_lista_expediente($ses_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT E.exp_id,upper(CONCAT(p.per_nombres,' ',p.per_paterno,' ',p.per_materno)) as nombre, E.exp_denominacion, DATE_FORMAT(IF(s.ses_fecha is null,r.resol_fecha,s.ses_fecha),'%d/%m/%Y') as fechaA FROM EXPEDIENTE E
            INNER JOIN persona p on p.per_id = E.per_id
            INNER JOIN resolucion r on r.resol_id = E.resol_id
            INNER JOIN sesion s on s.ses_id = r.ses_id
            INNER JOIN escuela es on es.esc_code = E.esc_code
            INNER JOIN acto_academico a on a.actAca_id = E.actAca_id
            where E.ses_id = ?
            ORDER BY a.actAca_nombre,es.fac_id,E.esc_code,p.per_nombres asc";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_expediente_x_id($id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT E.exp_id,r.resol_memorando,f.fac_nombre,E.exp_denominacion,p.per_sexo,CONCAT(p.per_nombres,' ',p.per_paterno,' ',p.per_materno) as nombre,
            r.resol_nroSolicitud, CONCAT(DAY(r.resol_fechaSolicitud),' de ',MONTHNAME(r.resol_fechaSolicitud),' de ',YEAR(r.resol_fechaSolicitud)) as fechaSolicitud,
            es.esc_alias,CONCAT(DAY(E.fecha_actAca),' de ',MONTHNAME(E.fecha_actAca),' de ',YEAR(E.fecha_actAca)) as factAca,
            CONCAT(DAY(s.ses_fecha),' de ',MONTHNAME(s.ses_fecha),' de ',YEAR(s.ses_fecha)) as sesfecha,
            CONCAT(r.resol_numero,'-',YEAR(r.resol_fecha)) as resolcom,
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


        public function delete_expediente($exp_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM expediente WHERE exp_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$exp_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function verificarExpediente($per_idE,$nivel_idE,$genCop_idE){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT COUNT(exp_id) as cantidad FROM expediente WHERE per_id = ? and nivel_id = ? and genCop_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_idE);
            $sql->bindValue(2,$nivel_idE);
            $sql->bindValue(3,$genCop_idE);
            $sql->execute();
            //return $resultado = $sql->fetch();
            return $resultado = $sql->fetch();
        }

        public function insert_expediente($ses_id,$nivel_id,$genCop_id,$esc_code,$org_id,$sesTipo_id,$ses_fecha,$resol_fecha,$resol_numero,
        $resol_fechaSolicitud,$resol_nroSolicitud,$resol_memorando,$per_id,$actAca_id,$fecha_actAca,$den_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL insertarExpedienteCC(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->bindValue(2,$nivel_id);
            $sql->bindValue(3,$genCop_id);
            $sql->bindValue(4,$esc_code);
            $sql->bindValue(5,$org_id);
            $sql->bindValue(6,$sesTipo_id);
            $sql->bindValue(7,$ses_fecha);
            $sql->bindValue(8,$resol_fecha);
            $sql->bindValue(9,$resol_numero);
            $sql->bindValue(10,$resol_fechaSolicitud);
            $sql->bindValue(11,$resol_nroSolicitud);
            $sql->bindValue(12,$resol_memorando);
            $sql->bindValue(13,$per_id);
            $sql->bindValue(14,$actAca_id);
            $sql->bindValue(15,$fecha_actAca);
            $sql->bindValue(16,$den_id);
            $sql->execute();
            //return $results=@mysql_query($sql) or die ('Error: '.mysql_error());
            return $resultado=$sql->fetchAll();
        }

        public function insert_expedienteT($ses_id,$nivel_id,$genCop_id,$esc_code,$org_id,$sesTipo_id,$ses_fecha,$resol_fecha,$resol_numero,
             $resol_fechaSolicitud,$resol_nroSolicitud,$resol_memorando,$per_id,$actAca_id,$fecha_actAca,$den_id,$subDen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL insertarExpedienteT(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->bindValue(2,$nivel_id);
            $sql->bindValue(3,$genCop_id);
            $sql->bindValue(4,$esc_code);
            $sql->bindValue(5,$org_id);
            $sql->bindValue(6,$sesTipo_id);
            $sql->bindValue(7,$ses_fecha);
            $sql->bindValue(8,$resol_fecha);
            $sql->bindValue(9,$resol_numero);
            $sql->bindValue(10,$resol_fechaSolicitud);
            $sql->bindValue(11,$resol_nroSolicitud);
            $sql->bindValue(12,$resol_memorando);
            $sql->bindValue(13,$per_id);
            $sql->bindValue(14,$actAca_id);
            $sql->bindValue(15,$fecha_actAca);
            $sql->bindValue(16,$den_id);
            $sql->bindValue(17,$subDen_id);
            $sql->execute();

            /*
            echo "\nPDO::errorInfo():\n";
            print_r($sql->errorInfo());*/
            //return $resultado=$sql->errorInfo();
            //return $results=@mysql_query($sql) or die ('Error: '.mysql_error());
            return $resultado=$sql->fetchAll();
        }

/*
        public function update_expediente($subDen_id,$den_id,$subDen_MasFem){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE expediente
                SET
                    den_id = ?,
                    subDen_MasFem=?,
                    subDen_modifieddate=now()
                WHERE
                    subDen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$den_id);
            $sql->bindValue(2,$subDen_MasFem);
            $sql->bindValue(3,$subDen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

*/

        public function cargarEscuela(){
            $conectar = parent::conexion();
            $sql = "SELECT esc_code,esc_alias FROM escuela order by esc_code";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
/*
        public function cargarDenominacion(){
            $conectar = parent::conexion();
            $sql = "SELECT den_id, den_MasFem FROM denominacion WHERE nivel_id > 1 order by nivel_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
*/

        public function cargarGeneracion($genCop_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT genCop_id,genCop_alias FROM generacion_copia WHERE genCop_estado = 1  and genCop_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$genCop_id);
            $sql->execute();
            return $resultado = $sql->fetch();
            //return $resultado=$sql->fetchAll();
        }

        public function cargarOrgano($org){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT org_id, org_emite FROM organo WHERE org_estado = 1 and org_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$org);
            $sql->execute();
            return $resultado = $sql->fetch();
            //return $resultado=$sql->fetchAll();
        }

        public function cargarActo($act){
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT actAca_id, actAca_nombre FROM acto_academico WHERE actAca_estado = 1 and actAca_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$act);
            $sql->execute();
            return $resultado = $sql->fetch();
            //return $resultado=$sql->fetchAll();
        }

        public function cargarTipoSesion($ses){
            $conectar = parent::conexion();
            parent::set_names();
            
            $sql = "SELECT sesTipo_id, sesTipo_nombre FROM sesion_tipo WHERE sesTipo_estado = 1 and sesTipo_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses);
            $sql->execute();
            return $resultado = $sql->fetch();
            //return $resultado=$sql->fetchAll();
        }

        public function get_persona_x_doc($per_nroDoc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT per_id,per_nroDoc,per_paterno,per_materno,per_nombres,per_sexo,docTipo_id FROM persona WHERE per_nroDoc = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_nroDoc);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


    }

?>