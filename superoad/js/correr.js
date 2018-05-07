	var map;
	var markers = [];
	var _path = []; 
	var geocoder;
	var directionsService;
    var directionsDisplay;
	var service;
	var infowindow;
	var point = {lat: 4.697516, lng: -74.090166};
	
	   
		  var customLabel = 
		  {
            restaurant: {label: 'R' },
			punto: {label: ''}
          };
		  
			
      function initMap() {
		
        var uniminuto = {lat: 4.697516, lng: -74.090166};
        
		map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: uniminuto
        });
		geocoder = new google.maps.Geocoder();
			
		directionsService = new google.maps.DirectionsService,
        directionsDisplay = new google.maps.DirectionsRenderer({
        map: map
        });
	  }			
	function crearMarcador(place)
	{
   
		var infoWindow = new google.maps.InfoWindow({map: map});
		var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location
		});
		   var valoracion=Math.random();
		   var ib = valoracion.toFixed(1);		   
           infoWindow.setPosition(place.geometry.location);
           infoWindow.setContent('IB:'+ib);
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

	function codeAddress(dir) {
	var address = dir;
    var address = document.getElementById('ciudad').value; 
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        
        var customerMarker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
		cercanos(results[0].geometry.location);
		} else {
        alert('Geocode no obtuvo resultados por la siguiente razon: ' + status);
      }
    });
  }	
		function trafico(){
		  var trafficLayer = new google.maps.TrafficLayer();
    	  trafficLayer.setMap(map); 
		}
	  
	  
		function agregarCiudad()
		{
			//showAddress(document.getElementById('ciudad').value,"Destino", "B");		
			codeAddress(document.getElementById('ciudad').value);
			geocodeAddress('ciudad');	  
			copiarDatos();
        }
		
		function agregarOrigen()
		{
			//showAddress(document.getElementById('dir').value,"Origen", "A");		
			codeAddress(document.getElementById('dir').value);
			geocodeAddress('dir');	  
        }
		
		function showLatLong(lat, longi) 
		{
			var geocoder = new google.maps.Geocoder();
			var yourLocation = new google.maps.LatLng(lat, longi);
			geocoder.geocode({ 'latLng': yourLocation },processGeocoder);

		}

		function processGeocoder(results, status)
		{

			if (status == google.maps.GeocoderStatus.OK) 
			{
				if (results[0]) 
				{
					document.forms[0].dir.value=results[0].formatted_address;
					document.getElementById("dirO").value =	results[0].formatted_address;		
				} 
				else
				{
					error('Google no retorno resultado alguno.');
				}
			}
			else
			{
				error("Geocoding fallo debido a : " + status);
			}
		}

		function error(msg) 
		{
			alert(msg);
		}

		function geoOK(position) 
		{
			showLatLong(position.coords.latitude, position.coords.longitude);
			document.getElementById("xo").value = position.coords.latitude;
			document.getElementById("yo").value = position.coords.longitude;

			lat=parseFloat(position.coords.latitude);
			lon=parseFloat(position.coords.longitude);
		  
			var pointX={lat: lat, lng: lon};
			var markerX = new google.maps.Marker({
				position: pointX,
				label: "A",
				title:"Estoy Aqui",
				map: map,
				animation: google.maps.Animation.DROP
			});	
			
		    }


		function geoMaxmind() 
		{
			showLatLong(geoip_latitude(), geoip_longitude());
		}

		function geoKO(err) 
		{
			if (err.code == 1) 
			{
				error('El usuario ha denegado el permiso para obtener informacion de ubicacion.');
			} else if (err.code == 2) 
			{
				error('Tu ubicacion no se puede determinar.');
			} else if (err.code == 3) 
			{
				error('TimeOut.')
			} else 
			{
				error('No sabemos que pasó pero ocurrio un error.');
			}
		}
		
		function getGeo(){

			if (navigator && navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(geoOK, geoKO);
			} else {
				geoMaxmind();
			}
		}
