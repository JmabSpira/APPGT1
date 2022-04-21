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

        public function get_expediente_x_id($subDen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT subDen_id,den_id,subDen_MasFem FROM expediente WHERE subDen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$subDen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function delete_expediente($subDen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE expediente
                SET
                    subDen_estado=0,
                    subDen_deletedate=now()
                WHERE
                    subDen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$subDen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        */
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