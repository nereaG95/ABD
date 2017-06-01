<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Alta usuarios</title>
</head>
<body>
	<h1><a href="index.html"> BIBLIOTECA </h1></a>
	
	<form action='' method="post">
	<p>Nombre usuario : <input type="text" name="idUser"> </input></p>
	<p>Contraseña : <input type="password" name="pass"> </input></p>
	<p> Tipo de usuario:
	<select name="tipo">
		<option value="adulto">Adulto</option>
		<option value="infantil">Infantil</option>
	</select>
	<p><input type="submit"  value="Alta usuario" /></p>
	</form>
	
	<?php
	$db = @mysqli_connect('localhost','root','','biblioteca');
	if(isset($_POST["idUser"]) && isset($_POST["pass"]) && isset($_POST["tipo"])){
		$name = $_POST["idUser"];
		$pass = $_POST["pass"];
		$tipo = $_POST["tipo"];
		$sancion = 0;
		$sql = "INSERT INTO usuarios (idUser, pass, tipo, sanciones) VALUES ('$name', '$pass', '$tipo', '$sancion')";
		if(mysqli_query($db, $sql)){
			echo "Usuario registrado correctamente";
		}
		else{
			echo "Ese usuario ya existe";
		}
	}
	@mysqli_close($db);
	?>

</body>
</html>