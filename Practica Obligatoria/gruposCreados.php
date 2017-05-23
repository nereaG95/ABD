<!--Author: Nerea Gómez Domínguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Grupos creados</title>
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
		if (isset($_SESSION['login']) && $_SESSION['login'] && isset($_SESSION['admin']) && $_SESSION['admin']) {
			$sql="SELECT * FROM grupos";
			$consulta=mysqli_query($db, $sql);
			if($consulta !=FALSE){
				echo "<p><h2>Grupos existentes:</h2></p>";
				while ($lib=mysqli_fetch_array($consulta)){
					$id = $lib['idGrupo'];
					$sql2="SELECT count(idUser) as total FROM gruposusuario WHERE idGrupo='$id'";
					$consul = mysqli_query($db, $sql2);
					$data=mysqli_fetch_assoc($consul);
					echo "<div class='cajaMensajes'>";
					echo "<p>Nombre del grupo : " .$lib['nombreGrupo'] ."</p>";
					echo "<p>Tipo de música : " .$lib['tipoMusica'] ."</p>";
					echo "<p>Rango de edades: " .$lib['edadMin'] ." - " .$lib['edadMax'] ."</p>";
					echo "<p>Numero de integrantes: " .$data['total']. "</p>";
					echo "</div>";
				};
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