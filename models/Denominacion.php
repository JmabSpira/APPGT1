<?php
    class Denominacion extends Conectar{

        
        public function get_denominacion(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT D.den_id,N.nivel_nombre,E.esc_sigla,D.den_Mas,D.den_Fem,D.den_MasFem
            FROM denominacion D
            INNER JOIN nivel N on N.nivel_id = D.nivel_id
            INNER JOIN escuela E on E.esc_code = D.esc_code
            WHERE den_estado = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_denominacion_x_id($den_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT den_id,nivel_id,esc_code,den_Mas,den_Fem,den_MasFem FROM denominacion WHERE den_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$den_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_denominacion($den_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE denominacion
                SET
                    den_estado=0,
                    den_deletedate=now()
                WHERE
                    den_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$den_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_denominacion($nivel_id,$esc_code,$den_Mas,$den_Fem,$den_MasFem){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO denominacion (nivel_id,esc_code,den_Mas,den_Fem,den_MasFem,den_estado,den_createdate) VALUES (?,?,?,?,?,1, now())";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nivel_id);
            $sql->bindValue(2,$esc_code);
            $sql->bindValue(3,$den_Mas);
            $sql->bindValue(4,$den_Fem);
            $sql->bindValue(5,$den_MasFem);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_denominacion($den_id,$nivel_id,$esc_code,$den_Mas,$den_Fem,$den_MasFem){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE denominacion
                SET
                    nivel_id = ?,
                    esc_code=?,
                    den_Mas=?,
                    den_Fem=?,
                    den_MasFem=?,
                    den_modifieddate=now()
                WHERE
                    den_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$nivel_id);
            $sql->bindValue(2,$esc_code);
            $sql->bindValue(3,$den_Mas);
            $sql->bindValue(4,$den_Fem);
            $sql->bindValue(5,$den_MasFem);
            $sql->bindValue(6,$den_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function cargarEscuela(){
            $conectar = parent::conexion();
            $sql = "SELECT esc_code,esc_alias FROM escuela order by esc_code";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }



?>