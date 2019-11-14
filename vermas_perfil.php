<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] == ""){
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
		<header id="header">
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
			<a href="#menu" class="toggle"><span>Menu</span></a>
		</header>
		<nav id="menu">
			<ul class="links">
				<li><a href="perdido.php">Perdido</a></li>
				<li><a href="encontrado.php">Encontrado</a></li>
				<li><a href="estadisticas.php">Estadisticas</a></li>
				<li><a href="perfil.php">Perfil</a></li>
				<li><a href="index.php">Cerrar sesión</a></li>				
			</ul>
		</nav>
		<section id="one" class="wrapper style2">
			<div class="inner">						
				<a href="perfil.php" class="button def" style="float:right;">Volver</a>
				<div align="left">
					<h2>Información del objeto <i class="icon small fa-info" style="font-size:30px"></i></h2>								
				</div>
				<div class="grid-style">
					<div class="table-wrapper">
						<table>
							<tbody>
								<?php
									if ($_SERVER["REQUEST_METHOD"] == 'POST') {
										$id_objeto = $_POST["id_objeto"];
										$_SESSION["id_objeto"] = $_POST["id_objeto"];	
										
										include "conexion.php";	
										$obtenerObj = "CALL getObject($id_objeto)";	
										
										// Ejecutar y validar el comando SQL 
										if ($mysqli->multi_query($obtenerObj)) {
											// almacenar primer juego de resultados 
											if ($result = $mysqli->store_result()){											
												while($row = $result->fetch_array()){
													$descripcion = $row["description"];													
													$categoria = $row["categoria"];
													$tipo = $row["tipo"];
													$color = $row["color"];															
													$imagen = $row["image"];
													$zona = $row["zona"];
													$estado = $row["estado"];
													$_SESSION["latitud"] = $row["latitud"];
													$_SESSION["longitud"] = $row["longitud"];
												}								
												$result->free();
											}
										}							
										$mysqli->close();										
									}
								?>								
								<tr>
									<td><b style="color:MediumSeaGreen">Descripción:</b></td> 
									<td><?php echo $descripcion?></td>
								</tr>								
								<tr>									
									<td><b style="color:MediumSeaGreen">Categoría:</b></td>
									<td><?php echo $categoria?></td>									
								</tr>
								<tr>
									<td><b style="color:MediumSeaGreen">Tipo:</b></td>
									<td><?php echo $tipo?></td>
								</tr>
								<tr>
									<td><b style="color:MediumSeaGreen">Color:</b></td>
									<td><?php echo $color?></td>
								</tr>
								<tr>
									<td><b style="color:MediumSeaGreen">Imagen:</b></td>
									<?php 										
										if(!empty($imagen)){	
											echo "<td><img height='200px' src = 'data:image/jpg;base64,".base64_encode($imagen)."'/></td>";
										} else { 
											echo "<td>No se adjuntó imagen al objeto.</td>";
										}
									?>
								</tr>
								<tr>
									<td><b style="color:MediumSeaGreen">Zona:</b></td>
									<td><?php echo $zona?></td>
								</tr>
								<tr>
									<td><b style="color:MediumSeaGreen">Estado:</b></td>
									<td>
									<?php
										if($estado == 1){
											echo "<img height='30px' src='images/yes.png'/>";
											echo "               El objeto ha encontrado una coincidencia exitosamente.";											
										} else {
											echo "<img height='30px' src='images/no.png'/>";
											echo "               El objeto aún no ha encontrado alguna coincidencia.";											
										}
									?>
									</td>
								</tr>
							</tbody>
						</table>						
					</div>	
					<div>
						<b style="color:MediumSeaGreen">Geolocalización:</b><br><br>
						<div id="map"></div><br>
					</div>
				</div>	
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
			function initMap() {
				//Posición y opciones del mapa			  

				var position = {lng: <?php echo $_SESSION["longitud"]; ?>,
								lat: <?php echo $_SESSION["latitud"]; ?>};
				var mapOptions = {zoom: 18, 
								  center: position};
				//Se crea el mapa
				var map = new google.maps.Map(document.getElementById('map'), mapOptions);
				//Obtenemos los datos del lugar
				var title =  'Nombre del lugar';
				//Opciones del marcador
				var markerOptions = {position: position,
									 map: map,
									 title: title};
				//Se crea el marcador con las opciones previas
				var marker = new google.maps.Marker(markerOptions);
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAO-ZIuJR0tpwTLMD79QWAx6cs9wiHttOw&callback=initMap"
		async defer></script>
	</body>
</html>