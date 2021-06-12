<?php
$serverName = 'localhost';
$connectionInfo = array("Database"=>"Northwind","UID"=>"gtadmin","PWD"=>"grados*","CharacterSet"=>"UTF-8");
$conn_sis = sqlsrv_connect($serverName,$connectionInfo);

if($conn_sis){
    echo "COnexion exitosa";
}else{
    echo "Conexion fallida";
    die(print_r(sqlsrv_errors(),true));

}
