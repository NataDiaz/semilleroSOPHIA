<?php

include('conexion.php');

$db_selected = mysql_select_db('rutas', $connection);
if (!$db_selected) {
  die ('No se puede usar la base de datos : ' . mysql_error());
}
//Calculo del IB=a*PSe+b*PSa+c*PA
$queryIB = "SELECT * FROM indicebienestar WHERE 1";
$resultIB = mysql_query($queryIB);
if (!$resultIB) {
  die('Consulta Invalida: ' . mysql_error());
}
while ($fila = @mysql_fetch_assoc($resultIB)){
 $Pse=$fila['Pse']; //seguridad
 $Psa=$fila['Psa']; //salud
 $PA=$fila['PA']; //Agrado
 $a=0.5;
 $b=0.3;
 $c=0.2;
 $IB=($a*$Pse)+($b*$Psa)+($c*$PA);
 
}
echo 'IB:'.$IB;

?>