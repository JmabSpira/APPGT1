<?php
    

    class Conectar{
        protected $dbh;

        protected function Conexion(){
            $host="localhost";
            $port=3307;
            $socket="";
            $user="gtadmin";
            $password="grados*";
            $dbname="dbgradostitulos";
            try{
                $conectar = $this->dbh = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
                //$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=crud2","root","");
                return $conectar;
            }catch(Exception $e){
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function set_names(){
			return $this->dbh->query("SET NAMES 'utf8'; SET lc_time_names = 'es_ES'");
        }

    }
/*
$host="localhost";
$port=3307;
$socket="";
$user="root";
$password="root";
$dbname="dbhotel";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());
//$con->close();

$host="localhost";
$port=3307;
$socket="";
$user="adminHotel";
$password="admin";
$dbname="dbhotel";

try {
    $dbh = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
    if ($dbh) {
        print "Conexion existosa";
        # code...
    }else{
        print "fAllo en la conexion";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
*/
?>