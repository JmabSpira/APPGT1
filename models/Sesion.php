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
            WHERE ses_fecha = ? ORDER BY ses_createdate';
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
            $sql="SELECT ses_id, ses_fecha, sesTipo_id, org_id, ses_estado
            FROM sesion WHERE ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_sesion($ses_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE sesion
                SET
                    ses_estado=0,
                    ses_deletedate=now()
                WHERE
                    ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_sesion($sesTipo_id,$org_id,$ses_fecha){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO sesion (sesTipo_id,org_id,ses_fecha,ses_estado,ses_createdate)
            VALUES (?,?,?,1,now())";
            /* VALUES (?,?,'2021-07-28',1,NOW())*/
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sesTipo_id);
            $sql->bindValue(2,$org_id);
            $sql->bindValue(3,$ses_fecha);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_sesion($ses_id,$sesTipo_id,$org_id,$ses_fecha,$ses_estado){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE sesion
                SET
                    sesTipo_id=?,
                    org_id=?,
                    ses_fecha=?,
                    ses_estado=?,
                    ses_modifieddate=now(),
                WHERE
                    ses_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$sesTipo_id);
            $sql->bindValue(2,$org_id);
            $sql->bindValue(3,$ses_fecha);
            $sql->bindValue(4,$ses_estado);
            $sql->bindValue(5,$ses_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }



    }



?>