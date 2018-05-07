<?php
 
$nombre=$_POST["nombre"];
$lati=$_POST["xo"];
$long=$_POST["yo"];
$dir=$_POST["dirD"].",Bogota, Colombia";
$dist=$_POST["distancia"];

//echo "dirO:".$dirO;
include('conexion.php');
 
$guardar = "INSERT INTO markers (name,address,lat,lng,idTipo) VALUES ('$nombre','$dir','$lati','$long',1)";  
//$guardar = "INSERT INTO rutausuario (idIB, origenLat, origenLng, destinoLat, destinoLng, idTipo, nombre, dirOrigen, dirDestino, distancia) VALUES (1,'$latiO','$longO','$latiD','$longD',1,'$nombre','$dirO','$dirD','$dist')";  
mysql_query($guardar); 

 
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

$guardarIB="INSERT INTO indicebienestar (PSe, Psa, PA, total) VALUES (TRUNCATE('$Pse',1),TRUNCATE('$Psa',1),TRUNCATE('$PA',1),TRUNCATE('$IB',1))";

if($guardar)	
echo "<br><h4><i><p>Los datos se guardaron satisfactoriamente!.</i></h4></br>"; 
else 
echo "<br><h4><i>Se ha producido un error al guardar los datos</i></h4>".$my_error;
 
header('Location: index.html');
 
?>	