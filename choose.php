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
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" href="assets/css/main.css"/>
	</head>
	
	<body class="subpage">
		<!-- Header -->
		<header id="header" >
			<div class="logo"><a href="#"><img src="images/logo-mini.png" height="100%"></a></div>
			<a href="index.php"><b style="color:white;">Cerrar sesión</b></a>		
		</header>
		
		<nav id="menu">
			<ul class="links">
				<li><a href="index.php">Cerrar sesión</a></li>				
			</ul>
		</nav>

		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<div class="grid-style">
					<div>
						<div class="box">
							<div class="image fit">
								<img src="images/pic02.jpg" alt="" />
							</div>
							<div class="content" align="center">
								<header class="align-center">
									<h2>He encontrado un objeto</h2>
									<p>En esta sección puede reportar objetos perdidos que ha encontrado</p>
								</header>
								<a href="encontrado.php" class="button def">Reportar</a>
							</div>
						</div>
					</div>

					<div>
						<div class="box">
							<div class="image fit">
								<img src="images/pic03.jpg" alt="" />
							</div>
							<div class="content" align="center">
								<header class="align-center">
									<h2>He perdido un objeto</h2>
									<p>En esta sección puede reportar objetos que se le han perdido</p>
								</header>
								<a href="perdido.php" class="button def">Reportar</a>
							</div>
						</div>
					</div>
					
					<div>
						<div class="box">
							<div class="image fit">
								<img src="images/pic01.jpg" alt="" />
							</div>
							<div class="content" align="center">
								<header class="align-center">
									<h2>Perfil</h2>
									<p>En esta sección puede observar sus datos personales, así como también los objetos que ha reportado</p>
								</header>
								<a href="perfil.php" class="button def">Acceder</a>
							</div>
						</div>
					</div>

					<div>
						<div class="box">
							<div class="image fit">
								<img src="images/p2.jpg" alt="" />
							</div>
							<div class="content" align="center">
								<header class="align-center">
									<h2>Estadisticas</h2>
									<p>En esta sección puede observar estadísticas relevantes con información recolectada por nuestro sistema</p>
								</header>
								<a href="estadisticas.php" class="button def">Acceder</a>
							</div>
						</div>
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

	</body>
</html>