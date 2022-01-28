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
        public function insert_expediente($ses_id,$genCop_id,$nivel_id,$esc_id,$org_id,$resol_id,$per_id,$actAca_id,$fecha_actAca,$den_id,$subDen_id,$exp_denominacion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO expediente (ses_id,genCop_id,nivel_id,esc_id,org_id,resol_id,per_id,actAca_id,fecha_actAca,den_id,subDen_id,exp_denominacion,exp_estado,exp_createdate)
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,1, now())";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$ses_id);
            $sql->bindValue(2,$genCop_id);
            $sql->bindValue(3,$nivel_id);
            $sql->bindValue(4,$esc_id);
            $sql->bindValue(5,$org_id);
            $sql->bindValue(6,$resol_id);
            $sql->bindValue(7,$per_id);
            $sql->bindValue(8,$actAca_id);
            $sql->bindValue(9,$fecha_actAca);
            $sql->bindValue(10,$den_id);
            $sql->bindValue(11,$subDen_id);
            $sql->bindValue(12,$exp_denominacion);
            $sql->execute();
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

    }



?>