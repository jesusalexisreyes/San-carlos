
<?php


$server = "localhost";
$bd = "proyectoalonso";
$user = "usr";
$pass = "1234";

// Hacemos la conexión con la funcion de conexión de PHP
$connLocalhost = mysqli_connect($server, $user, $pass) or trigger_error(mysqli_error(),E_USER_ERROR);

// Definimos el juegos de caracteres de la conexion
mysqli_query($connLocalhost, "SET NAMES 'utf8'");

// Seleccionamos la base de datos por defecto
mysqli_select_db($connLocalhost, $bd);

//
// $host="127.0.0.1";
// $port=3306;
// $socket="";
// $user="root";
// $password="";
// $dbname="respuestasdb";
//
// $con = new mysqli($host, $user, $password, $dbname, $port, $socket)
// 	or die ('Could not connect to the database server' . mysqli_connect_error());
     ?>
