<?php 
	session_start();
	$_SESSION["perdido"] = true;	
	$_SESSION["match"] = false;
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] == ""){
		header("location:index.php");
	}
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		if ($_POST["latitude"] != ""){
			$latitud = $_POST["latitude"];
			$longitud = $_POST["longitude"];
			$_SESSION["latitudForm"] = $_POST["latitude"];
			$_SESSION["longitudForm"] = $_POST["longitude"];
		} else {
			$latitud = $_SESSION["latitude"];
			$longitud = $_SESSION["longitude"];
			$_SESSION["latitudForm"] = $_SESSION["latitude"];			
			$_SESSION["longitudForm"] = $_SESSION["longitude"];
		}
		
		$descripcion = $_SESSION["description"];
		$id_categoria = $_SESSION["categoriaenc"];
		$id_tipo = $_SESSION["tipoenc"];
		$fecha = $_SESSION["fechaEncontrado"];
		$id_color = $_SESSION["colorenc"];
		$imagen = $_SESSION["imagen"];
		$id_zona = $_SESSION["zona"];		
		$id_usuario = $_SESSION["id_usuario"];
		
		include "conexion.php";	
		$matchEncontrado = "CALL matchPerdido($id_color, $id_zona, $id_tipo)";
																
		$resultado = "";
		// Ejecutar y validar el comando SQL 
		if ($mysqli->multi_query($matchEncontrado)) {
			// almacenar primer juego de resultados 
			if ($result = $mysqli->store_result()){
				while ($row = $result->fetch_array()){
					$resultado = $resultado."<tr><form method='post' action='vermas_resultado.php' enctype='multipart/form-data'>".											
											"<td>".$row['description']."</td>".										
											"<input type='hidden' name='id_objeto' value='".$row['id_object']."'>".
											"<input type='hidden' name='id_user_report' value='".$row['id_user']."'>".
											"<td><input type='submit' name='submit' value='Ver más'></td>".
											"</form></tr>";
				}
				$result->free();
			}
		}
		
		$mysqli->close();
		include "conexion.php";	
		
		if ($resultado == ""){
			$registrarObjeto = "CALL newObject($id_color, $id_zona, $id_tipo, $id_usuario, '$descripcion', 0, 0, $latitud, $longitud, '$imagen', '$fecha')";
			$mysqli->query($registrarObjeto); 		
			$_SESSION["mostrarMensaje"] = true;
			header("location:perfil.php");				
		} else {			
			$_SESSION["resultado"] = $resultado;			
			header("location:verobj.php");
		} 
	}
?>