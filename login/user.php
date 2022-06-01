<?php

include_once '../config/conexion.php';

class User extends Conectar{

    private $usuario;
    private $clave;
            
    public function get_usuario($usuario,$clave){
        $md5pass = md5($clave);
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuarios WHERE usuario = ? and clave = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$usuario);
        $sql->bindValue(2,$md5pass);
        $sql->execute();

        if ($sql->rowCount()) {
            return true;
        }else{
            return false;
        }
        //return $resultado=$sql->fetchAll();
        //return $resultado = $sql->fetch();
    }   

    public function setUser($user){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT * FROM usuarios WHERE usuario = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$user);
        $sql->execute();

        foreach($sql as $currentUser){
            $this->nombre = $currentUser['usuario'];
            $this->clave = $currentUser['clave'];
        }
    }

    public function getUsuario(){
        return $this->usuario;

    }

}


?>