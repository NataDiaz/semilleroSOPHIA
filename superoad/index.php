<!DOCTYPE html>
<html>
<head>
<title>Superoad</title>
<meta charset="utf-8">
<meta name="viewport" content="width=620" /> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="author" content="Natalia Diaz" >
<link rel="stylesheet" href="css/estilo.css">	
<link rel="stylesheet" href="css/menu.css">	

<script>
      var map;
	  var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 4.6979695, lng: -74.0881957},
          zoom: 13
        });
      }
	   
    </script>
 <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB8hd26B_XRik5OJTLD5vTrjL0Pd-gQ5LQ&callback=initMap" async defer></script>    
    <script src="http://code.jquery.com/jquery-1.0.4.js"></script>
	<script type="text/javascript" src="js/correr.js"></script>
</head>

<body bgcolor="white">
 <div id="container">
<!-- Cabecera -->
 <header>
	<table align="center">
  <tr>
  <td rowspan="5"><img src="logo.jpg" width="280px"; height="150px" alt="logo"  style="margin-left:-295px;" /></td>
  <td>La <font color=red><B>---</B></font> Indica el Trafico.</td>
  </tr>
    <form name="form1">
		<td>Direccion Origen:</td><td><input type="text" id="dir" name="dir" size="30" maxlength="50" style="border-radius: 12px;"></td>
		<td><input type="button" onclick="getGeo()" value="Ubícame" class="btn1" /></td>
		<th></th>
		<!-- <td><input type="button" onclick="agregarOrigen()" value="Ubicar en el Mapa" hidden /> -->
	</form>
	</td>
	<tr>
	
    <td>Direccion Destino:</td><td><input type="text" name="ciudad" id="ciudad" size="30" maxlength="50" style="border-radius: 12px;"/></td>
	<!-- Lat y Long Origen xo, yo-->
	<td><button onclick="agregarCiudad()" class="btn1">Ubicar</button></td>
	</tr>
	<tr>
	<td><font color="blue">Distancia:</font></td><td><span id="total"></span></td>
	</tr>
	<tr>
	<td><font color="blue">Tiempo Recorrido:</font></td><td><span id="total"></span></td>
	<td><input type="text" name="distancia" id="distancia" size="50" maxlength="50" hidden />
	<input onclick="ruta();" type="button" value="Ruta" class="btn"></td> 
	<td><input onclick="trafico();" type="button" value="Tráfico" class="btn"></td> 
	<tr>
		
	<!-- <td colspan="2"><input onclick="misRutas();" type="button" value="mis Rutas" class="btn1"  /></td> -->
	
	</tr>
	<tr>
	
	
	
	<td><input type="text" name="xo" id="xo"  size="10" value="0"  hidden /></td>
	<td><input type="text" name="yo" id="yo"  size="10" value="0"  hidden /></td>
	</tr>
	<tr> 
    <td><input type="text" name="dirO" id="dirO" size="30"  hidden /></td>
	<td><input type="text" name="dirD" id="dirD" size="30"  hidden /></td>
	</tr>
	<tr>
	<td><input type="text" name="x" id="x" size="10" maxlength="30" value="0" hidden /></td>
    <td><input type="text" name="y" id="y" size="10" maxlength="30" value="0" hidden /></td>
    </tr> 
    </table>
      
	<!-- Lat y Long destino -->
   
	
        </header>
<table align="center">
<tr>
<td>
        <!-- Contenido -->
        <section>            
            <div id="map"></div>
		</section>
</td>
		
		
        <!-- Contenido relacionado-->
<td>        
        <ul class="ca-menu">
	<li>
		<a href="guardar.php">
			<span class="ca-icon">F</span>
			<div class="ca-content">
				<h2 class="ca-main">Guardar Ruta</h2>
			</div>
		</a>
	</li>
	<li>
		<a href="index.php">
			<span class="ca-icon">K</span>
			<div class="ca-content">
				<h2 class="ca-main">Mis Rutas</h2>
			</div>
		</a>
	</li>
	<li>
		<a href="gasolineras.php">
			<span class="ca-icon">L</span>
			<div class="ca-content">
				<h2 class="ca-main">Gasolineras</h2>
			</div>
		</a>
	</li>
	<li>
		<a href="index.php">
			<span class="ca-icon">J</span>
			<div class="ca-content">
				<h2 class="ca-main">Reiniciar</h2>
			</div>
		</a>
	</li>
	<li>
		<a href="#">
			<span class="ca-icon">D</span>
			<div class="ca-content">
				<h2 class="ca-main">Salir</h2>
			</div>
		</a>
	</li>
</ul>
</aside>
</td>
</table>
<div id="info"></div>
        
    <footer>
    Desarrollado por <font color=#2E64FE>Natalia Diaz Mesa</font>.  Supervisado por <font color=#2E64FE>Semillero SOPHIA</font>, Uniminuto 2018</a>.
    </footer>	
</div>
</body>
</html>