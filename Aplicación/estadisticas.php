<!DOCTYPE HTML>
<?php
	session_start();
	$_SESSION["mostrarMensaje"] = false;
?>
<html>
	<head>
		<title>Encuentra Mis Chunches</title>
		<meta charset="utf-8"/>
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
				<li><a href="perdido.php">Perdido</a></li>
				<li><a href="encontrado.php">Encontrado</a></li>
				<li><a href="perfil.php">Perfil</a></li>
				<li><a href="index.php">Cerrar sesión</a></li>				
			</ul>
		</nav>
		
		<section id="one" class="wrapper style2">
			<div class="inner">
				<section>				
					<div class="inner">
						<a href="choose.php" class="button def" style="float:right;">Volver</a>
						<div align="left">
							<h2>Estadísticas <i class="icon small fa-battery-half" style="font-size:30px"></i></h2>								
						</div>						
						<div class="grid-style">							
							<div id="grafica1" style="float:center;"></div>
							<div id="grafica2" style="float:center;"></div>
							<div id="grafica3" style="float:center;"></div>
							<div id="grafica4" style="float:center;"></div>
							<div id="grafica5" style="float:center;"></div>
							<div id="grafica6" style="float:center;"></div>
						</div>
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
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<?php
			echo "<!--";
			$NPerdidos = 0;
			$NEncontrados = 0;
			$NMatch = 0;
			$NUnmatch = 0;
			$mostMatchedCategory = "";
			$mostUnmatchedCategory = "";
			$mostMatchedType = "";
			$mostUnmatchedType = "";

			$NPerdidosQuery = "CALL lostObjectsCant();";
			$NEncontradosQuery = "CALL foundObjectsCant();";
			$NMatchQuery = "CALL matchedCant();";
			$NUnmatchQuery = "CALL unmatchedCant();";
			$mostMatchedCategoryQuery = "CALL mostMatchedCategory();";
			$mostUnmatchedCategoryQuery = "CALL mostUnmatchedCategory();";
			$mostMatchedTypeQuery = "CALL mostMatchedType();";
			$mostUnmatchedTypeQuery = "CALL mostUnmatchedType();";
			
			include "conexion.php";
			if ($mysqli->multi_query($NPerdidosQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$NPerdidos = $row["lost"];
					}
					$result->free();
				}
			}
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($NEncontradosQuery)) {
			// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$NEncontrados = $row["found"];
					}
					$result->free();
				}
			}
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($NMatchQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$NMatch = $row["matched"];
					}
					$result->free();
				}
			}
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($NUnmatchQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$NUnmatch = $row["unmatched"];
					}
					$result->free();
				}
			}
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($mostMatchedCategoryQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){
						$quantity = $row["quantity"] / 2;
						$mostMatchedCategory = $mostMatchedCategory."['".$row['name'].": ', ".$quantity."]," ;
					}
					$result->free();
				}
			}	
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($mostUnmatchedCategoryQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$mostUnmatchedCategory = $mostUnmatchedCategory."['".$row['name'].": ', ".$quantity."]," ;
					}
					$result->free();
				}
			}
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($mostMatchedTypeQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$quantity = $row["quantity"] / 2;
						$mostMatchedType = $mostMatchedType."['".$row['name'].": ', ".$quantity."],";
					}
					$result->free();
				}
			}
			$mysqli->close();
			include "conexion.php";
			if ($mysqli->multi_query($mostUnmatchedTypeQuery)) {
				// almacenar primer juego de resultados 
				if ($result = $mysqli->store_result()){
					while ($row = $result->fetch_array()){	
						$mostUnmatchedType = $mostUnmatchedType."['".$row['name'].": ', ".$quantity."],";
					}
					$result->free();
				}
			}
			$mysqli->close();	
			echo "-->";
		?>
		<script type="text/javascript">
		  google.charts.load("current", {packages:["corechart"]});
		  google.charts.setOnLoadCallback(drawChart);
		  function drawChart() {
			<?php
				$slices = "0:  { color: '#000099' },
						   1:  { color: '#003399' },
						   2:  { color: '#006699' },
						   3:  { color: '#009999' },
						   4:  { color: '#00CC99' },
						   5:  { color: '#00FF99' },
						   6:  { color: '#99FF99' },
						   7:  { color: '#99CC99' },
						   8:  { color: '#999999' },
						   9:  { color: '#996699' },
						   10: { color: '#993399' },
						   11: { color: '#990099' },
						   12: { color: '#CC0099' },
						   13: { color: '#CC3399' },
						   14: { color: '#CC6699' },
						   15: { color: '#FF6666' },
						   16: { color: '#FF9966' },
						   17: { color: '#FFCC66' },";
				$slices2 = "0:  { color: '#000099' },
						   1:  { color: '#996699' },";
			?>		
			
			function obtenerPorcentaje(data){
				var total = 0;
				for (var i = 0; i < data.getNumberOfRows(); i++) {
					total = total + data.getValue(i, 1);    
				}

				for (var i = 0; i < data.getNumberOfRows(); i++) {
						var label = data.getValue(i, 0);
					var val = data.getValue(i, 1) ;
					var percentual = ((val / total) * 100).toFixed(1); 
					data.setFormattedValue(i, 0, label + val +' ('+ percentual + '%)');    
				}
			}
			
			var data = google.visualization.arrayToDataTable([
			  ['Condición', 'Cantidad'],
			  <?php echo $mostMatchedCategory; ?>
			]);
			
			var options = {
			  title: 'Categorías con más objetos devueltos',
			  is3D: true,
			  //legend: { position: 'top', alignment: 'start' },
			  slices: { <?php echo $slices; ?> }
			};			
			
			obtenerPorcentaje(data);
	
			var chart = new google.visualization.PieChart(document.getElementById('grafica1'));
			chart.draw(data, options);

			var data = google.visualization.arrayToDataTable([
			  ['Condición', 'Cantidad'],
			  <?php echo $mostUnmatchedCategory; ?>
			]);

			var options = {
			  title: 'Categorías con más objetos aún perdidos',
			  is3D: true,
			  //legend: { position: 'top', alignment: 'start' },
			  slices: { <?php echo $slices; ?> }
			};			
			
			obtenerPorcentaje(data);
			
			var chart = new google.visualization.PieChart(document.getElementById('grafica2'));
			chart.draw(data, options);
			
			var data = google.visualization.arrayToDataTable([
			  ['Condición', 'Cantidad'],
			  <?php echo $mostMatchedType; ?>
			]);

			var options = {
			  title: 'Tipos con más objetos devueltos',
			  is3D: true,
			  //legend: { position: 'top', alignment: 'start' },
			  slices: { <?php echo $slices; ?> }
			};			
			
			obtenerPorcentaje(data);
			
			var chart = new google.visualization.PieChart(document.getElementById('grafica3'));
			chart.draw(data, options);

			var data = google.visualization.arrayToDataTable([
			  ['Condición', 'Cantidad'],
			  <?php echo $mostUnmatchedType; ?>
			]);

			var options = {
			  title: 'Tipos con más objetos aún perdidos',
			  is3D: true,
			  //legend: { position: 'top', alignment: 'start' },
			  slices: { <?php echo $slices; ?> }
			};			
			
			obtenerPorcentaje(data);
			
			var chart = new google.visualization.PieChart(document.getElementById('grafica4'));
			chart.draw(data, options);
			
			var data = google.visualization.arrayToDataTable([
			  ['Condición', 'Cantidad'],
			  ['Perdidos: ', <?php echo $NPerdidos?>],
			  ['Encontrados: ',  <?php echo $NEncontrados?>]
			]);

			var options = {
			  title: 'Cantidad de objetos perdidos / encontrados',
			  is3D: true,
			  //legend: { position: 'top', alignment: 'start' },
			  slices: { <?php echo $slices2; ?> }
			};

			obtenerPorcentaje(data);
			
			var chart = new google.visualization.PieChart(document.getElementById('grafica5'));
			chart.draw(data, options);
			
			var data = google.visualization.arrayToDataTable([
			  ['Condición', 'Cantidad'],
			  ['Devueltos: ', <?php echo $NMatch?>],
			  ['Aún perdidos: ', <?php echo $NUnmatch?>]
			]);

			var options = {
			  title: 'Cantidad de objetos devueltos / perdidos',
			  is3D: true,
			  //legend: { position: 'top', alignment: 'start' },
			  slices: { <?php echo $slices2; ?> }
			};			
			
			obtenerPorcentaje(data);
			
			var chart = new google.visualization.PieChart(document.getElementById('grafica6'));
			chart.draw(data, options);
		  }
		</script>
	</body>
</html>