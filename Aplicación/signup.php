<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	$usuarioError = $_SESSION["errorUsuario"];
	$correoError = $_SESSION["errorEmail"];
	$nombreError = $_SESSION["error_nombre"];
	$apellido1Error = $_SESSION["error_apellido1"];
	$apellido2Error = $_SESSION["error_apellido2"];
	$telError = $_SESSION["error_telefono"];
	$claveConfirmarError = $_SESSION["error_confirmar_contrasena"];
?>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body class="subpage">
		<!-- Header -->
		<header id="header" >
			<div class="logo"><a href="index.php"><img src="images/logo-mini.png" height="100%"></a></div>
		</header>

		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>
					<div class="inner">					
						<a href="index.php" class="button def" style="float:right;">Volver</a>						
						<div align="left">
							<h2>Registro <i class="icon small fa-pencil" style="font-size:30px"></i></h2>								
						</div>
						<div class="row 200%">
							<div class="6u 12u$(medium)" align="left">
								<b style="color:MediumSeaGreen">	
									Ingrese sus datos a continuación
								</b>
							</div>
							<div class="6u 12u$(medium)" align="right">
								<b style="color:MediumSeaGreen">	
									Los campos marcados con asterisco (<font style="color:Red">*</font>) son obligatorios.
								</b>
							</div>
						</div>						
						<form method="post" id="regForm" action="validar_persona.php" enctype="multipart/form-data">
							<div class="grid-style">
								<div>
									<b style="color:MediumSeaGreen"><br>						
										Nombre: <font style="color:Red">*</font>
										<input type='text' name='nombre' id = 'nombre' maxlength='40' required>
										<font style="color:Red"><?php echo $nombreError;?></font>
										<br><br>	
										<div class="row 200%">
											<div class="6u 12u$(medium)">
												Primer apellido: <font style="color:Red">*</font>
												<input type='text' name='apellido1' id = 'apellido1' maxlength='40' required>
												<font style="color:Red"><?php if ($apellido1Error != "") echo $apellido1Error; else echo "<br><br>";?></font>	
											</div>
											<div class="6u 12u$(medium)">
												Segundo apellido: <font style="color:Red">*</font>
												<input type='text' name='apellido2' id = 'apellido2' maxlength='40' required>
												<font style="color:Red"><?php if ($apellido2Error != "") echo $apellido2Error; else echo "<br><br>";?></font>
											</div>
										</div>
										Teléfono:
										<input type='text' name='tel' id = 'tel' onkeyup="this.value = this.value.replace(/[^0-9+]/g, '')" maxlength='40'>
										<font style="color:Red"><?php echo $telError;?></font>
									</b>
								</div>
								<div>
									<b style="color:MediumSeaGreen"><br>
										Correo electrónico: <font style="color:Red">*</font>
										<input type='email' name='correo' id = 'correo'  maxlength='80' onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_@.]/g, '')" required>
										<font style="color:Red"><?php echo $correoError;?></font>
										<br><br>
										<div style="width:100%;">
											Usuario: <font style="color:Red">*</font>
											<input type='text' name='usuario' id 'usuario'  maxlength='40' onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_-]/g, '')" required>
											<font style="color:Red"><?php echo $usuarioError;?></font>
											<br><br>
										</div>										
										<div class="row 200%">
											<div class="6u 12u$(medium)">
												Contraseña: <font style="color:Red">*</font>
												<input type='password' name='contrasena' id='contrasena' maxlength='40' onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_-@]/g, '')" required>
												<font style="color:Red"><?php echo $claveError;?></font><br><br>
											</div>
											<div class="6u 12u$(medium)">
												Confirmar contraseña: <font style="color:Red">*</font>
												<input type='password' name='confirmar_contrasena' id='confirmar_contrasena' maxlength='40' onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_-@]/g, '')" required>
												<font style="color:Red"><?php echo $claveConfirmarError;?></font>
											</div>
										</div>		
									</b>
								</div>
							</div>							
							<div align="center">							
								<div class="row 200%">
									<div class="12u 12u$(medium)">
										<input id="terminos" type="checkbox" onchange="document.getElementById('submit').disabled = !this.checked;"/>
										<label for="terminos">Acepto los <a href="terminos_condiciones.php">términos y condiciones</a></label><br>
										<input type='submit' value="Registrarse" id="submit" disabled/>
									</div>
								</div>
							</div>
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
	</body>
</html>