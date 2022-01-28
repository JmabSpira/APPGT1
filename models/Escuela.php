<?php
    class Escuela extends Conectar{

        public function get_escuela(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT E.esc_id,E.esc_code,F.fac_sigla,E.esc_nombre,E.esc_sigla,E.esc_alias
            FROM escuela E 
            inner join facultad F on F.fac_id = E.fac_id
            WHERE esc_estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_escuela_x_id($esc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT esc_id,esc_code,esc_nombre,esc_sigla,esc_alias,fac_id FROM escuela WHERE esc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$esc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_escuela($esc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE escuela
                SET
                    esc_estado=0,
                    esc_deletedate=now()
                WHERE
                    esc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$esc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_escuela($esc_code,$esc_nombre,$esc_sigla,$esc_alias,$fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO escuela (esc_code,esc_nombre,esc_sigla,esc_alias,esc_createdate,esc_estado,fac_id) VALUES (?,?,?,?,now(),1,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$esc_code);
            $sql->bindValue(2,$esc_nombre);
            $sql->bindValue(3,$esc_sigla);
            $sql->bindValue(4,$esc_alias);
            $sql->bindValue(5,$fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_escuela($esc_id,$esc_code,$esc_nombre,$esc_sigla,$esc_alias,$fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE escuela
                SET
                    /*esc_id=?,*/
                    esc_code = ?,
                    esc_nombre=?,
                    esc_sigla=?,
                    esc_alias=?,
                    esc_modifieddate=now(),
                    fac_id=?
                WHERE
                    esc_id = ?";
            $sql=$conectar->prepare($sql);
            //$sql->bindValue(1,$esc_id);
            $sql->bindValue(1,$esc_code);
            $sql->bindValue(2,$esc_nombre);
            $sql->bindValue(3,$esc_sigla);
            $sql->bindValue(4,$esc_alias);
            $sql->bindValue(5,$fac_id);
            $sql->bindValue(6,$esc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }


        public function cargarFacultad(){
            $conectar = parent::conexion();
            $sql = "SELECT fac_id,fac_sigla FROM facultad order by fac_id";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }




    }



?>