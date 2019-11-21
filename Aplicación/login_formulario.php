<?php
	session_start();
	include "conexion.php";	
	
	$usuarioDatos = "CALL getUser('".$_POST["usuario"]."','".$_POST["clave"]."');";
	$contador = 0;														
	// Ejecutar y validar el comando SQL 
	if ($mysqli->multi_query($usuarioDatos)) {
		// almacenar primer juego de resultados 
		if ($result = $mysqli->store_result()){
			while ($row = $result->fetch_array()){
				$_SESSION["id_usuario"] = $row["id_user"];
				$_SESSION["user"] = $row["username"];
				$_SESSION["pass"] = $row["password"];
				$contador = 1;	
			}	
			$result->free();
		}
	}	
	
	if($contador == 1){
		if ($_SESSION["id_usuario"] == 0){
			header ("location:superusuario.php");
		} else {
			header ("location:choose.php");
		}			
	} else {
		$_SESSION["loginError"] = "Credenciales incorrectas. Por favor intente de nuevo.";
		header ("location:login.php");
	}	
?>