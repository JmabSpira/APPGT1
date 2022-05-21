<?php
    class Facultad extends Conectar{

        
        public function get_facultad(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT fac_id,fac_nombre,fac_alias,fac_sigla,fac_autoridad 
            FROM facultad
            WHERE fac_estado=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_facultad_x_id($fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT fac_id,fac_nombre,fac_alias,fac_sigla,fac_autoridad FROM facultad WHERE fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_facultad($fac_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE facultad
                SET
                    fac_estado=0,
                    fac_deletedate=now()
                WHERE
                    fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_facultad($fac_nombre,$fac_alias,$fac_sigla,$fac_autoridad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO facultad (fac_nombre,fac_alias,fac_sigla,fac_autoridad,fac_createdate,fac_estado) VALUES (?,?,?,?,now(),1)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fac_nombre);
            $sql->bindValue(2,$fac_alias);
            $sql->bindValue(3,$fac_sigla);
            $sql->bindValue(4,$fac_autoridad);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_facultad($fac_id,$fac_nombre,$fac_alias,$fac_sigla,$fac_autoridad){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE facultad
                SET
                
                    fac_nombre=?,
                    fac_alias=?,
                    fac_sigla=?,
                    fac_autoridad=?,
                    fac_modifieddate=now()
                WHERE
                    fac_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fac_nombre);
            $sql->bindValue(2,$fac_alias);
            $sql->bindValue(3,$fac_sigla);
            $sql->bindValue(4,$fac_autoridad);
            $sql->bindValue(5,$fac_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }

?>