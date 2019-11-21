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
				<div align="center">
					<h2>Lista de objetos con parentesco <i class="icon small fa-list" style="font-size:30px"></i></h2>								
				</div>
				<br>
				<b style="color:MediumSeaGreen">Descripción:</b>
				<div class="table-wrapper"> 
					<table>
						<tbody>
							<?php
								echo $_SESSION["resultado"];
							?>
						</tbody>
					</table>				
				</div>
				<div align="center">
					<a href="choose.php" class="button def">Ninguno coincide</a>
				</div>
				<br><br><br><br><br><br><br><br><br><br><br>
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