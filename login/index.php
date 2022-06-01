<?php

include_once 'user.php';
include_once 'user_session.php';

$userSession = new UserSession();
$user = new User();

if (isset($_SESSION['user'])) {
    echo "Hay Sesion";
    $user->setUser($userSession->getCurrentUser());
    header("location: ../view/MntSesion/");
    
}else if (isset($_POST['usuario']) && isset($_POST['clave'])){
    //echo "Validacion de login";

    $userForm = $_POST['usuario'];
    $passForm = $_POST['clave'];

    if ($user->get_usuario($userForm,$passForm)) {
        //echo("usuario validado");
        $userSession -> setCurrentUser($userForm);
        $user->setUser($userForm);

        header("location: ../view/MntSesion/index.php?log='".$user->getusuario()."'");


    } else {
        //echo("Nombre de usuario y/o pass incorrecto");
        $errorLogin = "Usuario y/o Clave es incorrecto";
        include_once '../login.php';

    }
    

}else{
    echo "Login";
    include_once '../login.php';

}




?>