<!--Author: Nerea Gómez Domínguez-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Grupos a los que perteneces</title>
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
			$sql="SELECT idGrupo FROM gruposusuario WHERE (idUser='$usuario')";
			$consulta=mysqli_query($db, $sql);
			if($consulta !=FALSE){
				echo "<p><h3>Grupos a los que perteneces:</h3></p>";
				$i =0;
				while ($lib=mysqli_fetch_array($consulta)){
					$id = $lib['idGrupo'];
					//Numero total de integrantes
					$sql2="SELECT count(idUser) as total FROM gruposusuario WHERE idGrupo='$id'";
					$consul = mysqli_query($db, $sql2);
					$data=mysqli_fetch_assoc($consul);
					//Nombre del grupo, tipo musica, rango de edades
					$sql3="SELECT nombreGrupo, tipoMusica, edadMin, edadMax FROM grupos WHERE idGrupo='$id'";
					$consul2 = mysqli_query($db, $sql3);
					$lib2=mysqli_fetch_assoc($consul2);
					echo "<div class='cajaGrupos'>";
					echo "Nombre del grupo : " .$lib2['nombreGrupo'];
					echo "<div id='participantes'>Participantes: " .$data['total'] ."</div>";
					echo "<p> Tipo de música: " .$lib2['tipoMusica'] ."</p>";
					echo "<p> Rango de edades: " .$lib2['edadMin'] ." - " .$lib2['edadMax'] . "</p>";

					echo "</div>";
					$i++;
				};
				if($i==0){
					echo "Todavía no perteneces a ningún grupo";
				}
			}
		}
		?>
	</div>

	<div id="pie">
		Nerea Gómez Domínguez
	</div>

</div> <!-- Fin del contenedor -->

</body>
</html>