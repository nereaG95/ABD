<?php
	//Nos conectamos a la base de datos;
	session_start();
	$db = @mysqli_connect('localhost','root','','mensajeriaweb');
	
	$opcion = $_POST["opcion"];
	$mensaje = htmlspecialchars(trim(strip_tags($_POST["mensaje"])));
	
	if($opcion == "comun"){
		$sql= "INSERT INTO mensajes(mensaje, tipo, emisor, fecha) VALUES ('$mensaje', '$opcion', '$_SESSION[idUser]', CURRENT_TIMESTAMP)";
		$db->query($sql) or die($db->error);
		echo "1";
	}
	else if($opcion == "personal"){
		$receptor = $_POST["receptor"];
		$sql= "INSERT INTO mensajes (mensaje, tipo, emisor, receptor, fecha) VALUES ('$mensaje', '$opcion', '$_SESSION[idUser]', '$receptor', CURRENT_TIMESTAMP)";
		$db->query($sql) or die($db->error);
		echo "1";
	}
	else if($opcion == "grupo"){
		$idGrupo =  $_POST["grupo"];
		$sql= "INSERT INTO mensajes (mensaje, tipo, emisor, fecha, grupo ) VALUES ('$mensaje', '$opcion', '$_SESSION[idUser]', CURRENT_TIMESTAMP, '$idGrupo')";
		$db->query($sql) or die($db->error);
		echo "1";
	}
	//header('Location: index.php');
	@mysqli_close($db); //Cerramos la base de datos
?>
