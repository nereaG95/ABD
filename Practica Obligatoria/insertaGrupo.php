<?php
		//Nos conectamos a la base de datos;
	$db = @mysqli_connect('localhost','root','','mensajeriaweb');
	
	$nombre = $_POST["nombre"];
	$tipo = $_POST["tipo"];
	$edadMin = $_POST["edadMin"];
	$edadMax = $_POST["edadMax"];

	$sql="INSERT INTO grupos (nombreGrupo, tipoMusica, edadMin, edadMax) VALUES ('$nombre', '$tipo', '$edadMin', '$edadMax')";
	if ($result=mysqli_query($db, $sql)) {
		$grupo = mysqli_insert_id($db);
		//Buscamos usuarios con ese tipo de musica y esa edad
		$sql2= "SELECT u.idUser FROM  usuarios u, tipomusicausuarios t WHERE (u.edad >='$edadMin' AND u.edad<='$edadMax') AND ('$tipo'=t.tipoMusica) GROUP BY u.idUser";
		$result = mysqli_query($db, $sql2);
			while ($row = mysqli_fetch_assoc($result)) {
				$user = $row["idUser"];
				//Rellenamos la tabla grupo usuarios
				$sql4="INSERT INTO gruposusuario (idGrupo, idUser) VALUES ('$grupo', '$user')";
				mysqli_query($db, $sql4);
			}
		echo "true";
	}
	else{
		echo "false";
	}
	@mysqli_close($db); //Cerramos la base de datos
?>