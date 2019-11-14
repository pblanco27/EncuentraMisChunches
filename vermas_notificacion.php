<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	$_SESSION["id_notification"] = $_POST["id_notification"];
?>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />		
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/sweetalert/dist/sweetalert.css">
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body class="subpage">
		<!-- Header -->
		<header id="header" >
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
		</header>
		
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>
					<div class="inner">
						<a href="perfil.php" class="button def" style="float:right;">Volver</a>
						<div align="left">
							<h2>Información de la coincidencia <i class="icon small fa-info" style="font-size:30px"></i></h2>								
						</div>
						<div class="grid-style">
							<div>	
								<b style="color:MediumSeaGreen">
									Datos del usuario correspondiente:
								</b>
								<table>
									<tbody>
										<?php
											include "conexion.php";
											//$id_usuario = 1;
											$id_user = $_POST["id_user"];
											
											$infoUsuario = "CALL personStats($id_user);";
																									
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($infoUsuario)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){
													while ($row = $result->fetch_array()){	
														$nombre = $row["name"];
														$apellidos = $row["lastname1"]." ".$row["lastname2"];
														if ($row["telephone"] == ""){
															$telefono = "El usuario no tiene un número teléfonico asociado.";
														} else {
															$telefono = $row["telephone"];
														}
														$correo = $row["email"];
													}
													$result->free();
												}
											}					
										?>
										<tr>
											<td>Nombre: <?php echo $nombre; ?></td>
										</tr>
										<tr>
											<td>Apellidos: <?php echo $apellidos; ?></td>
										</tr>
										<tr>
											<td>Teléfono: <?php echo $telefono; ?></td>
										</tr>
										<tr>
											<td>Correo: <?php echo $correo; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="table-wrapper">
								<b style="color:MediumSeaGreen">
									Datos del objeto:
								</b>
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
													echo "<td><img height='200px' src='data:image/jpg;base64,".base64_encode($imagen)."'/></td>";
												} else { 
													echo "<td>No se adjuntó imagen al objeto.</td>";
												}
											?>
										</tr>
										<tr>
											<td><b style="color:MediumSeaGreen">Zona:</b></td>
											<td><?php echo $zona?></td>
										</tr>
									</tbody>
								</table>						
							</div>							
						</div>
						<div align="center">							
							<div class="row 200%">
								<div class="12u 12u$(medium)">
									<a onclick="confirmacion()" class="button def">Eliminar</a>
								</div>
							</div>
						</div>
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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>	
		<script>
			function confirmacion() {
				swal({
				  title: "¿Está seguro?",
				  text: "Una vez eliminada, usted no podrá recuperar esta notificación.",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
					window.location="eliminar_notificacion.php";
				  } 
				});
			}
		</script>
	</body>
</html>