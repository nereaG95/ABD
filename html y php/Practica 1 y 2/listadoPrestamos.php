<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Listado de prestamos</title>
</head>
<body>
 <?php
	$db = @mysqli_connect('localhost','root','','biblioteca'); ?>
	<h1><a href="index.html"> BIBLIOTECA </h1></a>
	<?php
		//sacamos primero los usuarios
		$sql = "SELECT * FROM usuarios";
		$consul= mysqli_query($db, $sql);
		if(mysqli_num_rows($consul)>0){
			while ($resultado=mysqli_fetch_array($consul)){
				$usuario = $resultado['idUser'];
				$sql2 = "SELECT * FROM usuarioslibros WHERE idUser='$usuario' ORDER BY fechaEntrega ASC";
				$consul2= mysqli_query($db, $sql2);
				$i=0;
				$filas = mysqli_num_rows($consul2);
				if( $filas > 0){
					echo "<p>Usuario : " .$usuario."</p>";
					while (($resultado2=mysqli_fetch_array($consul2)) && $i<10){
						$idLibro = $resultado2['idLibro'];
						$sql3 = "SELECT * FROM libros WHERE idLibro='$idLibro'";
						$consul3= mysqli_query($db, $sql3);
						$resultado3=mysqli_fetch_array($consul3);
						$libro = $resultado3['titulo'];
						$fechaDevolucion = $resultado2['fechaDevolucion'];
						echo "<p> Libro :".$libro."</p>";
						echo "<p> FechaDevolución: " .$fechaDevolucion ."</p>";
						
						$i++;
					}
					echo "<hr></hr>";
				}
			}
			
		}
	@mysqli_close($db);
	?>

</body>
</html>