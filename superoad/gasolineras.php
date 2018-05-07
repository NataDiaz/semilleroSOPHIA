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
          center: new google.maps.LatLng(-33.91722, 151.23064),
          mapTypeId: 'roadmap'
        });

       var icons = {
          parking: {
            icon: 'img/estacion.png'
          }
        };

        var features = [
          {
            position: new google.maps.LatLng(-33.91539, 151.22820),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91747, 151.22912),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91910, 151.22907),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91725, 151.23011),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91872, 151.23089),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91784, 151.23094),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91682, 151.23149),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91790, 151.23463),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91666, 151.23468),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.916988, 151.233640),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91662347903106, 151.22879464019775),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.916365282092855, 151.22937399734496),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91665018901448, 151.2282474695587),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.919543720969806, 151.23112279762267),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91608037421864, 151.23288232673644),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91851096391805, 151.2344058214569),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91818154739766, 151.2346203981781),
            type: 'parking'
          }, {
            position: new google.maps.LatLng(-33.91727341958453, 151.23348314155578),
            type: 'parking'
          }
        ];

        // Create markers.
        features.forEach(function(feature) {
          var marker = new google.maps.Marker({
            position: feature.position,
            icon: icons[feature.type].icon,
            map: map
          });
        });
		
      }
	  
	  function crearMarcador(place)
	{
   
		var infoWindow = new google.maps.InfoWindow({map: map});
		var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location
		});		   
           infoWindow.setPosition(place.geometry.location);
           infoWindow.setContent('$:'+12800);
            map.setCenter(place.geometry.location);

		// Asignamos el evento click del marcador
			google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(place.name);
			infowindow.open(map, this);
		});
   
	}		
	
	function cercanos(pos)
	{
			var myLatlng=pos;
			//var tipo='cafe';
			// Creamos el infowindow
			var infowindow = new google.maps.InfoWindow();

			// Especificamos la localización, el radio y el tipo de lugares que queremos obtener
			var request = {
			location: myLatlng,
			radius: 200,
			types: ['cafe']
			
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
  <td rowspan="5"><img src="logo.jpg" width="280px"; height="150px" alt="logo" /></td>
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
	<td colspan="2">Estacion<input type="checkbox" name="gas" id="gas"></td>
	
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