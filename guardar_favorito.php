<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;

	include "conexion.php";
			
	$id_zone = $_SESSION["id_zone"];
	$selected_id_zone = $_POST["zona"];
	if ($id_zone != $selected_id_zone){
		$id_user = $_SESSION["id_usuario"];
		$changeFavZone = "CALL changeFavZone('$id_user', '$selected_id_zone')";
		$mysqli->query($changeFavZone); 
		$mysqli->close();
		$_SESSION["cambioFavZone"] = true;
	} else {
		$_SESSION["cambioFavZone"] = false;
	}
	header("location:perfil.php");
?>