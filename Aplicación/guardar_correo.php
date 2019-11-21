<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;

	include "conexion.php";
	$correoIngresado = $_POST["correo"];
	if ($correoIngresado != $_SESSION["correo"]){
		$revEmail = "CALL checkEmail('$correoIngresado')";
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
		include "conexion.php";
		if ($contadorEmail == 0){
			$id_user = $_SESSION["id_usuario"];
			$changeEmail = "CALL changeEmail('$id_user', '$correoIngresado')";
			$mysqli->query($changeEmail); 
			$mysqli->close();
			$_SESSION["cambioCorreo"] = true;
		} else {
			$errorEmail = "Correo ya existente";
			$_SESSION["error_correo"] = $errorEmail;
		}
	} else {
		$_SESSION["cambioCorreo"] = false;
	}
	header("location:perfil.php");
?>