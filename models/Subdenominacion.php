<?php
    class Subdenominacion extends Conectar{

        public function get_subdenominacion(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT S.subDen_id,N.nivel_nombre,D.den_MasFem,S.subDen_MasFem
            FROM subdenominacion S
            INNER JOIN denominacion D on S.den_id = D.den_id
            INNER JOIN nivel N on N.nivel_id = D.nivel_id
            WHERE subDen_estado = 1 order by subDen_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_subdenominacion_x_id($subDen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT subDen_id,den_id,subDen_MasFem FROM subdenominacion WHERE subDen_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$subDen_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_subdenominacion($subDen_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE subdenominacion
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

        public function insert_subdenominacion($den_id,$subDen_MasFem){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO subdenominacion (den_id,subDen_MasFem,den_estado,den_createdate) VALUES (?,?,1, now())";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$den_id);
            $sql->bindValue(2,$subDen_MasFem);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_subdenominacion($subDen_id,$den_id,$subDen_MasFem){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE subdenominacion
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


        public function cargarDenominacionPorNivel($nivel){
            $conectar = parent::conexion();
            $sql = "SELECT den_id, den_MasFem FROM denominacion WHERE nivel_id = ? order by nivel_id";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nivel);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function cargarDenominacionPorEscuela($nivel,$esc_code){
            $conectar = parent::conexion();
            $sql = "SELECT den_id, den_MasFem FROM denominacion WHERE nivel_id = ? and esc_code = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nivel);
            $sql->bindValue(2,$esc_code);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function cargarDenominacion(){
            $conectar = parent::conexion();
            $sql = "SELECT den_id, den_MasFem FROM denominacion WHERE nivel_id > 1 order by nivel_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }

?>