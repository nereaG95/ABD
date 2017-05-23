<?php
	//Nos conectamos a la base de datos;
	$db = @mysqli_connect('localhost','root','','mensajeriaweb');
	session_start();  
	
	$usuario = $_POST["name"];
	$contra = $_POST["pass"];
	$sql="SELECT esAdmin, password FROM usuarios WHERE idUser='$usuario'";
	$consulta=mysqli_query($db, $sql);
	$filas = mysqli_fetch_array($consulta);
	//El usuario ha entrado
	if (mysqli_num_rows($consulta)!=0){
		if(password_verify($contra, $filas['password'])){
			//Inicio de sesion               
			$_SESSION['login'] = true;
			$_SESSION['idUser'] = $usuario;
			if($filas['esAdmin']){
				$datos = "Admin";
				$_SESSION['admin'] = true;
				echo '1';
			}
			else{
				$datos = "Usuario";
				$_SESSION['admin'] = false;
				echo '2';
			}
		}
		else{
			echo 'false';
		}
	}else{
		echo 'false';
	}
	@mysqli_close($db); //Cerramos la base de datos
?>