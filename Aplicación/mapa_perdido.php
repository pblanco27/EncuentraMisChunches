<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] == ""){
		header("location:index.php");
	}
	
	// Obtener las coordenadas del punto de referencia para centrar el mapa	
	include "conexion.php";											
	$geolocalizacion = "CALL getZoneCoords(".$_POST["zona"].");";
															
	// Ejecutar y validar el comando SQL 
	if ($mysqli->multi_query($geolocalizacion)) {
		// almacenar primer juego de resultados 
		if ($result = $mysqli->store_result()){
			while ($row = $result->fetch_array()){
				$_SESSION["longitude"] = $row["longitude"];
				$_SESSION["latitude"] = $row["latitude"];
			}
			$result->free();
		}
	}	
	
	// Guardar la info de la ventana anterior
	$_SESSION["description"] = $_POST["description"];
	$_SESSION["categoriaenc"] = $_POST["category"];
	$_SESSION["tipoenc"] = $_POST['choices']['0'];
	$_SESSION["fechaEncontrado"] = $_POST["fechaEncontrado"];
	$_SESSION["colorenc"] = $_POST["colorenc"];
	$_SESSION["imagen"] = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
	$_SESSION["zona"] = $_POST["zona"];	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<style>
			/* Always set the map height explicitly to define the size of the div
			* element that contains the map. */
			#map {
				height: 400px;
				width: 50%;
			}
			/* Optional: Makes the sample page fill the window. */
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			}
		</style>
	</head>
	
	<body class="subpage">
		<!-- Header -->
		<header id="header">
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
		</header>
		<nav id="menu">
			<ul class="links">
				<li><a href="encontrado.php">Encontrado</a></li>
				<li><a href="estadisticas.php">Estadisticas</a></li>
				<li><a href="perfil.php">Perfil</a></li>		
				<li><a href="index.php">Cerrar sesión</a></li>				
			</ul>
		</nav>
		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>
					<div align="center">		
						<h2>Marque el punto especifico <i class="icon small fa-map-marker" style="font-size:30px"></i></h2>								
				
						<div id="map"/>
					</div><br>				
				</section>
				<section>
					<div align="center">						
						<form method="post" action="match_perdido.php" enctype="multipart/form-data">					
							<input type="hidden" id="coords.lat" name="latitude"/>
							<input type="hidden" id="coords.lng" name="longitude"/>
							<a href="perdido.php" class="button def" style='width:140px; height:42px'><center>Cancelar</center></a>
							<input type="submit" id="submit" name="submit" value="Buscar" style='width:140px; height:42px'/>
						</form>			
					</div>	
					<!--COMENTEN LO DE ABAJO
					<input type="text" id="coords" />
					COMENTEN LO DE ARRIBA-->
									
				</section>
			</div>
		</section>
		
		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
		<script>
		var marker;          //variable del marcador
		var position;
		var coords = {};    //coordenadas obtenidas con la geolocalización

		//Funcion principal
		initMap = function () 
		{
			coords =  {
			  lng: <?php echo $_SESSION["longitude"]; ?>,
			  lat: <?php echo $_SESSION["latitude"]; ?>
			};
			setMapa(coords);			
		}

		function setMapa (coords)
		{   
			  var map = new google.maps.Map(document.getElementById('map'),
			  {
				zoom: 18,
				center:new google.maps.LatLng(coords.lat,coords.lng),
				draggable: false,
				disableDefaultUI: true,
				clickableLabels:false
			  });
			  marker = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				position: new google.maps.LatLng(coords.lat,coords.lng),

			  });
			  marker.addListener('click', toggleBounce);
			  
			  marker.addListener( 'dragend', function (event)
			  {
				coords =  {
					  lng: this.getPosition().lng(),
					  lat: this.getPosition().lat()
				};			
				
				//COMENTEN ESTO DE ABAJO
				document.getElementById("coords.lat").value = coords.lat;	
				document.getElementById("coords.lng").value = coords.lng;	
				//COMENTEN ESTO DE ARRIBA
			  });
		}

		function toggleBounce() {
		  if (marker.getAnimation() !== null) {
			marker.setAnimation(null);
		  } else {
			marker.setAnimation(google.maps.Animation.BOUNCE);
		  }
		}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAO-ZIuJR0tpwTLMD79QWAx6cs9wiHttOw&callback=initMap"
		async defer></script>
	</body>
</html>