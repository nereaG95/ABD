<!--Author: Nerea Gómez Domínguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mensajes comunes</title>
</head>

<body>

<div id="contenedor">
	<?php
		$db = @mysqli_connect('localhost','root','','mensajeriaweb');
		session_start();   
		require ("comun.php");
	?>
	
	<div id="contenido">
		<?php 
		if (isset($_SESSION['login']) && $_SESSION['login']) {
			$tipo2 = $_GET['tipo'];
			$usuario = $_SESSION['idUser'];
			$tipo = "comun";
			if($tipo2!= null && $tipo2 == "recibido"){
				$sql="SELECT mensaje,emisor, fecha FROM mensajes WHERE (emisor <>'$usuario') AND (tipo='$tipo') ORDER BY fecha DESC";
				$consulta=mysqli_query($db, $sql);
				if($consulta !=FALSE){
					echo "<p><h2>Mensajes comunes que has recibido:</h2></p>";
					$i=1;
					while ($lib=mysqli_fetch_array($consulta)){
						echo "<div class='cajaMensajes'>";
						echo "<label>Enviado por : " .$lib['emisor'] ."</label>";
						echo "<div class='mensaje'> Fecha :" .$lib['fecha'] ."</div>";
						echo "<p>Mensaje " .$i .": " .$lib['mensaje'] ."</p>";
						echo "</div>";
						$i++;
					};
					if( $i == 1){
						echo "No has recibido ningun mensaje común";
					}
				}
			}
			else{
				$sql="SELECT mensaje, fecha FROM mensajes WHERE (emisor='$usuario') AND (tipo='$tipo') ORDER BY fecha DESC";
				$consulta=mysqli_query($db, $sql);
				if($consulta !=FALSE){
					echo "<p><h3>Mensajes que has enviado a todos los usuarios:</h3></p>";
					$i=1;
					while ($lib=mysqli_fetch_array($consulta)){
						echo "<div class='cajaMensajes'>";
						echo "<div class='mensaje'> Fecha :" .$lib['fecha'] ."</div>";
						echo "<p>-Mensaje nº " .$i ." : " .$lib['mensaje'] ."</p>";
						echo "</div>";
						$i++;
					};
					if( $i == 1){
						echo "No has enviado ningun mensaje común";
					}
			}
			}
		}
		?>
	</div>

	<?php  
		require ("pie.php");
	?>

</div> <!-- Fin del contenedor -->

</body>
</html>