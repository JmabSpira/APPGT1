<?php
    class Diligencia extends Conectar{

        
        public function get_diligencia(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT dil_id,CONCAT(DAY(s.ses_fecha),' de ',MONTHNAME(s.ses_fecha),' de ',YEAR(s.ses_fecha)) as sesfecha,dil_proveido,dil_memosg,dil_memogt,dil_fechaE
            FROM  diligencia d
            INNER JOIN sesion s on s.ses_id = d.ses_id
            ORDER BY dil_createdate DESC";
            /*WHERE ses_estado = 1 
            ORDER BY ses_createdate DESC LIMIT 300";*/
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_diligencia_x_id($dil_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT dil_id, dil_proveido, dil_memosg, dil_memogt,dil_fechaE
            FROM diligencia WHERE dil_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dil_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_diligencia($dil_id){
            $conectar= parent::conexion();
            parent::set_names();
            /*$sql = "DELETE FROM diligencia
                    where ses_id = ?";*/
            $sql="DELETE FROM diligencia WHERE dil_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dil_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_diligencia($dil_proveido,$dil_memosg,$dil_memogt,$dil_fechaE){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="CALL insertarDiligencia(?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dil_proveido);
            $sql->bindValue(2,$dil_memosg);
            $sql->bindValue(3,$dil_memogt);
            $sql->bindValue(4,$dil_fechaE);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_diligencia($dil_id,$dil_proveido,$dil_memosg,$dil_memogt,$dil_fechaE){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE diligencia
                SET
                    dil_proveido=?,
                    dil_memosg=?,
                    dil_memogt=?,
                    dil_fechaE=?,
                    dil_modifieddate=now()
                WHERE
                    dil_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dil_proveido);
            $sql->bindValue(2,$dil_memosg);
            $sql->bindValue(3,$dil_memogt);
            $sql->bindValue(4,$dil_fechaE);
            $sql->bindValue(5,$dil_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

/*
        public function get_diligencia_actual(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT S.ses_id, O.org_acronimo, MAX(S.ses_fecha) as ses_fecha
            FROM diligencia S
            INNER JOIN organo O ON O.org_id = S.org_id
            WHERE ses_estado = 1 AND (S.org_id = 1 or S.org_id = 2)";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            //return $resultado=$sql->fetchAll();
            return $resultado = $sql->fetch();
        }
*/

        public function get_diligencia_actual(){
            $conectar= parent::conexion();
            parent::set_names();
            /*$sql="SELECT d.dil_id,d.ses_id,CONCAT(DAY(s.ses_fecha),' de ',MONTHNAME(s.ses_fecha),' de ',YEAR(s.ses_fecha)) as sesfecha,d.dil_proveido,d.dil_memosg,d.dil_memogt,d.dil_fechaE, date_format(s.ses_fecha,'%d-%m-%Y') as sesion
            FROM  diligencia d
            INNER JOIN sesion s on s.ses_id = d.ses_id
            WHERE dil_estado = 1";*/
            $sql = "SELECT dil_id,d.ses_id,CONCAT(DAY(s.ses_fecha),' de ',MONTHNAME(s.ses_fecha),' de ',YEAR(s.ses_fecha)) as sesfecha,dil_proveido,dil_memosg,
            dil_memogt,CONCAT(DAY(dil_fechaE),' de ',MONTHNAME(dil_fechaE),' de ',YEAR(dil_fechaE)) as dil_fechaE,LPAD(DAY(dil_fechaE),2,'0') as diaE,
            lower(MONTHNAME(dil_fechaE)) as mesE, YEAR(dil_fechaE) as anioE,
            date_format(s.ses_fecha,'%d-%m-%Y') as sesion
            FROM  diligencia d
            INNER JOIN sesion s on s.ses_id = d.ses_id
            WHERE dil_estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            //return $resultado=$sql->fetchAll();
            return $resultado = $sql->fetch();
        }
    }


?>