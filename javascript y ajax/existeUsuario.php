<?php
	$db = @mysqli_connect('localhost','root','','mensajeriaweb');
	/*$usuario = $_POST['name'];*/
	
	$usuarip = $_REQUEST['q'];
	
	$sql= "SELECT * FROM usuarios WHERE idUser='$usuario'";
	$query = mysqli_query($db,$sql);
	
	if(mysqli_num_rows($query)>0){
		echo "El usuario ya existe";
	}
	else{
		echo "El usuario no existe";
	}

?>