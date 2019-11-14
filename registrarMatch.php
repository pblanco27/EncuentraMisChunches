<?php
	session_start();	
	$_SESSION["match"] = true;	
	$_SESSION["mostrarMensaje"] = true;
	
	$latitud = $_SESSION["latitudForm"];
	$longitud = $_SESSION["longitudForm"];
	$descripcion = $_SESSION["description"];
	$id_categoria = $_SESSION["categoriaenc"];
	$id_tipo = $_SESSION["tipoenc"];
	$fecha = $_SESSION["fechaEncontrado"];
	$id_color = $_SESSION["colorenc"];
	$imagen = $_SESSION["imagen"];
	$id_zona = $_SESSION["zona"];	
	//Id del objeto con el que se hizo match
	
	$id_objeto = $_SESSION["id_objeto"];
	$id_usuario = $_SESSION["id_usuario"];
	$id_user_report= $_SESSION["id_user_report"];

	include "conexion.php";	
	
	$cambiarEstado = "CALL changeState($id_objeto)";
	$mysqli->query($cambiarEstado); 
	
	if ($_SESSION["perdido"]){
		$registrarObjeto = "CALL newObject($id_color, $id_zona, $id_tipo, $id_usuario, '$descripcion', 1, 0, $latitud, $longitud, '$imagen', '$fecha')";	
		$mysqli->query($registrarObjeto); 		
	} else {
		$registrarObjeto = "CALL newObject($id_color, $id_zona, $id_tipo, $id_usuario, '$descripcion', 1, 1, $latitud, $longitud, '$imagen', '$fecha')";
		$mysqli->query($registrarObjeto); 
		
		$ultimoObjeto = "CALL lastObject()";
		// Ejecutar y validar el comando SQL 
		if ($mysqli->multi_query($ultimoObjeto)) {
			// almacenar primer juego de resultados 
			if ($result = $mysqli->store_result()){											
				while($row = $result->fetch_array()){
					$id_objeto = $row["id_object"];
				}								
				$result->free();
			}
		}							
		$mysqli->close();
		include "conexion.php";	
	}
	
	$registrarNotificacion = "CALL newNotification($id_user_report,$id_usuario,$id_objeto)";	
	$mysqli->query($registrarNotificacion); 
	
	header("location:perfil.php");		
?>
