<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Prestamo libros</title>
</head>
<body>
 <?php
	$db = @mysqli_connect('localhost','root','','biblioteca'); ?>
	<h1><a href="index.html"> BIBLIOTECA </h1></a>
	
	<form action='' method="post">
	<p>Nombre usuario: 
	<?php
		$sql = "SELECT * FROM usuarios";
		$consul= mysqli_query($db, $sql);
		if(mysqli_num_rows($consul)==0){
			echo "<p>No puedes hacer un prestamo</p>";
		}
		else{
			echo "<select name='usuario' id='usuario'>";
			while ($resultado=mysqli_fetch_array($consul)){
				$valor = $resultado['idUser'];
				echo "<option value='".$resultado['idUser']."'>". $valor."</option>";
			}
			echo "</select></p>";
			
		}
	?>
	<p>Libro:
	<?php
		$sql2 = "SELECT * FROM libros";
		$consul2= mysqli_query($db, $sql2);
		if(mysqli_num_rows($consul2)==0){
			echo "<p>No puedes hacer un prestamo</p>";
		}
		else{
			echo "<select name='libro' id='libro'>";
			while ($resultado2=mysqli_fetch_array($consul2)){
				$valor = $resultado2['titulo'];
				$unidades = $resultado2['unidades'];
				echo "<option value='".$resultado2['idLibro']."'>". $valor."</option>";
			}
			echo "</select></p>";
		}
	?>
	
	<p>Fecha devolución : <input type="date" name="fechaDevolucion"> </input></p>
	<p><input type="submit"  value="Prestamo libros" /></p>
	</form>
	
	<?php
	$db = @mysqli_connect('localhost','root','','biblioteca');
	if(isset($_POST["usuario"]) && isset($_POST["libro"]) && isset($_POST["fechaDevolucion"])){
		$usuario = $_POST["usuario"];
		$libro = $_POST["libro"];
		$fecha = $_POST["fechaDevolucion"];
		$insertar = false;
		
		$sql = "SELECT tipo FROM usuarios WHERE idUser='$usuario'";
		$consul= mysqli_query($db, $sql2);
		if(mysqli_num_rows($consul2) > 0){
			$resultado2=mysqli_fetch_array($consul2);
			$tipo1 = $resultado2['tipo'];
			$sql2= "SELECT * FROM libros WHERE titulo='$libro'";
			$resultado2=mysqli_fetch_array($consul2);
			$tipo2 = $resultado2['publico'];
			
			if(($tipo1 == $tipo2) || ($tipo2="todos")){
				$insertar = true;
			}
		}
		
		if($insertar == true){
			$sql = "INSERT INTO usuarioslibros (idLibro, idUser, fechaEntrega, fechaDevolucion) VALUES ('$libro', '$usuario', CURRENT_TIMESTAMP, '$fecha')";
			if(mysqli_query($db, $sql)){
				$unidades = $unidades-1;
				$sql2 = " UPDATE libros SET unidades='$unidades' WHERE idLibro='$libro'";
				mysqli_query($db, $sql2);
				echo "Libro prestado correctamente";
			}
			else {
				"No puedes volber a coger ese libro";
			}
		}
	}
	@mysqli_close($db);
	?>

</body>
</html>