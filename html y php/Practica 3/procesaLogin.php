<?php
	$db = @mysqli_connect('localhost','root','','biblioteca');
	if(isset($_POST["user"]) && isset($_POST["pass"])){
		$nombre = $_POST["user"];
		$pass = $_POST["pass"];
		
		$sql= "SELECT * FROM usuarios WHERE idUser='$nombre' AND pass ='$pass'";
		$query= mysqli_query($db,$sql);
		if(mysqli_num_rows($query)>0){
			session_start();
			$_SESSION['idUser'] =$nombre;
			$_SESSION['login']= true;
			header("Location: librosUsuarios.php");
		}
		else {
			echo "Login incorrecto";
			echo "<p> Vuelva <a href='login.php'> aqui para loguearse</a></p>";
		}
	} 
	@mysqli_close($db);


?>