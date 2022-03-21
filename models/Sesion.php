<?php
    class Sesion extends Conectar{

        
        public function get_sesion(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT S.ses_id, S.ses_fecha, ST.sesTipo_nombre, O.org_nombre, 
                CASE S.ses_estado
                    WHEN 1 THEN 'ACTIVO'
                    WHEN 0 THEN 'DESACTIVADO'
                END AS 'ses_estado'
            FROM sesion S
            INNER JOIN sesion_tipo ST ON ST.sesTipo_id = S.sesTipo_id
            INNER JOIN organo O ON O.org_id = S.org_id
            WHERE ses_estado = 0 or ses_estado = 1
            ORDER BY ses_createdate DESC LIMIT 300";
            /*WHERE ses_estado = 1 
            ORDER BY ses_createdate DESC LIMIT 300";*/
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function get_sesion_x_fecha($ses_fecha){
            $conectar= parent::conexion();
            parent::set_names();
            $sql='SELECT S.ses_id, S.ses_fecha, ST.sesTipo_nombre, O.org_nombre, 
                CASE S.ses_estado
                    WHEN 1 THEN "ACTIVO"
                    WHEN 0 THEN "DESACTIVADO"
                END AS "ses_estado"
            FROM sesion S
            INNER JOIN sesion_tipo ST ON ST.sesTipo_id = S.sesTipo_id
            INNER JOIN organo O ON O.org_id = S.org_id 
            WHERE ses_fecha = ? and (ses_estado = 0 or ses_estado = 1) ORDER BY ses_createdate';
            /*WHERE ses_estado = 1 
            AND ses_fecha = ? ORDER BY ses_createdate';*/
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_fecha);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_sesion_x_id($ses_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT ses_id, org_id, sesTipo_id, ses_fecha, ses_estado
            FROM sesion WHERE ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_sesion($ses_id){
            $conectar= parent::conexion();
            parent::set_names();
            /*$sql = "DELETE FROM sesion
                    where ses_id = ?";*/
            $sql="UPDATE sesion
                SET
                    ses_estado=2,
                    ses_deletedate=now()
                WHERE
                    ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_sesion($org_id,$sesTipo_id,$ses_fecha){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO sesion (org_id,sesTipo_id,ses_fecha,ses_estado,ses_createdate)
            VALUES (?,?,?,1,now())";
            /* VALUES (?,?,'2021-07-28',1,NOW())*/
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$org_id);
            $sql->bindValue(2,$sesTipo_id);
            $sql->bindValue(3,$ses_fecha);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_sesion($ses_id,$org_id,$sesTipo_id,$ses_fecha,$ses_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE sesion
                SET
                    org_id=?,
                    sesTipo_id=?,
                    ses_fecha=?,
                    ses_estado=?,
                    ses_modifieddate=now()
                WHERE
                    ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$org_id);
            $sql->bindValue(2,$sesTipo_id);
            $sql->bindValue(3,$ses_fecha);
            $sql->bindValue(4,$ses_estado);
            $sql->bindValue(5,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /*
        public function get_sesion_actual(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT S.ses_id, O.org_acronimo, MAX(S.ses_fecha) as ses_fecha
            FROM sesion S
            INNER JOIN organo O ON O.org_id = S.org_id
            WHERE ses_estado = 1 AND (S.org_id = 1 or S.org_id = 2)";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            //return $resultado=$sql->fetchAll();
            return $resultado = $sql->fetch();
        }
*/
        public function get_sesion_actual(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT S.ses_id, O.org_acronimo, ST.sesTipo_sigla, S.ses_fecha
            FROM sesion S
            INNER JOIN organo O ON O.org_id = S.org_id
            INNER JOIN sesion_tipo ST on ST.sesTipo_id = S.sesTipo_id
            WHERE ses_fecha = (SELECT max(ses_fecha) FROM sesion WHERE ses_estado = 1 AND (S.org_id = 1 or S.org_id = 2))";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            //return $resultado=$sql->fetchAll();
            return $resultado = $sql->fetch();
        }
    }


?>