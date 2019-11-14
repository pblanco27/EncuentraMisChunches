<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
	if ($_SESSION["id_usuario"] == ""){
		header("location:index.php");
	}
?>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8"/> 		
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<?php
			header('Content-Type: text/html; charset=UTF-8'); 
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	
	<body class="subpage">
		<!-- Header -->
		<header id="header" >
			<div class="logo"><a href="choose.php"><img src="images/logo-mini.png" height="100%"></a></div>
			<a href="#menu" class="toggle"><span>Menu</span></a>
		</header>

		<!-- Nav -->
		<nav id="menu">
			<ul class="links">
				<li><a href="encontrado.php">Encontrado</a></li>
				<li><a href="estadisticas.php">Estadisticas</a></li>
				<li><a href="perfil.php">Perfil</a></li>
				<li><a href="index.php">Cerrar sesión</a></li>
			</ul>
		</nav>

		<!-- One -->
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>
					<div class="inner">					
						<a href="choose.php" class="button def" style="float:right">Volver</a>
						<div align="left">
							<h2>Reportar objeto perdido <i class="icon small fa-compass" style="font-size:30px"></i></h2>								
						</div>
						
						<form method="post" id="demoForm" action="mapa_perdido.php" enctype="multipart/form-data">
						<div class="grid-style">							
							<div>							
								<b style="color:MediumSeaGreen">
									Descripción: (lo más detallada posible)
									<textarea name="description" id="description" rows="6" placeholder="Escriba la descripción" style="resize: none;" maxlength="225" onkeyup="this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9,.;:¿?¡!()+-]/g, '')" required></textarea>
									<br>
									Categoría:
									<select id="categoriaenc" name='category' required>
										<option value="">Seleccione una categoría</option>
										<?php
											include "conexion.php";
											
											$categorias = "CALL getCategorias();";
											$listaCategorias = "";
																									
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($categorias)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){
													while ($row = $result->fetch_array()){	
														$listaCategorias = $listaCategorias."<option value='".$row["id_category"]."'>".$row["name"]."</option>";
													}
													$result->free();
												}
											}												
											echo $listaCategorias;
										?>
									</select>
									<br>
									Tipo:
									<select name="choices[]" id="choices" required>
										<option value="">Seleccione un tipo</option>
										<!-- Esto lo rellena JS-->
									</select>
									<br>
								</b>
							</div>

							<div>
								<b style="color:MediumSeaGreen">
									Fecha de cuando se extravió el objeto:<br>	
									<input type='date' style="background: rgba(144, 144, 144, 0.075);" name='fechaEncontrado' max='<?php echo date('Y-m-d'); ?>' value='<?php echo date("Y-m-d");?>' required>
									<font style="color:Red"><?php echo $fechaEncError;?></font>									
									<br><br><br>
									
									Color:									
									<select id="colorenc" name='colorenc' required>
										<option value="">Seleccione un color</option>
										<?php
											include "conexion.php";
											
											$colores = "CALL getColores();";
											$listaColores = "";
																									
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($colores)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){
													while ($row = $result->fetch_array()){	
														$listaColores = $listaColores."<option value='".$row["id_color"]."'>".$row["name"]."</option>";
													}
													$result->free();
												}
											}												
											echo $listaColores;
										?>
									</select>									
									<br><br>
									
									Ingresa una imagen:<br>
									<input name="imagen" type="file" accept=".jpg, .jpeg, .png"/>
									<br><br><br>
									
									Punto de referencia:									
									<select id="zona" name='zona' required>
										<option value="">Seleccione una zona</option>
										<?php
											include "conexion.php";
											$id_usuario = $_SESSION["id_usuario"];
											
											$infoUsuario = "CALL personStats($id_usuario);";
																									
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($infoUsuario)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){
													while ($row = $result->fetch_array()){
														$id_zone = $row["id_zone"];
													}
													$result->free();
												}
											}
											$mysqli->close();
											
											include "conexion.php";
											$zonas = "CALL getZonas();";
											$listaZonas = "";
																									
											// Ejecutar y validar el comando SQL 
											if ($mysqli->multi_query($zonas)) {
												// almacenar primer juego de resultados 
												if ($result = $mysqli->store_result()){
													while ($row = $result->fetch_array()){	
														if ($row["id_zone"] == $id_zone){
															$listaZonas = $listaZonas."<option value=".$row["id_zone"]." selected>".$row["name"]."</option>";
														} else {
															$listaZonas = $listaZonas."<option value=".$row["id_zone"].">".$row["name"]."</option>";
														}
													}
													$result->free();
												}
											}												
											echo $listaZonas;
										?>
									</select>
								</b>
							</div>														
						</div>
						<div align="center">							
							<div class="row 200%">
								<div class="12u 12u$(medium)">
									<input type = 'submit' value = "Siguiente"/>
								</div>
							</div>
						</div>
						</form>
					</div>						
				</section>
			</div>
		</section>
		
		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>
		<script type="text/javascript">
			/*
			From JavaScript and Forms Tutorial at dyn-web.com
			Find information and updates at http://www.dyn-web.com/tutorials/forms/
			*/

			// removes all option elements in select list 
			// removeGrp (optional) boolean to remove optgroups
			function removeAllOptions(sel, removeGrp) {
				var len, groups, par;
				if (removeGrp) {
					groups = sel.getElementsByTagName('optgroup');
					len = groups.length;
					for (var i=len; i; i--) {
						sel.removeChild( groups[i-1] );
					}
				}
				
				len = sel.options.length;
				for (var i=len; i; i--) {
					par = sel.options[i-1].parentNode;
					par.removeChild( sel.options[i-1] );
				}
			}

			function appendDataToSelect(sel, obj) {
				var f = document.createDocumentFragment();
				var labels = [], group, opts;
				
				function addOptions(obj) {
					var f = document.createDocumentFragment();
					var o;
					
					for (var i=0, len=obj.text.length; i<len; i++) {
						o = document.createElement('option');
						o.appendChild( document.createTextNode( obj.text[i] ) );
						
						if ( obj.value ) {
							o.value = obj.value[i];
						}
						
						f.appendChild(o);
					}
					return f;
				}
				
				if ( obj.text ) {
					opts = addOptions(obj);
					f.appendChild(opts);
				} else {
					for ( var prop in obj ) {
						if ( obj.hasOwnProperty(prop) ) {
							labels.push(prop);
						}
					}
					
					for (var i=0, len=labels.length; i<len; i++) {
						group = document.createElement('optgroup');
						group.label = labels[i];
						f.appendChild(group);
						opts = addOptions(obj[ labels[i] ] );
						group.appendChild(opts);
					}
				}
				sel.appendChild(f);
			}

			// anonymous function assigned to onchange event of controlling select list
			document.forms['demoForm'].elements['category'].onchange = function(e) {
				// name of associated select list
				var relName = 'choices[]';
				
				// reference to associated select list 
				var relList = this.form.elements[ relName ];
				
				// get data from object literal based on selection in controlling select list (this.value)
				var obj = Select_List_Data[ relName ][ this.value ];
				
				// remove current option elements
				removeAllOptions(relList, true);
				
				// call function to add optgroup/option elements
				// pass reference to associated select list and data for new options
				appendDataToSelect(relList, obj);
			};

			// object literal holds data for optgroup/option elements
			var Select_List_Data = {
				
				// name of associated select list
				'choices[]': {
					
					// names match option values in controlling select list
					<?php
						
						$listaTipos = "";
						$listaValues = "";
						
						include "conexion.php";						
						$cantidadQuery = "CALL categoryNumber();";
																				
						// Ejecutar y validar el comando SQL 
						if ($mysqli->multi_query($cantidadQuery)) {
							// almacenar primer juego de resultados 
							if ($result = $mysqli->store_result()){
								while ($row = $result->fetch_array()){
									$cantidad = $row["quantity"];
								}
								$result->free();
							}
						}
						$mysqli->close();
						
						for ($contador = 1; $contador < $cantidad + 1; $contador++){
							echo $contador.": {";		
							
							include "conexion.php";							
							$tipos1 = "CALL getTipos(".$contador.");";
							
							// Ejecutar y validar el comando SQL 
							if ($mysqli->multi_query($tipos1)) {
								// almacenar primer juego de resultados 
								if ($result = $mysqli->store_result()){
									$listaTipos = "text: [";
									$listaValues = "value: [";
									while ($row = $result->fetch_array()){	
										$listaTipos .= "'".$row["name"]."',";
										$listaValues .= "'".$row["id_type"]."',";
									}  
									$listaTipos = trim($listaTipos, ',');
									$listaValues = trim($listaValues, ',');
									$listaTipos .= "],";
									$listaValues .= "]";
									
									$result->free();
								}
							}			
							if ($contador == $cantidad){
								echo $listaTipos.$listaValues."}";
							} else {
								echo $listaTipos.$listaValues."},";
							}							
							$mysqli->close();							
						}
					?>
				}    
			};

			// populate associated select list when page loads
			window.onload = function() {
				var form = document.forms['demoForm'];
				
				// reference to controlling select list
				var sel = form.elements['category'];
				sel.selectedIndex = 0;
				
				// name of associated select list
				var relName = 'choices[]';
				// reference to associated select list
				var rel = form.elements[ relName ];
				
				// get data for associated select list passing its name
				// and value of selected in controlling select list
				var data = Select_List_Data[ relName ][ sel.value ];
				
				// add options to associated select list
				appendDataToSelect(rel, data);
			};
		</script>
	</body>
</html>