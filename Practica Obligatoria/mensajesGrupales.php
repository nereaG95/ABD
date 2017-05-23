<!--Author: Nerea Gómez Domínguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Mensajes grupales</title>
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
			$usuario = $_SESSION['idUser'];
			$tipo = "grupo";
			$sql = "SELECT idGrupo FROM gruposusuario WHERE idUser='$usuario'";
			$consulta=mysqli_query($db, $sql);
			echo "<p><h2>Mensajes grupales:</h2></p>";
			if(mysqli_num_rows($consulta)!=0){
				while ($lib=mysqli_fetch_array($consulta)){
						$grupo = $lib['idGrupo'];
						$tipo = "grupo";
						$sql2 = "SELECT mensaje, emisor, fecha FROM mensajes WHERE ((tipo='$tipo') AND (grupo='$grupo')) ORDER BY fecha ASC";
						$consulta2=mysqli_query($db, $sql2);
						$i=0;
						$sql3 = "SELECT nombreGrupo FROM grupos WHERE idGrupo='$grupo'";
						$consulta3 = mysqli_query($db, $sql3);
						$lib3 = mysqli_fetch_array($consulta3);
						if(mysqli_num_rows($consulta2)!=0){
							echo "<div class='cajaGruposPertenece'>";
							echo "Grupo :" .$lib3['nombreGrupo'];
							while ($lib2=mysqli_fetch_array($consulta2)){
								echo "<p><div class='mensaje'>Fecha :" .$lib2['fecha'] ."</p></div>";
								echo "<p><div class ='sms'>" .$lib2['emisor'] .":</p> ".$lib2['mensaje'] ."</div>";
								echo "<hr width='50%' />";
							};
							echo "</div>";
							$i++;
						}
						
				}
				
			}
			else{
					echo "Todavia no has recibido ni enviado mensajes grupales porque no perteneces a ningun grupo";
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