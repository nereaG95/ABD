<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta libros</title>
</head>
<body>
	<h1><a href="index.html"> BIBLIOTECA </h1></a>
	
	<form action='' method="post">
	<p>Titulo : <input type="text" name="titulo"> </input></p>
	<p>autor : <input type="text" name="autor"> </input></p>
	<p>edicion : <input type="number" name="edicion"> </input></p>
	<p>Tema : <input type="text" name="tema"> </input></p>
	<p> Tipo de publico:
	<select name="tipo">
		<option value="todos">Todos</option>
		<option value="adulto">Adulto</option>
		<option value="infantil">Infantil</option>
	</select>
	<p>Unidades : <input type="number" name="unidades"> </input></p>
	<p><input type="submit"  value="Alta Libro" /></p>
	</form>
	
	<?php
	$db = @mysqli_connect('localhost','root','','biblioteca');
	if(isset($_POST["titulo"]) && isset($_POST["autor"]) && isset($_POST["edicion"]) && isset($_POST["unidades"])  && isset($_POST["tema"])){
		$titulo = $_POST["titulo"];
		$autor = $_POST["autor"];
		$edicion = $_POST["edicion"];
		$unidades = $_POST["unidades"];
		$publico = $_POST["tipo"];
		$tema = $_POST["tema"];
		$sql = "INSERT INTO libros (titulo, autor, edicion, tema, publico, unidades) VALUES ('$titulo', '$autor', '$edicion', '$tema', '$publico', '$unidades')";
		if(mysqli_query($db, $sql)){
			echo "Libro registrado correctamente";
		}
		else{
			echo "Este libro ya existe";
		}
	}
	@mysqli_close($db);
	?>

</body>
</html>