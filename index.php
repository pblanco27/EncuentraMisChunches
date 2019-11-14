<!DOCTYPE HTML>
<?php
	session_start();
	unset($_SESSION["id_usuario"]);
	$_SESSION["mostrarMensaje"] = false;
	$_SESSION["id_usuario"] = "";
	$_SESSION["loginError"] = "";
	$_SESSION["errorUsuario"] = "";
	$_SESSION["errorEmail"] = "";	
	$_SESSION["error_nombre"] = "";
	$_SESSION["error_apellido1"] = "";
	$_SESSION["error_apellido2"] = "";
	$_SESSION["error_telefono"] = "";
	$_SESSION["error_confirmar_contrasena"] = "";	
?>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body>
		<!-- Header -->
		<header id="header" class="alt">
			<!-- <div class="logo"><a href="index.php">Encuentra Mis Chunches</a></div> -->
		</header>
		
		<!-- Nav -->
		<!-- Banner -->
		<!--
			To use a video as your background, set data-video to the name of your video without
			its extension (eg. images/banner). Your video must be available in both .mp4 and .webm
			formats to work correctly.
		-->
		<section id="banner" data-video="images/banner">
			<div class="inner">
				<img src="images/logo.png" width="50%">
				<p>
					El sistema para reportar objetos que se han perdido en su zona
				</p>
				<div class="row 200%">
					<div class="6u 12u$(medium)">
						<a href="signup.php" class="button special scrolly">Registrarse</a>
					</div>
					<div class="6u 12u$(medium)">
						<a href="login.php" class="button special scrolly">Iniciar Sesión</a>	
					</div>
				</div>
			</div>
			<br><br><br><br><br><br><br>
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