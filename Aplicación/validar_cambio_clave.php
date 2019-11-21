<?php 
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] == ""){
		header("location:index.php");
	}
	$_SESSION["confirmarClaveError"] = "";
	$_SESSION["validarClaveError"] = "";
	
	$id_user = $_SESSION["id_usuario"];
	$clave_actual = $_POST["clave_actual"];	
	$nueva_clave = $_POST["nueva_clave"];
	$clave_confirmacion = $_POST["clave_confirmacion"];

	include "conexion.php";	
	$validarClaveQuery = "CALL validatePassword($id_user, '$clave_actual')";	
	
	$estaVacio = true;
	// Ejecutar y validar el comando SQL 
	if ($mysqli->multi_query($validarClaveQuery)) {
		// almacenar primer juego de resultados 
		if ($result = $mysqli->store_result()){											
			while($row = $result->fetch_array()){
				$estaVacio = false;			
			}								
			$result->free();
		}
	}							
	$mysqli->close();
	
	if ($estaVacio){
		$_SESSION["validarClaveError"] = "La contraseña ingresada no coincide con la del usuario activo.";
		header("location:cambio_clave.php");
	}
	if ($nueva_clave != $clave_confirmacion){
		$_SESSION["confirmarClaveError"] = "Las contraseñas no coinciden.";
		header("location:cambio_clave.php");
	}
	if (!$estaVacio && $nueva_clave == $clave_confirmacion){
		include "conexion.php";	
		$cambiarClaveQuery = "CALL changePassword($id_user,'$nueva_clave')";			
		$mysqli->query($cambiarClaveQuery);										
		$mysqli->close();			
		$_SESSION["cambioClave"] = true;
		header("location:perfil.php");	
	}
?>