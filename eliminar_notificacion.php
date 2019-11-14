<?php
	session_start();
	
	include "conexion.php";	
	
	$deleteNotificationQuery = "CALL disableNotification('".$_SESSION["id_notification"]."');";
	$mysqli->query($deleteNotificationQuery);
	$mysqli->close();
	$_SESSION["mensajeEliminarNotificacion"] = true;
	header ("location:perfil.php");
?>