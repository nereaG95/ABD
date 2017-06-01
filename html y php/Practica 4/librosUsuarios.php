<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Libros del usuario</title>
</head>
<body>
	<h1><a href="index.html"> BIBLIOTECA </h1></a>
<?php
	
	$db = @mysqli_connect('localhost','root','','biblioteca');

	session_start();
	
	if(isset($_SESSION['login']) && $_SESSION['login']){
		echo "Bienvenido " .$_SESSION['idUser'];
		echo "<p><a href='cerrar.php'> Cerrar sesión </a></p>";
		$idUser = $_SESSION['idUser'];
		$sql = "SELECT * FROM usuarioslibros WHERE idUser='$idUser'";
		$query = mysqli_query($db, $sql);
		$filas = mysqli_num_rows($query);
		if( $filas > 0){
			while($resultado = mysqli_fetch_array($query)){
				$idLibro = $resultado['idLibro'];
				$sql2= "SELECT * FROM libros WHERE idLibro='$idLibro'";
				$query2= mysqli_query($db, $sql2);
				while($resultado2 = mysqli_fetch_array($query2)){
					$titulo=$resultado2['titulo'];
				}
				echo "<p>Libro : " .$titulo;
				echo "<p>Fecha devolución: " .$resultado['fechaDevolucion'];
				echo "<hr></hr>";
				
			}
		
		}
		
	}
?>


</body>
</html>