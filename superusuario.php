<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] != 0){
		header("location:index.php");
	}
?>
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
				height: 300px;
				width: 100%;
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
		<header id="header" >
			<div class="logo"><a href="index.php"><img src="images/logo-mini.png" height="100%"></a></div>
			<a>Super usuario</a>
		</header>


		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<a href="index.php" class="button def" style="float:right;">Volver</a>
				<div align="left">
					<h2>Ingresar nuevo punto de referencia <i class="icon small fa-map-marker" style="font-size:30px"></i></h2>								
				</div>
				<section>
					<div class="inner">
						<form method="post" action="super_user_formulario.php" enctype="multipart/form-data">
							<b style="color:MediumSeaGreen">
								Nombre del lugar: 
								<input type='text' name='nombre' maxlength="100" onkeyup="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9,.;:()+-]/g, '')" required>
								<font style="color:Red"><?php echo $nombreEncError;?></font>
								<input type="hidden" id="coords.lat" name="latitude"/>
								<input type="hidden" id="coords.lng" name="longitude"/>
								<br><br>
								Geolocalización:
								<div id="map"></div>
								<div align="center">
									<br>
									<input type="submit" value="Ingresar"/>
								</div>									
							</b>
						</form>
					</div>
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
				  lng: -84.0753111,
				  lat: 9.9379992
				};
				setMapa(coords);
			}

			function setMapa (coords)
			{   
				  var map = new google.maps.Map(document.getElementById('map'),
				  {
					zoom: 7,
					center:new google.maps.LatLng(coords.lat,coords.lng),
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
					//document.getElementById("coords").value = coords.lat + ", "+ coords.lng;
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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<?php
			if (isset($_SESSION["confirmarNuevaZona"])){
				if ($_SESSION["confirmarNuevaZona"]){
					echo '<script language="javascript">setTimeout(function(){swal("¡Registro exitoso!", "Se registró el nuevo punto de referencia exitosamente.", "success");}, 100);</script>';
				} else {
					echo '<script language="javascript">setTimeout(function(){swal("¡Atención!", "Debe arrastrar el marcador para seleccionar un punto en el mapa.", "info");}, 100);</script>';				}
				unset($_SESSION["confirmarNuevaZona"]);
			}	
		?>
	</body>
</html>