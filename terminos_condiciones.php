<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
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
			<div class="logo"><a href="signup.php"><img src="images/logo-mini.png" height="100%"></a></div>
		</header>

		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>
					<div class="inner">					
						<a href="signup.php" class="button def" style="float:right;">Volver</a>						
						<div align="left">
							<h2>Términos y condiciones de uso <i class="icon small fa-book" style="font-size:30px"></i></h2>								
						</div>	
						<div class="row 200%">
							<div class="2u 12u$(medium)">
								<br>							
							</div>
							<div class="8u 12u$(medium)" align="left"><br>	
								<font style="color:#666666;">
								<ul>									
									<li>
										Los datos personales proporcionados por los usuarios serán únicamente con fines de contacto. 
										No se utilizarán para ningún otro fin más que brindar un medio de contacto entre los mismos usuarios.
									</li>
									<li>
										Los datos recolectados por la aplicación referentes a la cantidad de objetos reportados (perdidos / encontrados),
										así como la cantidad de objetos que coinciden (devueltos / áun perdidos) serán únicamente con fines estadísticos.
									</li>
									<li>
										Encuentra Mis Chunches no se hace responsable por la entrega o devolución de los objetos registrados. 
										Es responsabilidad del usuario el contactar con la persona indicada para la posterior devolución del objeto encontrado.
									</li>
									<li>
										Al momento de coincidir algún objeto, se le notificará a los usuarios únicamente por medio de la aplicación.
										No se notificará a los usuarios por ningún otro medio del estipulado anteriormente.
									</li>
									<li>
										Cada usuario es responsable de sus credenciales de acceso. No se proveerá ningún medio de recuperación de contraseña.
										No nos hacemos responsables si el usuario olvidó / perdió / fue víctima de robo de información.
									</li>
									<li>
										El número telefónico y correo electrónico son los únicos datos de contacto de cada usuario.
										Estos se proporcionarán al momento de registrarse (el teléfono es opcional) y pueden modificarse una vez hecho el registro.
									</li>
									<li>
										Encuentra Mis Chunches es de uso completamente gratuito. Nunca se realizará ningún cobro / solicitud de pago por parte del sistema.
									</li>
									<li>
										Estos términos y condiciones, al igual que la aplicación, se encuentran sujetos a cambios. 
										Estos pueden ser consultados en cualquier momento desde la página de registro de la aplicación.
									</li>
								</ul>	
								</font>								
							</div>
							<div class="2u 12u$(medium)">
								<br>
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
	</body>
</html>