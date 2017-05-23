<?php
	//Nos conectamos a la base de datos;
	$db = @mysqli_connect('localhost','root','','mensajeriaweb');
	
	$usuario = $_POST["name"];
	$contra = $_POST["pass"];
	$edad = $_POST["edad"];
	$admin = 0;
	$categorias = json_decode($_POST["categorias"], true);
	$pass  = password_hash ($contra, PASSWORD_DEFAULT);
	$sql="INSERT INTO usuarios (idUser, password, edad, esAdmin) VALUES ('$usuario', '$pass', '$edad', '$admin')";
	if (mysqli_query($db, $sql)) {
		//El usuario ha entrado
		//Inicio de sesion
		session_start();               
		$_SESSION['login'] = true;
		$_SESSION['idUser'] = $usuario;
		$_SESSION['admin'] = false;
		
		for ($i=0;$i<count($categorias);$i++){     
			$tipoMusica = $categorias[$i];
			//Rellenamos la tablas tipo musica usuario
			$sql2="INSERT INTO tipomusicausuarios (idUser, tipoMusica) VALUES ('$usuario', '$tipoMusica')";
			mysqli_query($db, $sql2);
			$sql3 = "SELECT idGrupo FROM grupos WHERE (edadMin>='$edad' AND edadMax<='$edad') AND (tipoMusica = '$tipoMusica')";
			$result = mysqli_query($db, $sql3);
			while ($row = mysqli_fetch_assoc($result)) {
				$grupo = $row["idGrupo"];
				//Rellenamos la tabla grupo usuarios
				$sql4="INSERT INTO gruposusuario (idGrupo, idUser) VALUES ('$grupo', '$usuario')";
				mysqli_query($db, $sql4);
			}
		}
		echo "1";
	}
	else{
		echo "false";
	}
	@mysqli_close($db); //Cerramos la base de datos 
?>