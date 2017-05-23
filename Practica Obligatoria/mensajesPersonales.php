<!--Author: Nerea G?mez Dom?nguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mensajes personales</title>
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
			$tipo = "personal";
			if($tipo2!= null && $tipo2 == "recibido"){
				$sql="SELECT mensaje,emisor, fecha FROM mensajes WHERE (receptor='$usuario' AND tipo='$tipo') ORDER BY fecha DESC";
				$consulta=mysqli_query($db, $sql);
					echo "<p><h3>Mensajes personales que te han enviado:</h3></p>";
					if(mysqli_num_rows($consulta)>0){
						while ($lib=mysqli_fetch_array($consulta)){
							echo "<div class='cajaMensajes'>";
							echo "<div class='mensaje'> Fecha :" .$lib['fecha'] ."</div>";
							echo "<p>-Remitente : " .$lib['emisor'] ."</p>";
							echo "<p>-Mensaje: " .$lib['mensaje'] ."</p>";
							echo "</div>";
						};
					}
					else {
						echo " No has recibido ningun mensaje personal ";
					}
					
			}
			else{
				$sql2="SELECT mensaje,receptor, fecha FROM mensajes WHERE (emisor='$usuario' AND tipo='$tipo') ORDER BY fecha DESC";
				$consulta2=mysqli_query($db, $sql2);
				echo "<p><h3>Mensajes personales que has enviado:</h3></p>";
					if(mysqli_num_rows($consulta2)!=0){
						$i=1;
						while ($lib=mysqli_fetch_array($consulta2)){
							echo "<div class='cajaMensajes'>";
							echo "<div class='mensaje'> Fecha :" .$lib['fecha'] ."</div>";
							echo " Mensaje nº " .$i ." : </p>";
							echo "<p>-Destinatario : " .$lib['receptor'] ."</p>";
							echo "<p>-Mensaje: " .$lib['mensaje'] ."</p>";
							echo "</div>";
							$i++;
						};
					}
					else{
						echo " No has enviado ningun mensaje personal ";
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