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

 <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB8hd26B_XRik5OJTLD5vTrjL0Pd-gQ5LQ&callback=initMap" async defer></script>    
    <script src="http://code.jquery.com/jquery-1.0.4.js"></script>
	<script type="text/javascript" src="js/correr.js"></script>
	<script>
	 var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: new google.maps.LatLng(4.6979695, -74.0881957),
          mapTypeId: 'roadmap'
        });

           cercanos();
      }
	  
	  function crearMarcador(place)
	{
   
		var infoWindow = new google.maps.InfoWindow({map: map});
		var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location,
			icon: 'img/estacion.png'
		});		   
           infoWindow.setPosition(place.geometry.location);
		   var precio=Math.floor((Math.random() * 2500) + 10000);
           infoWindow.setContent('$:'+precio);
            map.setCenter(place.geometry.location);

		// Asignamos el evento click del marcador
			google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(place.name);
			infowindow.open(map, this);
		});
   
	}		
	
	function cercanos(pos)
	{			var myLatlng=new google.maps.LatLng(4.6979695, -74.0881957);
			//var myLatlng=pos;
			//var tipo='cafe';
			// Creamos el infowindow
			var infowindow = new google.maps.InfoWindow();

			// Especificamos la localización, el radio y el tipo de lugares que queremos obtener
			var request = {
			location: myLatlng,
			radius: 400,
			types: ['gas']	
			};

			// Creamos el servicio PlaceService y enviamos la petición.
			var service = new google.maps.places.PlacesService(map);

			service.nearbySearch(request, function(results, status) {
			if (status === google.maps.places.PlacesServiceStatus.OK) 
			{
				// for (var i = 0; i < results.length; i++) {
				for (var i = 0; i < 3; i++) 
				{
					crearMarcador(results[i]);
				}
			}
		});
	}
	</script>
</head>

<body bgcolor="white">
 <div id="container">
<!-- Cabecera -->
 <header>
	<table align="center">
  <tr>
  <td rowspan="5"><img src="logo.jpg" width="280px"; height="150px" alt="logo" style="margin-left: -300px;" /></td>
  <td>La <font color=red><B>---</B></font> Indica el Trafico.</td>
  </tr>
    <form name="form1">
		<td><button class="btn1"><a href="index.php">Volver</button></td>
		<th></th>
		<!-- <td><input type="button" onclick="agregarOrigen()" value="Ubicar en el Mapa" hidden /> -->
	</form>
	</td>
	<tr>
		
	<!-- <td colspan="2"><input onclick="misRutas();" type="button" value="mis Rutas" class="btn1"  /></td> -->
	
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
