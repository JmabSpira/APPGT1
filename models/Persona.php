<?php
    class Persona extends Conectar{

        
        public function get_persona(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT P.per_id,D.docTipo_sigla,P.per_nroDoc,P.per_paterno,P.per_materno,P.per_nombres,P.per_sexo 
            FROM persona P 
            inner join documento_tipo D on D.docTipo_id = P.docTipo_id
            WHERE per_estado=1 ORDER BY per_createdate DESC LIMIT 300";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
/*
        public function get_persona_x_Apellido($per_paterno){
            $conectar= parent::conexion();
            parent::set_names();
            $sql='SELECT P.per_id,D.docTipo_sigla,P.per_nroDoc,P.per_paterno,P.per_materno,P.per_nombres,P.per_sexo 
            FROM persona P 
            inner join documento_tipo D on D.docTipo_id = P.docTipo_id
            WHERE per_estado=1 and per_paterno = ? ORDER BY per_createdate';
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_paterno);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
*/
        public function get_persona_x_filtro($dato){
            $conectar= parent::conexion();
            parent::set_names();
            $sql='SELECT P.per_id,D.docTipo_sigla,P.per_nroDoc,P.per_paterno,P.per_materno,P.per_nombres,P.per_sexo 
            FROM persona P 
            inner join documento_tipo D on D.docTipo_id = P.docTipo_id
            WHERE per_estado=1 and (per_paterno = ? or per_nroDoc = ?) ORDER BY per_createdate';
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$dato);
            $sql->bindValue(2,$dato);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_persona_x_id($per_id){
            $conectar= parent::conexion();
            parent::set_names();
           /*$sql="SELECT P.per_id,D.docTipo_sigla,P.per_nroDoc,P.per_paterno,P.per_materno,P.per_nombres,P.per_sexo 
            FROM persona P 
            inner join documento_tipo D on D.docTipo_id = P.docTipo_id WHERE per_id = ?";*/
            $sql="SELECT per_id,per_nroDoc,per_paterno,per_materno,per_nombres,per_sexo,docTipo_id FROM persona WHERE per_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_persona($per_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE persona
                SET
                    per_estado=0,
                    per_deletedate=now()
                WHERE
                    per_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_persona($per_nroDoc,$per_paterno,$per_materno,$per_nombres,$per_sexo,$docTipo_id){
            $conectar= parent::conexion();
            parent::set_names();
            //$sql="INSERT INTO persona (per_nroDoc,per_paterno,per_materno,per_nombres,per_sexo,per_createdate,per_estado,docTipo_id) VALUES (?,?,?,?,?,now(),1,?)";
            $sql="CALL insertarPersona(?,?,?,?,?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_nroDoc);
            $sql->bindValue(2,$per_paterno);
            $sql->bindValue(3,$per_materno);
            $sql->bindValue(4,$per_nombres);
            $sql->bindValue(5,$per_sexo);
            $sql->bindValue(6,$docTipo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        //public function update_persona($per_id,$per_nroDoc,$per_paterno,$per_materno,$per_nombres,$per_sexo,$docTipo_id){
        public function update_persona($per_id,$per_paterno,$per_materno,$per_nombres,$per_sexo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE persona
                SET
                    per_paterno=?,
                    per_materno=?,
                    per_nombres=?,
                    per_sexo=?,
                    per_modifieddate=now()
                WHERE
                    per_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_paterno);
            $sql->bindValue(2,$per_materno);
            $sql->bindValue(3,$per_nombres);
            $sql->bindValue(4,$per_sexo);
            $sql->bindValue(5,$per_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
            //print_r($sql->errorInfo());
        }

        public function validarPersona($per_nroDoc){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(per_id) as cantidad FROM persona WHERE per_nroDoc = ? and per_estado = 1;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$per_nroDoc);
            $sql->execute();
            //return $resultado=$sql->fetchAll();
            return $resultado = $sql->fetch();
        }


    }

?>