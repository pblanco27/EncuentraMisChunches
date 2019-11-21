<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;

	include "conexion.php";
	$_SESSION["error_telefono"] = "";
	$telefonoIngresado = $_POST["telefono"];
	if ($telefonoIngresado != $_SESSION["telefono"]){
		if(!preg_match("/^[0-9]*$/",$telefonoIngresado)){
			if (!preg_match("/^\+[0-9]*$/",$telefonoIngresado)){
				$_SESSION["error_telefono"] = "El teléfono solo debe contener números (admite + del código de área).";
			}		
		}
		if ($_SESSION["error_telefono"] == ""){
			$id_user = $_SESSION["id_usuario"];
			$changeTelephone = "CALL changeTelephone('$id_user', '$telefonoIngresado')";
			$mysqli->query($changeTelephone); 
			$mysqli->close();
			$_SESSION["cambioTelefono"] = true;
		}
	} else {
		$_SESSION["cambioTelefono"] = false;
	}
	header("location:perfil.php");
?>