/*
		function addMarker(location) {
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				});
			markers.push(marker);
		}
	*/  
		function addGass(location) 
		{
			var img='http://localhost:8000/superoad/img/estacion.png';
			var gas = new google.maps.Marker({
			position: location,
			map: map,
			icon:img
			});
			markers.push(gas);
		}
		
			
		function unirPuntos(map)
		{
			for (var i = 0; i < markers.length; i++) 
			{
				markers[i].setMap(map);
				var markerLatLng = markers[i].getPosition();
				lat=parseFloat(markerLatLng.lat());
				lon=parseFloat(markerLatLng.lng());
				var pointB={lat: lat, lng: lon};
			  
				var start = point;
				var end = pointB;
				var request = {
					origin: start,
					destination: end,
					travelMode: 'DRIVING'
				};
				directionsService.route(request, function(result, status) {
					if (status == 'OK') {
					directionsDisplay.setDirections(result);
					}
				});
			point={lat: lat, lng: lon};
			}
		}
		
		function computeTotalTime(result, inicio, fin ) 
		{
			var directionsService = new google.maps.DirectionsService;
			
			var directionsDisplay = new google.maps.DirectionsRenderer({map: map});

				// Request route directions
				directionsService.route({
				origin: inicio,
				destination: fin,
				travelMode: google.maps.TravelMode.DRIVING
				}, function(response, status) {
					if (status === google.maps.DirectionsStatus.OK) {
    
					// Get first route duration
					var route = response.routes[0];
					var duration = 0;
    
					route.legs.forEach(function (leg) {
						// The leg duration in seconds.
					duration += leg.duration.value;
					});
    
			directionsDisplay.setDirections(response);
			document.getElementById('tiempo').innerHTML = duration + ' seconds';
		} else {
			window.alert('error al calcular tiempo de recorrido. ' + status);
		}
		});
				
		}
		
		function computeTotalDistance(result) 
		{
			var total = 0;
			var myroute = result.routes[0];
				for (var i = 0; i < myroute.legs.length; i++) {
						total += myroute.legs[i].distance.value;
				}
					total = total / 1000.0;
					document.getElementById('total').innerHTML = total + ' Metros';
					document.getElementById('distancia').value= total;
		}

		
		function unir(){
			for (var i = 0; i < markers.length; i++) 
			{
				unirPuntos(map);
			}
		}
	  /*
      function setMapOnAll(map) {
			for (var i = 0; i < markers.length; i++) 
			{
				markers[i].setMap(map);
			}	
		}
	/*	
      function showMarkers() {
        setMapOnAll(map);
      }
	  
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
	  
      function clearMarkers() {
        setMapOnAll(null);
      }  
	*/
	  
		function ruta()
		{
			var lat=parseFloat(document.getElementById('xo').value);
			var lng=parseFloat(document.getElementById('yo').value);
	  
			var latD=parseFloat(document.getElementById('x').value);
			var lngD=parseFloat(document.getElementById('y').value);
	  
			var pointA = {lat:lat, lng: lng};
			var pointB = {lat:latD, lng: lngD};
	
	        var start = pointA;
			var end = pointB;
			var request = {
				origin: start,
				destination: end,
				travelMode: 'DRIVING',
				provideRouteAlternatives: true,
			};
			directionsService.route(request, function(result, status) 
			{
				if (status == 'OK') 
				{
				directionsDisplay.setDirections(result);
				computeTotalDistance(result);
				computeTotalTime(result, start, end ) 
				infowindow = new google.maps.InfoWindow();
				/* */
				cercanos(results[0].geometry.location);
				service = new google.maps.places.PlacesService(map);
					
				}
			});
	  
	
		}
		
		function callback(results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
          for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
          }
        }
      }
		
		function createMarker(place) {
			var placeLoc = place.geometry.location;
			var marker = new google.maps.Marker({
			map: map,
			position: place.geometry.location,
			label: 'x'
			});
		marker.setMap(map);
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.setContent(place.name);
          infowindow.open(map, this);
        });
      }

		
		function geocodeAddress(dato) 
		{
			var geocoder = new google.maps.Geocoder();
			var direccion=dato;
			//var address = document.getElementById('ciudad').value;
			var address = document.getElementById(direccion).value;

			geocoder.geocode({'address': address}, function(results, status) 
			
			{
				if (status === 'OK') 
				{
					map.setCenter(results[0].geometry.location);
					var marker = new google.maps.Marker({
						map: map,
						label:"B",
						position: results[0].geometry.location
					});            
				document.getElementById("x").value = results[0].geometry.location.lat();
				document.getElementById("y").value = results[0].geometry.location.lng();

				}
				else 
				{
					alert('La localización no fue satisfactoria por la siguiente razón: ' + status);
				}
			});
		}
	
		
		function misRutas()	
		{
         			
				var directionsDisplay = new google.maps.DirectionsRenderer();
				var directionsService = new google.maps.DirectionsService();
 
				var infoWindow = new google.maps.InfoWindow;
  
  
				downloadUrl('http://localhost:8000/superoad/salidaXML.php', function(data){
                var xml = data.responseXML;
                var markers = xml.documentElement.getElementsByTagName('marker');
                Array.prototype.forEach.call(markers, function(markerElem) 
				{
                    /*               
					var xo=markerElem.getAttribute('origenLat');
					var yo=markerElem.getAttribute('origenLng');
					var pointA = new google.maps.LatLng(parseFloat(xo), parseFloat(yo));
					
					var x=markerElem.getAttribute('destinoLat');
					var y=markerElem.getAttribute('destinoLng');
					var pointB = new google.maps.LatLng(parseFloat(x), parseFloat(y));
					
					var type = markerElem.getAttribute('idTipo');
					
					var name = markerElem.getAttribute('nombre');
					
					var address = markerElem.getAttribute('dirOrigen');					
					*/
					var name = markerElem.getAttribute('name');
					var address = markerElem.getAttribute('address');	
					var lat=markerElem.getAttribute('lat');
					var lng=markerElem.getAttribute('lng');
					var type = markerElem.getAttribute('idTipo');
					var pointA = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
					
					var infowincontent = document.createElement('div');
					var strong = document.createElement('strong');
                  strong.textContent = name
                  infowincontent.appendChild(strong);
                  infowincontent.appendChild(document.createElement('br'));
 
                  var text = document.createElement('text');
                  text.textContent = address
                  infowincontent.appendChild(text);
                  var icon = customLabel[type] || {};
					
						var markerA = new google.maps.Marker({
							map: map,
							position: pointA,
							label: "x"							
						});
					
						var markerB = new google.maps.Marker({
							map: map,
							position: pointB,
							label: "B"
						});
					
					markerA.addListener('click', function() 
					{
						infoWindow.setContent(infowincontent);
						infoWindow.open(map, markerA);    
					});
					
					markerB.addListener('click', function() 
					{
						infoWindow.setContent(infowincontent);
						infoWindow.open(map, markerB);    
					});
					
					var A=markerA.getPosition().lat();
					var A1=markerA.getPosition().lng();
					
					var desde = {lat:A, lng: A1};
					var hasta = {lat:A, lng:A1};
	
					var start = desde;
					var end = hasta;
					var request = 
					{
						origin: start,
						destination: end,
						travelMode: 'DRIVING'
					};
					directionsService.route(request, function(result, status) 
					{
						if (status == 'OK') 
						{
							directionsDisplay.setDirections(result);
							computeTotalDistance(result);
						}
					});
				});
			});
        }
		
		
    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() 
	  {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) 
	{
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() 
	  {
        if (request.readyState == 4) 
		{
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }
     
	 function doNothing() {}
	 

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() 
	  {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) 
	{
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() 
	  {
        if (request.readyState == 4) 
		{
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }
     
		function doNothing() {}
	 
		function copiarDatos() 
		{
			document.getElementById('dirO').value= document.getElementById('dir').value;
			document.getElementById('dirD').value= document.getElementById('ciudad').value;
		}
