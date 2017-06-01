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
		
?>
		<form action='' method="post">
<?php
		$sql = "SELECT DISTINCT tema FROM libros";
		$query = mysqli_query($db, $sql);
		$filas = mysqli_num_rows($query);
		if( $filas > 0){
			echo "Categorias : <select name='categoria'>";
			while($resultado = mysqli_fetch_array($query)){
				$categorias = $resultado['tema'];
				echo "<option value=$categorias>". $categorias."</option>";
				
			}
			echo "</select>";
		}
		
	}
?>
	<input type="submit" name="buscar" id="buscar" value="Buscar" />
	</form>
	
	<?php
		if (isset($_POST["buscar"])) {
			echo "<form action='' method='post'>";
			$categoria = $_POST['categoria'];
			$sql2= "SELECT * FROM libros WHERE unidades > 0 && tema='$categoria'";
			$query2 = mysqli_query($db, $sql2);
			$filas2 = mysqli_num_rows($query2);
			if( $filas2 > 0){
				echo "Libros : <select name='libros'>";
				while($resultado = mysqli_fetch_array($query2)){
					$titulo = $resultado['titulo'];
					$unidades = $resultado['unidades'];
					$id=$resultado['idLibro'];
					echo "<option value='".$resultado['idLibro']."'>". $titulo."</option>";
					
				}
				echo "</select>";
			}
			echo "<input type='submit' name='add' id='add' value='Añadir'/></form>";
		
		}
		
		if (isset($_POST["add"])) {
			$idLibro = $_POST['libros'];
			$fechaDevolucion = "2017-06-15";
			$sql3 = "INSERT INTO usuarioslibros (idLibro, idUser, fechaEntrega, fechaDevolucion) VALUES ('$idLibro', '$idUser', CURRENT_TIMESTAMP, '$fechaDevolucion' )";
			$query3 = mysqli_query($db, $sql3);
			if( $query3){
				$sql4 = "SELECT * FROM libros WHERE idLibro ='$idLibro'";
				$query4 = mysqli_query($db, $sql4);
				echo mysqli_error($db);
				$resultado4 = mysqli_fetch_array($query4);
				$unidades = $resultado4['unidades'] - 1;
				$sql5 = " UPDATE libros SET unidades='$unidades' WHERE idLibro='$idLibro'";
				mysqli_query($db, $sql5);
				echo "Libro prestado correctamente";
			}
			else{
				echo "no puede coger ese libro, porque ya lo tiene";
			}
		
		}
		
	
	?>

</body>
</html>