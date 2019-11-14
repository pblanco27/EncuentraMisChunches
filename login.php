<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	$_SESSION["errorUsuario"] = "";
	$_SESSION["errorEmail"] = "";
	$passwordLoginError = $_SESSION["loginError"];
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
		<header id="header">
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
		</header>
		
		<section id="one" class="wrapper style2">					
			<b style="color:MediumSeaGreen">
				<center>
					<div>
						<h2>Login <i class="icon small fa-unlock" style="font-size:30px"></i></h2><br>							
					</div>
					<form method="post" action="login_formulario.php" enctype="multipart/form-data">
						<input type="text" style='width:50%;' placeholder ="&#128272; Usuario" name="usuario"><br><br>
						
						<input type="password" style='width:50%;' placeholder ="&#128272; Contraseña" name="clave">
						<font style="color:Red"><?php echo $passwordLoginError."<br><br>";?></font><br>

						<div class="row 200%">
							<div class="12u 12u$(medium)" >
								<a href="index.php" class="button def">Volver</a>
								<input type="submit" value="Entrar"/><br><br>
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
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<?php
			if ($_SESSION["registroExitoso"]){
				echo '<script language="javascript">setTimeout(function(){swal("¡Registro exitoso!", "Se ha registrado exitosamente.", "success");}, 100);</script>';
				unset($_SESSION["registroExitoso"]);
			} 
		?>
	</body>
</html>