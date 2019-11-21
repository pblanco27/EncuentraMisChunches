<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	include "conexion.php";
			
	$nombreP= $_POST["nombre"];
	$apellido1P = $_POST["apellido1"];
	$apellido2P = $_POST["apellido2"];
	$telP = $_POST["tel"];
	$correoP = $_POST["correo"];
	$usuarioP = $_POST["usuario"];
	$contrasenaP = $_POST["contrasena"];	
	$confirmar_contrasenaP = $_POST["confirmar_contrasena"];	
	
	$_SESSION["error_nombre"] = "";
	$_SESSION["error_apellido1"] = "";
	$_SESSION["error_apellido2"] = "";
	$_SESSION["error_telefono"] = "";
	$_SESSION["error_confirmar_contrasena"] = "";	
	$errorUsuario = "";
	$errorEmail = "";
	
	if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ]*$/", $nombreP) ) {
		$_SESSION["error_nombre"] = "El nombre solo debe contener letras.";
	}
	if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ]*$/", $apellido1P) ) {
		$_SESSION["error_apellido1"] = "El primer apellido solo debe contener letras.";
	}
	if (!preg_match("/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ]*$/", $apellido2P) ) {
		$_SESSION["error_apellido2"] = "El segundo apellido solo debe contener letras.";
	}
	if(!preg_match("/^[0-9]*$/",$telP)){
		if (!preg_match("/^\+[0-9]*$/",$telP)){
			$_SESSION["error_telefono"] = "El número de teléfono solo debe contener números (a excepción del + del código de área).";
		}		
	}
	
	$revUser = "CALL checkUsername('$usuarioP')";
	$contadorUser = 0;	
	if ($mysqli->multi_query($revUser)) {
		// almacenar primer juego de resultados 
		if ($result = $mysqli->store_result()){
			while ($row = $result->fetch_array()){	
				$contadorUser = $row["id_user"];
			}
			$result->free();
		}
	}
	$mysqli->close();	
	include "conexion.php";			
	$revEmail = "CALL checkEmail('$correoP')";
	$contadorEmail = 0;
	if ($mysqli->multi_query($revEmail)) {
		// almacenar primer juego de resultados 
		if ($result = $mysqli->store_result()){
			while ($row = $result->fetch_array()){	
				$contadorEmail = $row["id_person"];
			}
			$result->free();
		}
	}
	$mysqli->close();
	
	if($contrasenaP != $confirmar_contrasenaP){
		$_SESSION["error_confirmar_contrasena"] = "Las contraseñas no coinciden.";
	}	
	
	include "conexion.php";
	if ($contadorUser != 0 && $contadorEmail != 0){
		$errorUsuario = "Nombre de usuario ya existe";
		$errorEmail = "Correo ya existente";
		$_SESSION["errorUsuario"] = $errorUsuario;
		$_SESSION["errorEmail"] = $errorEmail;
		header("location:signup.php");
	} else if ($contadorUser != 0){
		$errorUsuario = "Nombre de usuario ya existe";
		$_SESSION["errorUsuario"] = $errorUsuario;
		$_SESSION["errorEmail"] = "";
		header("location:signup.php");
	} else if ($contadorEmail != 0){
		$errorEmail = "Correo ya existente";
		$_SESSION["errorEmail"] = $errorEmail;
		$_SESSION["errorUsuario"] = "";
		header("location:signup.php");
	} else {
		if ($_SESSION["error_nombre"] == "" AND 
			$_SESSION["error_apellido1"] == "" AND 
			$_SESSION["error_apellido2"] == "" AND 
			$_SESSION["error_telefono"] == "" AND
			$_SESSION["error_confirmar_contrasena"] == ""){
			$_SESSION["registroExitoso"] = true;
			$logUser = "CALL newUser('$usuarioP','$contrasenaP', '$nombreP', '$apellido1P', '$apellido2P', '$telP', '$correoP')";
			$mysqli->query($logUser); 
			header("location:login.php");
		} else {
			header("location:signup.php");
		}
	}	
	$mysqli->close();
?>