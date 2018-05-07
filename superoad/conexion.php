<?php 
$host="localhost";
$usuario= "root";
$clave= "";
$db="rutas";
 
$conn = mysqli_connect('localhost','root','','rutas');
if (!$conn) {
    die('Connect Error: ' . mysqli_connect_errno());
}
?>