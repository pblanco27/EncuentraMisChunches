<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] == ""){
		header("location:index.php");
	}
	$confirmarClaveError = $_SESSION["confirmarClaveError"];
	$validarClaveError = $_SESSION["validarClaveError"];
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
		<header id="header">
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
		</header>
		
		<section id="one" class="wrapper style2">					
			<b style="color:MediumSeaGreen">
				<center>
					<div>
						<h2>Cambiar contraseña  <i class="icon small fa-lock" style="font-size:30px"></i></h2><br>							
					</div>
					<form method="post" action="validar_cambio_clave.php" enctype="multipart/form-data">
						<input type="password" style='width:50%;' placeholder ="&#128272; Contraseña actual" name="clave_actual" onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_-@]/g, '')" required>	
						<font style="color:Red"><?php echo $validarClaveError."<br><br>";?></font>
						<input type="password" style='width:50%;' placeholder ="&#128272; Nueva contraseña" name="nueva_clave" onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_-@]/g, '')" required><br><br>
						<input type="password" style='width:50%;' placeholder ="&#128272; Confirmar contraseña" name="clave_confirmacion" onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9_-@]/g, '')" required>
						<font style="color:Red"><?php echo $confirmarClaveError."<br><br>";?></font>
						<div class="row 200%">
							<div class="12u 12u$(medium)">
								<a href="perfil.php" class="button def">Volver</a>
								<input type="submit" value="Cambiar"/><br><br>
							</div>
						</div>
					</form>
				</center>
				<br><br><br><br><br><br><br>
			</b>
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