<!DOCTYPE HTML>
<?php
	session_start();
	if ($_SESSION["id_usuario"] == ""){
		header("location:index.php");
	}	
	$_SESSION["confirmarClaveError"] = "";
	$_SESSION["validarClaveError"] = "";
?>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!-- <link rel="stylesheet" type="text/css" href="https://unpkg.com/sweetalert/dist/sweetalert.css"> -->
		<link rel="stylesheet" href="assets/css/main.css"/>
		<style>
			.alert {
			  padding: 20px;
			  background-color: #f44336;
			  color: white;
			  opacity: 1;
			  transition: opacity 0.6s;
			  margin-bottom: 15px;
			}

			.alert.success {background-color: #4CAF50;}
			.alert.info {background-color: #2196F3;}
			.alert.warning {background-color: #ff9800;}

			.closebtn {
			  margin-left: 15px;
			  color: white;
			  font-weight: bold;
			  float: right;
			  font-size: 22px;
			  line-height: 20px;
			  cursor: pointer;
			  transition: 0.3s;
			}

			.closebtn:hover {
			  color: black;
			}
			
			div.table-scroll {
				width: 100%; 
				height: 370px; 
				overflow: scroll; 
			}			
		</style>
	</head>
	
	<body class="subpage">
		<!-- Header -->
		<header id="header" >
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
			<a href="#menu" class="toggle"><span>Menu</span></a>
		</header>

		<!-- Nav -->
		<nav id="menu">
			<ul class="links">
				<li><a href="perdido.php">Perdido</a></li>
				<li><a href="encontrado.php">Encontrado</a></li>
				<li><a href="estadisticas.php">Estadisticas</a></li>
				<li><a href="index.php">Cerrar sesión</a></li>				
			</ul>
		</nav>
		
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>				
					<div class="inner">
						<a href="choose.php" class="button def" style="float:right;">Volver</a>	
						<div align="left">							
							<h2>Perfil <i class="icon small fa-user" style="font-size:30px"></i></h2>								
						</div>						

						<?php
							$style = "this.parentElement.style.display='none';";					
							
							if ($_SESSION["mostrarMensaje"]){
								if ($_SESSION["match"]){
									echo "<div class='alert success'>".								
										  "<span class='closebtn' onclick=".'"'.$style.'"'.">&times;</span>".
										  "<strong>¡Se ha registrado una coincidencia exitosamente!</strong> Puede verla en la sección de 'Objetos reportados anteriormente'.".
										"</div>";
								} else {
									echo "<div class='alert'>".
										  "<span class='closebtn' onclick=".'"'.$style.'"'.">&times;</span>".
										  "<strong>¡No se encontraron coincidencias!</strong> El objeto será registrado en el sistema, puede observarlo en la sección de 'Objetos reportados anteriormente'.".										  
										"</div>";
								}								
							}							
						?>
						<div class="grid-style">
							<div>	
								<b style="color:MediumSeaGreen">
									Mis datos personales:
								</b><br>
								<table>
									<tbody>
										<?php
											include "conexion.php";
											$id_usuario = $_SESSION["id_usuario"];
											
											$infoUsuario = "CALL personStats($id_usuario);";
																									
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($infoUsuario)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){
													while ($row = $result->fetch_array()){	
														$nombre = $row["name"];
														$apellidos = $row["lastname1"]." ".$row["lastname2"];
														if ($row["telephone"] == ""){
															$telefono = "Usted no tiene un teléfono asociado.";
														} else {
															$telefono = $row["telephone"];
															$_SESSION["telefono"] = $telefono;
														}
														$correo = $row["email"];
														$_SESSION["correo"] = $correo;
														$id_zone = $row["id_zone"];
														$_SESSION["id_zone"] = $row["id_zone"];														
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
											<td>Teléfono: <font style="color:Red; float:right;"><?php echo $_SESSION["error_telefono"]; unset($_SESSION["error_telefono"]);?></font>
												<form method="post" action="guardar_telefono.php" enctype="multipart/form-data">
													<input type="text" id="telefono" name='telefono' style="width:60%; float:left;" onkeyup="this.value = this.value.replace(/[^0-9+]/g, '')" minlength="8" value="<?php echo $telefono; ?>">																									
													<input type="submit" value="Cambiar" style="float:right;">
												</form>		
											</td>
										</tr>
										<tr>
											<td>Correo: <font style="color:Red; float:right;"><?php echo $_SESSION["error_correo"]; unset($_SESSION["error_correo"]);?></font>
												<form method="post" action="guardar_correo.php" enctype="multipart/form-data">
													<input type="email" id="correo" name='correo' required style="width:60%; float:left;" onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_@.]/g, '')" value="<?php echo $correo; ?>">
													<input type="submit" value="Cambiar" style="float:right;">
												</form>		
											</td>
										</tr>
										<tr>
											<td>Lugar de preferencia: 
												<form method="post" id="zonas" action="guardar_favorito.php" enctype="multipart/form-data">
													<select id="zona" name='zona' required style="width:60%; float:left;" >													
														<option value="">Seleccione una zona</option>
														<?php
															include "conexion.php";
															
															$zonas = "CALL getZonas();";
															$listaZonas = "";
																													
															// Ejecutar y validar el comando SQL 
															if ($mysqli->multi_query($zonas)) {
																// almacenar primer juego de resultados 
																if ($result = $mysqli->store_result()){
																	while ($row = $result->fetch_array()){
																		if ($row["id_zone"] == $id_zone){
																			$listaZonas = $listaZonas."<option value=".$row["id_zone"]." selected>".$row["name"]."</option>";
																		} else {
																			$listaZonas = $listaZonas."<option value=".$row["id_zone"].">".$row["name"]."</option>";
																		}	
																	}
																	$result->free();
																}
															}												
															echo $listaZonas;
														?>
													</select>													
													<input type="submit" value="Cambiar" style="float:right;">
												</form>											
											</td>
										</tr>
										<tr>
											<td>
												Contraseña: ********
												<a href="cambio_clave.php" class="button" style="float:right;">Cambiar</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div>
								<b style="color:MediumSeaGreen">
									Objetos reportados anteriormente:
								</b>

								<div class="table-scroll"> 
									<table>
										<col width="40%">
										<col width="10%">
										<col width="10%">
										<?php
											include "conexion.php";
											$id_usuario = $_SESSION["id_usuario"];
											
											$objetosUsuario = "CALL objectsByUser($id_usuario);";
																									
											$resultado = "";												
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($objetosUsuario)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){														
													while ($row = $result->fetch_array()){	
														if ($row['condition'] == 1) $tipo = "Encontrado"; else $tipo = "Perdido";
														if ($row['matched'] == 1) $condicion = "src='images/yes.png'"; else $condicion = "src='images/no.png'";											
														$resultado = $resultado."<tr><form method='post' action='vermas_perfil.php' enctype='multipart/form-data'>".
																				"<td><font style='color:rgb(50, 50, 50);'>Tipo: ".$tipo."</font><br>".$row['description']."</td>".
																				"<input type='hidden' name='id_objeto' value='".$row['id_object']."'>".
																				//"<td>".$tipo."</td>".
																				"<td><center><img height='30px'".$condicion."/></center></td>".
																				"<td><center><input type='submit' name='submit' value='Ver'  class='button def'></center></td>".
																				"</form></tr>";
													}
													$result->free();
												}
											}
											
											if(	$resultado == ""){
												echo "<tr><td>No se han registrado objetos anteriormente.</td></tr>";
											} else {
												echo "<thead>".												
														 "<tr>".
															"<th>Descripción</th>".
															"<th>Condición</th>".
															"<th>Detalles</th>".																		
														 "</tr>".
													 "</thead>".
													 "<tbody>".$resultado."</tbody>";
											}										
										?>
									</table>
								</div>
							</div>
						</div>
						<div align="center">
							<h2>Notificaciones <i class="icon small fa-bell" style="font-size:30px"></i></h2>
							
							<?php								
								include "conexion.php";
								$id_usuario = $_SESSION["id_usuario"];
								
								$objetosUsuario = "CALL getNotifications($id_usuario);";
								
								$style = "this.parentElement.style.display='none';";																						
								$notificaciones = "";												
								// Ejecutar y validar el comando SQL 
								if ($mysqli->multi_query($objetosUsuario)) {
									// almacenar primer juego de resultados 
									if ($result = $mysqli->store_result()){
										while ($row = $result->fetch_array()){
											$notificaciones .=  "<div>".
																	"<div class='3u 12u$(medium)'>".
																	"</div>".
																	"<div class='alert success 6u 12u$(medium)'>".
																		"<span class='closebtn' onclick=".'"'.$style.'"'.">&times;</span>".	
																		"<form method='post' action='vermas_notificacion.php' enctype='multipart/form-data'>".
																		"<strong>¡Se ha reportado una coincidencia!</strong> ".
																		"<input type='hidden' name='id_user' value='".$row['id_user_found']."'>".
																		"<input type='hidden' name='id_objeto' value='".$row['id_object']."'>".
																		"<input type='hidden' name='id_notification' value='".$row['id_notification']."'>".																				
																		"<input type='submit' value='Ver más'/>".
																		"</form>".
																	"</div>".
																	"<div class='3u 12u$(medium)'>".
																	"</div>".
																"</div>";										
										}
										$result->free();
									}
								}
								if(	$notificaciones == ""){
									echo "<div><div class='alert info'>".
										"<span class='closebtn' onclick=".'"'.$style.'"'.">&times;</span>".	
										"<strong>¡Sin notificaciones!</strong> ".
										"Actualmente no se han encontrado coincidencias para sus objetos.".										
									"</form></div></div>";
								} else {
									echo $notificaciones;
								}
							?>
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
			var close = document.getElementsByClassName("closebtn");
			var i;

			for (i = 0; i < close.length; i++) {
			  close[i].onclick = function(){
				var div = this.parentElement;
				div.style.opacity = "0";
				setTimeout(function(){ div.style.display = "none"; }, 600);
			  }
			}
		</script>
		<?php
			if ($_SESSION["cambioClave"]){
				echo '<script language="javascript">setTimeout(function(){swal("¡Cambio exitoso!", "Se cambió la contraseña exitosamente.", "success");}, 100);</script>';
				unset($_SESSION["cambioClave"]);
			}
			if (isset($_SESSION["cambioFavZone"])){
				if ($_SESSION["cambioFavZone"]){
					echo '<script language="javascript">setTimeout(function(){swal("¡Cambio exitoso!", "Se cambió el lugar de preferencia exitosamente.", "success");}, 100);</script>';
					unset($_SESSION["cambioFavZone"]);
				} else {
					echo '<script language="javascript">setTimeout(function(){swal("¡Atención!", "El lugar que seleccionó ya es su favorito.", "info");}, 100);</script>';
					unset($_SESSION["cambioFavZone"]);
				}
			}	
			if (isset($_SESSION["cambioCorreo"])){
				if ($_SESSION["cambioCorreo"]){
					echo '<script language="javascript">setTimeout(function(){swal("¡Cambio exitoso!", "Se cambió el correo exitosamente.", "success");}, 100);</script>';
					unset($_SESSION["cambioCorreo"]);
				} else {
					echo '<script language="javascript">setTimeout(function(){swal("¡Atención!", "El correo ingresado corresponde al mismo que tenía antes.", "info");}, 100);</script>';
					unset($_SESSION["cambioCorreo"]);
				}
			}
			if (isset($_SESSION["cambioTelefono"])){
				if ($_SESSION["cambioTelefono"]){
					echo '<script language="javascript">setTimeout(function(){swal("¡Cambio exitoso!", "Se cambió el teléfono exitosamente.", "success");}, 100);</script>';
					unset($_SESSION["cambioTelefono"]);
				} else {
					echo '<script language="javascript">setTimeout(function(){swal("¡Atención!", "El teléfono ingresado corresponde al mismo que tenía antes.", "info");}, 100);</script>';
					unset($_SESSION["cambioTelefono"]);
				}
			}				
			if ($_SESSION["mensajeEliminarNotificacion"]){
				echo '<script language="javascript">setTimeout(function(){swal("¡Eliminación exitosa!", "Se eliminó la notificación exitosamente.", "success");}, 100);</script>';
				unset($_SESSION["mensajeEliminarNotificacion"]);
			}
		?>	
	</body>
</html>