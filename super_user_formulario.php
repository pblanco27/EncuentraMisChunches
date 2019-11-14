<?php
	session_start();
	if ($_POST["latitude"] != ""){
		$nombre = $_POST["nombre"];
		$latitud = $_POST["latitude"];
		$longitud = $_POST["longitude"];
		include "conexion.php";
		$usuarioDatos = "CALL newZone('".$nombre."',".$latitud.",".$longitud.");";
		$mysqli->multi_query($usuarioDatos);
		$_SESSION["confirmarNuevaZona"] = true;
	} else {
		$_SESSION["confirmarNuevaZona"] = false;
	}
	header ("location:superusuario.php");		
?>